<?php

namespace Numbers\Users\Users\Model\User\Assignment\PostalCode;
class Details extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Postal Code Details';
	public $name = 'um_user_assignment_postal_code_details';
	public $pk = ['um_usrassdetailpostal_tenant_id', 'um_usrassdetailpostal_user_id', 'um_usrassdetailpostal_organization_id', 'um_usrassdetailpostal_service_id', 'um_usrassdetailpostal_brand_id', 'um_usrassdetailpostal_location_id', 'um_usrassdetailpostal_postal_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrassdetailpostal_';
	public $columns = [
		'um_usrassdetailpostal_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassdetailpostal_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassdetailpostal_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_usrassdetailpostal_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_usrassdetailpostal_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'um_usrassdetailpostal_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'um_usrassdetailpostal_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'um_usrassdetailpostal_latitude' => ['name' => 'Latitude', 'domain' => 'geo_coordinate', 'null' => true],
		'um_usrassdetailpostal_longitude' => ['name' => 'Longitude', 'domain' => 'geo_coordinate', 'null' => true],
	];
	public $constraints = [
		'um_user_assignment_postal_code_details_pk' => ['type' => 'pk', 'columns' => ['um_usrassdetailpostal_tenant_id', 'um_usrassdetailpostal_user_id', 'um_usrassdetailpostal_organization_id', 'um_usrassdetailpostal_service_id', 'um_usrassdetailpostal_brand_id', 'um_usrassdetailpostal_location_id', 'um_usrassdetailpostal_postal_code']],
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
	public $cache_tags = ['direct_postal_code_assignment'];
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
		// step 1 update special flag
		$query = $this->queryBuilder()->delete();
		$update_result = $query->query();
		if (!$update_result['success']) {
			$result['error']+= $update_result['error'];
			return $result;
		}
		// step 2 insert
		$query = $this->queryBuilder()->insert();
		$query->columns([
			'um_usrassdetailpostal_tenant_id',
			'um_usrassdetailpostal_user_id',
			'um_usrassdetailpostal_organization_id',
			'um_usrassdetailpostal_service_id',
			'um_usrassdetailpostal_brand_id',
			'um_usrassdetailpostal_location_id',
			'um_usrassdetailpostal_postal_code',
			'um_usrassdetailpostal_latitude',
			'um_usrassdetailpostal_longitude'
		]);
		$query->values(function(& $query) {
			$query = \Numbers\Countries\Countries\Model\PostalCodes::queryBuilderStatic(['alias' => 'a'])->select();
			$query->columns([
				'um_usrassdetailpostal_tenant_id' => \Tenant::id(),
				'um_usrassdetailpostal_user_id' => 'b.um_usrassactpostal_user_id',
				'um_usrassdetailpostal_organization_id' => 'b.um_usrassactpostal_organization_id',
				'um_usrassdetailpostal_service_id' => 'b.um_usrassactpostal_service_id',
				'um_usrassdetailpostal_brand_id' => 'b.um_usrassactpostal_brand_id',
				'um_usrassdetailpostal_location_id' => 'b.um_usrassactpostal_location_id',
				'um_usrassdetailpostal_postal_code' => 'a.cm_postal_postal_code',
				'um_usrassdetailpostal_latitude' => 'a.cm_postal_latitude',
				'um_usrassdetailpostal_longitude' => 'a.cm_postal_longitude'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Users\Model\User\Assignment\PostalCode\Actuals(), 'b', 'ON', [
				['AND', ['a.cm_postal_postal_code', 'LIKE', $query->db_object->sqlHelper('concat', ['b.um_usrassactpostal_postal_code', "'%'"]), true]],
			]);
		});
		$insert_result = $query->query();
		if (!$insert_result['success']) {
			$result['error']+= $insert_result['error'];
			return $result;
		}
		// reset cache
		$this->resetCache();
		// sucess at the end
		$result['success'] = true;
		return $result;
	}
}