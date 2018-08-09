<?php

namespace Numbers\Users\APIs\Model;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UA';
	public $title = 'U/A API Users';
	public $schema;
	public $name = 'ua_api_users';
	public $pk = ['ua_apiusr_tenant_id', 'ua_apiusr_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ua_apiusr_';
	public $columns = [
		'ua_apiusr_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ua_apiusr_id' => ['name' => 'User #', 'domain' => 'user_id_sequence'],
		'ua_apiusr_code' => ['name' => 'User Number', 'domain' => 'group_code', 'null' => true],
		'ua_apiusr_name' => ['name' => 'Name', 'domain' => 'name'],
		'ua_apiusr_user_id' => ['name' => 'Assigned User #', 'domain' => 'user_id'],
		// login
		'ua_apiusr_login_username' => ['name' => 'Username', 'domain' => 'login', 'null' => true],
		'ua_apiusr_login_password' => ['name' => 'Password', 'domain' => 'password', 'null' => true],
		// inactive & hold
		'ua_apiusr_hold' => ['name' => 'Hold', 'type' => 'boolean'],
		'ua_apiusr_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ua_api_users_pk' => ['type' => 'pk', 'columns' => ['ua_apiusr_tenant_id', 'ua_apiusr_id']],
		'ua_apiusr_code_un' => ['type' => 'unique', 'columns' => ['ua_apiusr_tenant_id', 'ua_apiusr_code']],
		'ua_apiusr_login_username_un' => ['type' => 'unique', 'columns' => ['ua_apiusr_tenant_id', 'ua_apiusr_login_username']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'ua_apiusr_tenant_id' => 'wg_audit_tenant_id',
			'ua_apiusr_id' => 'wg_audit_api_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'ua_apiusr_name' => 'name',
		'ua_apiusr_inactive' => 'inactive'
	];
	public $options_active = [
		'ua_apiusr_inactive' => 0
	];
	public $options_skip_i18n = true;
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