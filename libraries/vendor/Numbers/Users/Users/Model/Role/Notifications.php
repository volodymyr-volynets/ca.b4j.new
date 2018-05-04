<?php

namespace Numbers\Users\Users\Model\Role;
class Notifications extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Notifications';
	public $name = 'um_role_notifications';
	public $pk = ['um_rolnoti_tenant_id', 'um_rolnoti_role_id', 'um_rolnoti_module_id', 'um_rolnoti_feature_code'];
	public $tenant = true;
	public $orderby = [
		'um_rolnoti_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_rolnoti_';
	public $columns = [
		'um_rolnoti_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_rolnoti_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_rolnoti_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'um_rolnoti_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'um_rolnoti_feature_code' => ['name' => 'Feature Code', 'domain' => 'feature_code'],
		'um_rolnoti_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_notifications_pk' => ['type' => 'pk', 'columns' => ['um_rolnoti_tenant_id', 'um_rolnoti_role_id', 'um_rolnoti_module_id', 'um_rolnoti_feature_code']],
		'um_rolnoti_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolnoti_tenant_id', 'um_rolnoti_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolnoti_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolnoti_tenant_id', 'um_rolnoti_module_id', 'um_rolnoti_feature_code'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Module\Features',
			'foreign_columns' => ['tm_feature_tenant_id', 'tm_feature_module_id', 'tm_feature_feature_code']
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}