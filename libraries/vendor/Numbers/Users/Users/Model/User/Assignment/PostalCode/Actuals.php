<?php

namespace Numbers\Users\Users\Model\User\Assignment\PostalCode;
class Actuals extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Postal Code Actuals';
	public $name = 'um_user_assignment_postal_code_actuals';
	public $pk = ['um_usrassactpostal_tenant_id', 'um_usrassactpostal_user_id', 'um_usrassactpostal_organization_id', 'um_usrassactpostal_service_id', 'um_usrassactpostal_brand_id', 'um_usrassactpostal_location_id', 'um_usrassactpostal_postal_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrassactpostal_';
	public $columns = [
		'um_usrassactpostal_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassactpostal_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassactpostal_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_usrassactpostal_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_usrassactpostal_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'um_usrassactpostal_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'um_usrassactpostal_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
	];
	public $constraints = [
		'um_user_assignment_postal_code_actuals_pk' => ['type' => 'pk', 'columns' => ['um_usrassactpostal_tenant_id', 'um_usrassactpostal_user_id', 'um_usrassactpostal_organization_id', 'um_usrassactpostal_service_id', 'um_usrassactpostal_brand_id', 'um_usrassactpostal_location_id', 'um_usrassactpostal_postal_code']],
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
	 * Trigger to update postal codes
	 *
	 * @param string $type
	 * @param array $data
	 * @param array $audit
	 * @return array
	 */
	public function triggerUpdateActuals(string $type, array $data, array $audit = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		// if we do not have postal codes
		if (empty($data['\Numbers\Users\Users\Model\User\Assignment\PostalCodes'])) {
			$result['success'] = true;
			return $result;
		}
		foreach ($data['\Numbers\Users\Users\Model\User\Assignment\PostalCodes'] as $k => $v) {
			// step 1 delete
			$query = $this->queryBuilder()->delete();
			$query->where('AND', ['um_usrassactpostal_user_id', '=', $v['um_usrasspostal_user_id']]);
			$query->where('AND', ['um_usrassactpostal_organization_id', '=', $v['um_usrasspostal_organization_id']]);
			$query->where('AND', ['um_usrassactpostal_service_id', '=', $v['um_usrasspostal_service_id']]);
			$query->where('AND', ['um_usrassactpostal_brand_id', '=', $v['um_usrasspostal_brand_id']]);
			$query->where('AND', ['um_usrassactpostal_location_id', '=', $v['um_usrasspostal_location_id']]);
			$delete_result = $query->query();
			if (!$delete_result['success']) {
				$result['error']+= $delete_result['error'];
				return $result;
			}
			if (!empty($v['um_usrasspostal_inactive'])) continue;
			// insert
			$postal_codes = explode(' ', strtoupper(trim2($v['um_usrasspostal_postal_codes'])));
			foreach ($postal_codes as $v2) {
				$merge_result = $this->collection()->merge([
					'um_usrassactpostal_user_id' => $v['um_usrasspostal_user_id'],
					'um_usrassactpostal_organization_id' => $v['um_usrasspostal_organization_id'],
					'um_usrassactpostal_service_id' => $v['um_usrasspostal_service_id'],
					'um_usrassactpostal_brand_id' => $v['um_usrasspostal_brand_id'],
					'um_usrassactpostal_location_id' => $v['um_usrasspostal_location_id'],
					'um_usrassactpostal_postal_code' => $v2,
				]);
				if (!$merge_result['success']) {
					$result['error']+= $merge_result['error'];
					return $result;
				}
			}
		}
		// reset cache
		$this->resetCache();
		// sucess at the end
		$result['success'] = true;
		return $result;
	}
}