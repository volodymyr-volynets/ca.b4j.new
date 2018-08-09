<?php

namespace Numbers\Users\APIs\Model\Role;
class Permissions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UA';
	public $title = 'U/A API Role Permissions';
	public $name = 'ua_api_role_permissions';
	public $pk = ['ua_apirolperm_tenant_id', 'ua_apirolperm_role_id', 'ua_apirolperm_module_id', 'ua_apirolperm_resource_id'];
	public $tenant = true;
	public $orderby = [
		'ua_apirolperm_inserted_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ua_apirolperm_';
	public $columns = [
		'ua_apirolperm_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ua_apirolperm_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'ua_apirolperm_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'ua_apirolperm_resource_id' => ['name' => 'Resource #', 'domain' => 'resource_id'],
		'ua_apirolperm_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ua_api_role_permissions_pk' => ['type' => 'pk', 'columns' => ['ua_apirolperm_tenant_id', 'ua_apirolperm_role_id', 'ua_apirolperm_module_id', 'ua_apirolperm_resource_id']],
		'ua_apirolperm_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apirolperm_tenant_id', 'ua_apirolperm_role_id'],
			'foreign_model' => '\Numbers\Users\APIs\Model\Roles',
			'foreign_columns' => ['ua_apirol_tenant_id', 'ua_apirol_id']
		],
		'ua_apirolperm_resource_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apirolperm_resource_id'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Resources',
			'foreign_columns' => ['sm_resource_id']
		],
		'ua_apirolperm_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apirolperm_tenant_id', 'ua_apirolperm_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
		]
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

	public $who = [
		'inserted' => true,
		'updated' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}