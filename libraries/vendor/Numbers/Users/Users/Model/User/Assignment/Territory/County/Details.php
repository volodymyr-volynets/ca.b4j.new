<?php

namespace Numbers\Users\Users\Model\User\Assignment\Territory\County;
class Details extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment County Details';
	public $name = 'um_user_assignment_territory_county_details';
	public $pk = ['um_usrassdetailcounty_tenant_id', 'um_usrassdetailcounty_user_id', 'um_usrassdetailcounty_organization_id', 'um_usrassdetailcounty_service_id', 'um_usrassdetailcounty_brand_id', 'um_usrassdetailcounty_territory_id', 'um_usrassdetailcounty_location_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrassdetailcounty_';
	public $columns = [
		'um_usrassdetailcounty_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassdetailcounty_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassdetailcounty_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_usrassdetailcounty_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_usrassdetailcounty_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'um_usrassdetailcounty_territory_id' => ['name' => 'Territory #', 'domain' => 'territory_id'],
		'um_usrassdetailcounty_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
	];
	public $constraints = [
		'um_user_assignment_territory_county_details_pk' => ['type' => 'pk', 'columns' => ['um_usrassdetailcounty_tenant_id', 'um_usrassdetailcounty_user_id', 'um_usrassdetailcounty_organization_id', 'um_usrassdetailcounty_service_id', 'um_usrassdetailcounty_brand_id', 'um_usrassdetailcounty_territory_id', 'um_usrassdetailcounty_location_id']],
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
			'um_usrassdetailcounty_tenant_id',
			'um_usrassdetailcounty_user_id',
			'um_usrassdetailcounty_organization_id',
			'um_usrassdetailcounty_service_id',
			'um_usrassdetailcounty_brand_id',
			'um_usrassdetailcounty_territory_id',
			'um_usrassdetailcounty_location_id',
		]);
		$query->values(function(& $query) {
			$query = \Numbers\Users\Users\Model\User\Assignment\Territory\Map::queryBuilderStatic(['alias' => 'a'])->select();
			$query->columns([
				'um_usrassdetailcounty_tenant_id' => \Tenant::id(),
				'um_usrassdetailcounty_user_id' => 'a.um_usrasstrrmap_user_id',
				'um_usrassdetailcounty_organization_id' => 'a.um_usrasstrrmap_organization_id',
				'um_usrassdetailcounty_service_id' => 'a.um_usrasstrrmap_service_id',
				'um_usrassdetailcounty_brand_id' => 'a.um_usrasstrrmap_brand_id',
				'um_usrassdetailcounty_territory_id' => 'a.um_usrasstrrmap_territory_id',
				'um_usrassdetailcounty_location_id' => 'b.on_terrloc_location_id'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Location\Territory\Locations(), 'b', 'ON', [
				['AND', ['a.um_usrasstrrmap_territory_id', '=', 'b.on_terrloc_territory_id', true]],
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