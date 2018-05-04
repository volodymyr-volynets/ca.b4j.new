<?php

namespace Numbers\Users\Users\DataSource\Assignment;
class ServiceProviders extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_user_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'um_user_name' => 'name',
		'um_user_photo_file_id' => 'photo_id',
		'um_user_inactive' => 'inactive'
	];
	public $options_active =[
		'um_user_inactive' => 0
	];
	public $column_prefix = 'um_user_';

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Users\Model\Users';
	public $parameters = [
		'selected_organizations' => ['name' => 'Selected Organizations', 'domain' => 'organization_id', 'required' => true],
		'assignment_type_id' => ['name' => 'Assignment Type', 'domain' => 'type_id'],
		'service_id' => ['name' => 'Service #', 'domain' => 'service_id', 'required' => true],
		'location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'required' => true],
		'country_code' => ['name' => 'Country', 'domain' => 'country_code'],
		'province_code' => ['name' => 'Province', 'domain' => 'province_code'],
		'postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'territory_id' => ['name' => 'Territory', 'domain' => 'territory_id'],
		'address' => ['name' => 'Address', 'type' => 'text'],
		'limit' => ['name' => 'Limit', 'type' => 'smallint', 'required' => true],
		'hash_prefix' => ['name' => 'Hash Prefix', 'type' => 'text', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// fetch queue type
		$service_data = \Numbers\Users\Organizations\DataSource\Service\QueueSettings::getStatic([
			'where' => [
				'service_id' => $parameters['service_id']
			]
		]);
		// generate hash
		$hash = $parameters['hash_prefix'] . '::QUEUE::' . $service_data['on_service_queue_type_id'] . '::SERVICE::' . $parameters['service_id'] . '::LOCATION::' . $parameters['location_id'];
		// set flags
		switch ($parameters['assignment_type_id']) {
			case 13: $parameters['filter_by_territory_postal_code'] = 1; break;
			case 17: $parameters['filter_by_territory_county'] = 1; break;
			case 20: $parameters['filter_by_direct_postal_code'] = 1; break;
			case 30: $parameters['filter_by_location_assignment'] = 1; break;
			case 40: $parameters['filter_by_geo_assignment'] = 1; break;
			default: $this->query->where('AND', 'FALSE');
		}
		// columns
		$this->query->columns([
			'um_user_id' => 'a.um_user_id',
			'um_user_name' => 'a.um_user_name',
			'um_user_photo_file_id' => 'a.um_user_photo_file_id',
			'um_user_inactive' => 'a.um_user_inactive',
			'last_timestamp' => 'COALESCE(d.last_timestamp, a.um_user_inserted_timestamp)',
			'last_records_count' => 'd.last_records_count',
			'total_records_count' => 'd.total_records_count',
			'percent_records' => 'COALESCE(d.last_records_count / d.total_records_count * 100, 0)',
			'hash' => "'{$hash}'",
			'queue_type_id' => $service_data['on_service_queue_type_id'],
			'queue_method_id' => $service_data['on_quetype_method_id']
		]);
		// joins
		$query2 = \Numbers\Users\Organizations\Model\Queue\OwnerTypes::queryBuilderStatic(['alias' => 'subquery2'])->select()->columns(['on_ownertype_id'])->where('AND', ['subquery2.on_ownertype_code', '=', 'SP']);
		$this->query->join('INNER', new \Numbers\Users\Users\Model\User\Assignment\Queues(), 'b', 'ON', [
			['AND', ['a.um_user_id', '=', 'b.um_usrassqueue_user_id', true], false],
			['AND', ['b.um_usrassqueue_owner_type_id', 'IN', '(' . $query2->sql() . ')', true], false],
			['AND', ['b.um_usrassqueue_queue_type_id', '=', $service_data['on_service_queue_type_id'], false], false]
		]);
		// prioritized routing
		if ($service_data['on_quetype_method_id'] == 20) {
			$this->query->columns([
				'priority_percent' => 'COALESCE(p.um_quepriority_priority, 1)',
				'priority_order' => 'COALESCE(p.um_quepriority_priority, 1) - COALESCE(d.last_records_count / d.total_records_count * 100, 0)'
			]);
			$this->query->join('LEFT', new \Numbers\Users\Users\Model\Queue\Priorities(), 'p', 'ON', [
				['AND', ['a.um_user_id', '=', 'p.um_quepriority_user_id', true], false],
				['AND', ['b.um_usrassqueue_queue_type_id', '=', 'p.um_quepriority_queue_type_id', true], false],
				['AND', ['b.um_usrassqueue_owner_type_id', '=', 'p.um_quepriority_owner_type_id', true], false],
				['AND', ['p.um_quepriority_service_id', '=', $parameters['service_id'], false], false],
				['AND', ['p.um_quepriority_location_id', '=', $parameters['location_id'], false], false],
				['AND', ['p.um_quepriority_inactive', '=', 0, false], false],
			]);
		}
		$this->query->join('LEFT', function (& $query) use ($parameters, $service_data, $hash) {
			$reset_date = date('Y-m-01'); // reset on the 1st of every month
			$query3 = \Numbers\Users\Users\Model\Queues::queryBuilderStatic(['alias' => 'inner_x'])
				->select()
				->columns(['count' => 'SUM(inner_x.um_queue_operator)'])
				->where('AND', ['inner_x.um_queue_hash', '=', $hash])
				->where('AND', ['inner_x.um_queue_type_id', '=', $service_data['on_service_queue_type_id']])
				->where('AND', ['inner_x.um_queue_inactive', '=', 0])
				->where('AND', function (& $query) {
					$query->where('OR', ['inner_x.um_queue_temporary_until', 'IS', null]);
					$query->where('OR', ['inner_x.um_queue_temporary_until', '>', \Format::now('timestamp'), false]);
				})->where('AND', ['inner_x.um_queue_inserted_timestamp', '>=', $reset_date]);
			$query = \Numbers\Users\Users\Model\Queues::queryBuilderStatic(['alias' => 'inner_v'])->select();
			$query->columns([
				'user_id' => 'inner_v.um_queue_user_id',
				'last_records_count' => 'SUM(inner_v.um_queue_operator)',
				'last_timestamp' => 'MAX(inner_v.um_queue_inserted_timestamp)',
				'total_records_count' => '(' . $query3->sql() . ')'
			]);
			$query->groupby(['inner_v.um_queue_user_id']);
			$query->where('AND', ['inner_v.um_queue_hash', '=', $hash]);
			$query->where('AND', ['inner_v.um_queue_type_id', '=', $service_data['on_service_queue_type_id']]);
			$query->where('AND', ['inner_v.um_queue_inactive', '=', 0]);
			$query->where('AND', function (& $query) {
				$query->where('OR', ['inner_v.um_queue_temporary_until', 'IS', null]);
				$query->where('OR', ['inner_v.um_queue_temporary_until', '>', \Format::now('timestamp'), false]);
			});
			// reset queue every month
			$query->where('AND', ['inner_v.um_queue_inserted_timestamp', '>=', $reset_date]);
		}, 'd', 'ON', [
			['AND', ['d.user_id', '=', 'a.um_user_id', true], false],
		]);
		// selected organizations
		if (!empty($parameters['selected_organizations'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Organizations::queryBuilderStatic(['alias' => 'c'])->select();
				$query->columns(1);
				$query->where('OR', ['c.um_usrorg_organization_id', '=', $parameters['selected_organizations']]);
				$query->where('OR', ['a.um_user_id', '=', 'c.um_usrorg_user_id', true]);
			}, 'EXISTS');
		}
		// filter by location
		if (!empty($parameters['filter_by_location_assignment'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Location\Map::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_a.um_usrasslcnmap_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_a.um_usrasslcnmap_location_id', '=', $parameters['location_id']]);
				$query->where('AND', ['inner_a.um_usrasslcnmap_user_id', '=', 'a.um_user_id', true]);
			}, 'EXISTS');
		}
		// filter by territory postal code
		if (!empty($parameters['filter_by_territory_postal_code'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode\Details::queryBuilderStatic(['alias' => 'inner_b'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_b.um_usrassdetailterri_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_b.um_usrassdetailterri_location_id', '=', $parameters['location_id']]);
				$query->where('AND', ['inner_b.um_usrassdetailterri_postal_code', '=', $parameters['postal_code']]);
				$query->where('AND', ['inner_b.um_usrassdetailterri_user_id', '=', 'a.um_user_id', true]);
			}, 'EXISTS');
		}
		// filter by direct postal code
		if (!empty($parameters['filter_by_direct_postal_code'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\PostalCode\Details::queryBuilderStatic(['alias' => 'inner_c'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_location_id', '=', $parameters['location_id']]);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_postal_code', '=', $parameters['postal_code']]);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_user_id', '=', 'a.um_user_id', true]);
			}, 'EXISTS');
		}
		// filter by county
		if (!empty($parameters['filter_by_territory_county'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Territory\County\Details::queryBuilderStatic(['alias' => 'inner_d'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_location_id', '=', $parameters['location_id']]);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_territory_id', '=', $parameters['territory_id']]);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_user_id', '=', 'a.um_user_id', true]);
			}, 'EXISTS');
		}
		// geo assignment
		if (!empty($parameters['filter_by_geo_assignment'])) {
			if (!empty($parameters['postal_code']) && !empty($parameters['address'])) {
				$decoded = \Numbers\Countries\Countries\Helper\Google::decodeAnAddress($parameters['address']);
				if (!$decoded['success']) { // query postal codes
					$decoded = \Numbers\Countries\Countries\Helper\PostalCode::decodePostalCode($parameters['country_code'], $parameters['postal_code']);
				}
				if ($decoded['success']) {
					$this->query->where('AND', function (& $query) use ($parameters, $decoded) {
						$query = \Numbers\Users\Users\Model\User\Assignment\GeoAreas::queryBuilderStatic(['alias' => 'inner_e'])->select();
						$query->columns(1);
						$query->where('AND', ['inner_e.um_usrassgeoarea_service_id', '=', $parameters['service_id']]);
						$query->where('AND', ['inner_e.um_usrassgeoarea_location_id', '=', $parameters['location_id']]);
						$query->where('AND', ['inner_e.um_usrassgeoarea_user_id', '=', 'a.um_user_id', true]);
						$temp_contains = $this->query->db_object->sqlHelper('ST_Contains', [
							'from' => 'inner_e.um_usrassgeoarea_polygon',
							'to' => $this->query->db_object->sqlHelper('ST_Point', [
								'latitude' => $decoded['latitude'],
								'longitude' => $decoded['longitude'],
							]),
						]);
						$query->where('AND', $temp_contains);
					}, 'EXISTS');
				} else {
					$this->query->where('AND', 'FALSE');
				}
			} else {
				$this->query->where('AND', 'FALSE');
			}
		}
		// where
		$this->query->where('AND', ['a.um_user_inactive', '=', 0]);
		// limit
		$this->query->limit($parameters['limit']);
		// order
		if ($service_data['on_quetype_method_id'] == 20) { // prioritized routing
			$this->query->orderby(['priority_order' => SORT_DESC, 'last_timestamp' => SORT_ASC]);
		} else if ($service_data['on_quetype_method_id'] == 15) { // round robin (randomized)
			$this->query->columns([
				'last_timestamp' => "COALESCE(d.last_timestamp, '2000-01-01')",
				'random_value' => $this->query->db_object->sqlHelper('random')
			]);
			$this->query->orderby(['last_timestamp' => SORT_ASC, 'random_value' => SORT_DESC]);
		} else { // sequential round robin
			$this->query->orderby(['last_timestamp' => SORT_ASC]);
		}
		// debug
		//print_r2($this->query->sql());
		//exit;
	}
}