<?php

namespace Numbers\Users\Users\DataSource\Assignment;
class Locations extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_location_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'on_location_name' => 'name',
		'on_location_distance_to_location' => 'name',
		'on_location_logo_file_id' => 'photo_id',
		'on_location_inactive' => 'inactive'
	];
	public $options_active =[
		'on_location_inactive' => 0
	];
	public $column_prefix = 'on_location_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Organizations\Model\Locations';
	public $parameters = [
		'selected_organizations' => ['name' => 'Selected Organizations', 'domain' => 'organization_id', 'multiple_column' => true, 'required' => true],
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'assignment_type_id' => ['name' => 'Assignment Type', 'domain' => 'type_id'],
		'service_id' => ['name' => 'Service', 'domain' => 'service_id', 'multiple_column' => true, 'required' => true],
		'country_code' => ['name' => 'Country', 'domain' => 'country_code'],
		'province_code' => ['name' => 'Province', 'domain' => 'province_code'],
		'postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'territory_id' => ['name' => 'Territory', 'domain' => 'territory_id'],
		'address' => ['name' => 'Address', 'type' => 'text'],
	];

	public function query($parameters, $options = []) {
		switch ($parameters['assignment_type_id']) {
			case 13: $parameters['filter_by_territory_postal_code'] = 1; break;
			case 17: $parameters['filter_by_territory_county'] = 1; break;
			case 20: $parameters['filter_by_direct_postal_code'] = 1; break;
			case 30: $parameters['filter_by_location_assignment'] = 1; break;
			case 40: $parameters['filter_by_geo_assignment'] = 1; break;
			case 50: /* no assignment service, display all locations */ break;
			default: $this->query->where('AND', 'FALSE');
		}
		$parameters['postal_code'] = strtoupper($parameters['postal_code'] ?? '');
		// columns
		$this->query->columns([
			'on_location_id' => 'a.on_location_id',
			'on_location_name' => 'a.on_location_name',
			'on_location_distance_to_location' => 'NULL',
			'on_location_logo_file_id' => 'a.on_location_logo_file_id',
			'on_location_inactive' => 'a.on_location_inactive'
		]);
		// selected organizations
		if (!empty($parameters['selected_organizations'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.on_location_id', '=', $parameters['existing_values']]);
				}
				$query->where('OR', ['a.on_location_organization_id', '=', $parameters['selected_organizations']]);
			});
		}
		// filter by locations assignment
		if (!empty($parameters['filter_by_location_assignment'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Location\Map::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_a.um_usrasslcnmap_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_a.um_usrasslcnmap_location_id', '=', 'a.on_location_id', true]);
				if (!empty($parameters['country_code'])) {
					$query->where('AND', ['inner_a.um_usrasslcnmap_country_code', '=', $parameters['country_code']]);
				}
				if (!empty($parameters['province_code'])) {
					$query->where('AND', ['inner_a.um_usrasslcnmap_province_code', '=', $parameters['province_code']]);
				}
			}, 'EXISTS');
		}
		// filter by territory postal code
		if (!empty($parameters['filter_by_territory_postal_code'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode\Details::queryBuilderStatic(['alias' => 'inner_b'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_b.um_usrassdetailterri_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_b.um_usrassdetailterri_location_id', '=', 'a.on_location_id', true]);
				$query->where('AND', ['inner_b.um_usrassdetailterri_postal_code', '=', $parameters['postal_code']]);
			}, 'EXISTS');
		}
		// filter by direct postal code
		if (!empty($parameters['filter_by_direct_postal_code'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\PostalCode\Details::queryBuilderStatic(['alias' => 'inner_c'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_location_id', '=', 'a.on_location_id', true]);
				$query->where('AND', ['inner_c.um_usrassdetailpostal_postal_code', '=', $parameters['postal_code']]);
			}, 'EXISTS');
		}
		// filter by country
		if (!empty($parameters['filter_by_territory_county'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\User\Assignment\Territory\County\Details::queryBuilderStatic(['alias' => 'inner_d'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_location_id', '=', 'a.on_location_id', true]);
				$query->where('AND', ['inner_d.um_usrassdetailcounty_territory_id', '=', $parameters['territory_id']]);
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
						$query->where('AND', ['inner_e.um_usrassgeoarea_location_id', '=', 'a.on_location_id', true]);
						//um_usrassgeoarea_polygon
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
		// distance to location if we have postal code
		if (!empty($parameters['postal_code']) && !empty($parameters['country_code'])) {
			$this->query->columns([
				'on_location_distance_to_location' => $this->query->db_object->sqlHelper('distance_in_meters', [
					'latitude_1' => 'p.cm_postal_latitude',
					'longitude_1' => 'p.cm_postal_longitude',
					'latitude_2' => 'a.on_location_latitude',
					'longitude_2' => 'a.on_location_longitude'
				])
			]);
			$this->query->join('LEFT', new \Numbers\Countries\Countries\Model\PostalCodes(), 'p', 'ON', [
				['AND', ['p.cm_postal_country_code', '=', $parameters['country_code'], false], false],
				['AND', ['p.cm_postal_postal_code', '=', $parameters['postal_code'], false], false],
			]);
			$this->query->orderby(['on_location_distance_to_location' => SORT_ASC]);
		}
		// where
		if (!empty($parameters['country_code'])) {
			$this->query->where('AND', ['a.on_location_country_code', '=', $parameters['country_code']]);
		}
		if (!empty($parameters['province_code'])) {
			$this->query->where('AND', ['a.on_location_province_code', '=', $parameters['province_code']]);
		}
	}

	public function processNotCached($data, $options = []) {
		foreach ($data as $k => $v) {
			if (isset($v['on_location_distance_to_location'])) {
				$data[$k]['on_location_distance_to_location'] = '(' . \Format::distance($v['on_location_distance_to_location']) . ')';
			}
		}
		return $data;
	}
}