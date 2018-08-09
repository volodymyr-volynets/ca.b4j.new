<?php

namespace Numbers\Users\APIs\Model\User;
class Permissions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UA';
	public $title = 'U/A User Permissions';
	public $name = 'ua_api_user_permissions';
	public $pk = ['ua_apiusrperm_tenant_id', 'ua_apiusrperm_user_id', 'ua_apiusrperm_module_id', 'ua_apiusrperm_resource_id'];
	public $tenant = true;
	public $orderby = [
		'ua_apiusrperm_inserted_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ua_apiusrperm_';
	public $columns = [
		'ua_apiusrperm_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ua_apiusrperm_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'ua_apiusrperm_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'ua_apiusrperm_resource_id' => ['name' => 'Resource #', 'domain' => 'resource_id'],
		'ua_apiusrperm_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ua_api_user_permissions_pk' => ['type' => 'pk', 'columns' => ['ua_apiusrperm_tenant_id', 'ua_apiusrperm_user_id', 'ua_apiusrperm_module_id', 'ua_apiusrperm_resource_id']],
		'ua_apiusrperm_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apiusrperm_tenant_id', 'ua_apiusrperm_user_id'],
			'foreign_model' => '\Numbers\Users\APIs\Model\Users',
			'foreign_columns' => ['ua_apiusr_tenant_id', 'ua_apiusr_id']
		],
		'ua_apiusrperm_resource_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apiusrperm_resource_id'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Resources',
			'foreign_columns' => ['sm_resource_id']
		],
		'ua_apiusrperm_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apiusrperm_tenant_id', 'ua_apiusrperm_module_id'],
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