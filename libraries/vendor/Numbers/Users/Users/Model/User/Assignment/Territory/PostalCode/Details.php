<?php

namespace Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode;
class Details extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Territory Details';
	public $name = 'um_user_assignment_territory_details';
	public $pk = ['um_usrassdetailterri_tenant_id', 'um_usrassdetailterri_user_id', 'um_usrassdetailterri_organization_id', 'um_usrassdetailterri_service_id', 'um_usrassdetailterri_brand_id', 'um_usrassdetailterri_location_id', 'um_usrassdetailterri_territory_id', 'um_usrassdetailterri_postal_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrassdetailterri_';
	public $columns = [
		'um_usrassdetailterri_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassdetailterri_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassdetailterri_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_usrassdetailterri_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_usrassdetailterri_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'um_usrassdetailterri_territory_id' => ['name' => 'Territory #', 'domain' => 'territory_id'],
		'um_usrassdetailterri_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'um_usrassdetailterri_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'um_usrassdetailterri_latitude' => ['name' => 'Latitude', 'domain' => 'geo_coordinate', 'null' => true],
		'um_usrassdetailterri_longitude' => ['name' => 'Longitude', 'domain' => 'geo_coordinate', 'null' => true],
	];
	public $constraints = [
		'um_user_assignment_territory_details_pk' => ['type' => 'pk', 'columns' => ['um_usrassdetailterri_tenant_id', 'um_usrassdetailterri_user_id', 'um_usrassdetailterri_organization_id', 'um_usrassdetailterri_service_id', 'um_usrassdetailterri_brand_id', 'um_usrassdetailterri_location_id', 'um_usrassdetailterri_territory_id', 'um_usrassdetailterri_postal_code']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * Trigger to update postal codes from territories
	 *
	 * @param string $type
	 * @param array $data
	 * @param array $audit
	 * @return array
	 */
	public function triggerUpdateDetails(string $type, array $data, array $audit = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		// step 1 update specia flag
		$query = $this->queryBuilder()->delete();
		$update_result = $query->query();
		if (!$update_result['success']) {
			$result['error']+= $update_result['error'];
			return $result;
		}
		// step 2 insert
		$query = $this->queryBuilder()->insert();
		$query->columns([
			'um_usrassdetailterri_tenant_id',
			'um_usrassdetailterri_user_id',
			'um_usrassdetailterri_organization_id',
			'um_usrassdetailterri_service_id',
			'um_usrassdetailterri_brand_id',
			'um_usrassdetailterri_territory_id',
			'um_usrassdetailterri_location_id',
			'um_usrassdetailterri_postal_code',
			'um_usrassdetailterri_latitude',
			'um_usrassdetailterri_longitude'
		]);
		$query->values(function(& $query) {
			$query = \Numbers\Countries\Countries\Model\PostalCodes::queryBuilderStatic(['alias' => 'a'])->select();
			$query->columns([
				'um_usrassdetailterri_tenant_id' => \Tenant::id(),
				'um_usrassdetailterri_user_id' => 'c.um_usrasstrrmap_user_id',
				'um_usrassdetailterri_organization_id' => 'b.on_terrpostal_organization_id',
				'um_usrassdetailterri_service_id' => 'c.um_usrasstrrmap_service_id',
				'um_usrassdetailterri_brand_id' => 'c.um_usrasstrrmap_brand_id',
				'um_usrassdetailterri_territory_id' => 'b.on_terrpostal_territory_id',
				'um_usrassdetailterri_location_id' => 'b.on_terrpostal_location_id',
				'um_usrassdetailterri_postal_code' => 'a.cm_postal_postal_code',
				'um_usrassdetailterri_latitude' => 'a.cm_postal_latitude',
				'um_usrassdetailterri_longitude' => 'a.cm_postal_longitude'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Location\Territory\PostalCodes(), 'b', 'ON', [
				['AND', ['a.cm_postal_postal_code', 'LIKE', $query->db_object->sqlHelper('concat', ['b.on_terrpostal_postal_code', "'%'"]), true]],
			]);
			$query->join('INNER', new \Numbers\Users\Users\Model\User\Assignment\Territory\Map(), 'c', 'ON', [
				['AND', ['c.um_usrasstrrmap_territory_id', '=', 'b.on_terrpostal_territory_id', true]],
			]);
		});
		$insert_result = $query->query();
		if (!$insert_result['success']) {
			$result['error']+= $insert_result['error'];
			return $result;
		}
		//reset cache
		$this->resetCache();
		// sucess at the end
		$result['success'] = true;
		return $result;
	}
}