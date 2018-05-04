<?php

namespace Numbers\Users\Documents\Base\Model;
class Catalogs extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DT';
	public $title = 'D/T Catalogs';
	public $name = 'dt_catalogs';
	public $pk = ['dt_catalog_tenant_id', 'dt_catalog_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'dt_catalog_';
	public $columns = [
		'dt_catalog_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dt_catalog_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'dt_catalog_storage_id' => ['name' => 'Storage #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Documents\Base\Model\Storages'],
		'dt_catalog_name' => ['name' => 'Name', 'domain' => 'name'],
		'dt_catalog_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'dt_catalog_readonly' => ['name' => 'Readonly', 'type' => 'boolean'],
		'dt_catalog_temporary' => ['name' => 'Temporary', 'type' => 'boolean'],
		'dt_catalog_primary' => ['name' => 'Primary', 'type' => 'boolean'],
		'dt_catalog_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dt_catalogs_pk' => ['type' => 'pk', 'columns' => ['dt_catalog_tenant_id', 'dt_catalog_code']],
	];
	public $indexes = [
		'dt_catalogs_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['dt_catalog_name', 'dt_catalog_code']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'dt_catalog_tenant_id' => 'wg_audit_tenant_id',
			'dt_catalog_code' => 'wg_audit_catalog_code'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'dt_catalog_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}