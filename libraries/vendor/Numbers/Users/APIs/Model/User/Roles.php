<?php

namespace Numbers\Users\APIs\Model\User;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UA';
	public $title = 'U/A API User Roles';
	public $name = 'ua_api_user_roles';
	public $pk = ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_user_id', 'ua_apiusrrol_role_id'];
	public $tenant = true;
	public $orderby = [
		'ua_apiusrrol_inserted_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ua_apiusrrol_';
	public $columns = [
		'ua_apiusrrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ua_apiusrrol_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'ua_apiusrrol_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'ua_apiusrrol_unique' => ['name' => 'Unique', 'type' => 'smallint', 'null' => true, 'default' => null],
		'ua_apiusrrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ua_api_user_roles_pk' => ['type' => 'pk', 'columns' => ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_user_id', 'ua_apiusrrol_role_id']],
		'ua_apiusrrol_unique_un' => ['type' => 'unique', 'columns' => ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_user_id', 'ua_apiusrrol_unique']],
		'ua_apiusrrol_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_user_id'],
			'foreign_model' => '\Numbers\Users\APIs\Model\Users',
			'foreign_columns' => ['ua_apiusr_tenant_id', 'ua_apiusr_id']
		],
		'ua_apiusrrol_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_role_id'],
			'foreign_model' => '\Numbers\Users\APIs\Model\Roles',
			'foreign_columns' => ['ua_apirol_tenant_id', 'ua_apirol_id']
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