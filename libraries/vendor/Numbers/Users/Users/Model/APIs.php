<?php

namespace Numbers\Users\Users\Model;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M APIs';
	public $schema;
	public $name = 'um_apis';
	public $pk = ['um_api_tenant_id', 'um_api_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_api_';
	public $columns = [
		'um_api_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_api_id' => ['name' => 'User #', 'domain' => 'user_id_sequence'],
		'um_api_code' => ['name' => 'User Number', 'domain' => 'group_code', 'null' => true],
		'um_api_name' => ['name' => 'Name', 'domain' => 'name'],
		// login
		'um_api_login_username' => ['name' => 'Username', 'domain' => 'login', 'null' => true],
		'um_api_login_password' => ['name' => 'Password', 'domain' => 'password', 'null' => true],
		// inactive & hold
		'um_api_hold' => ['name' => 'Hold', 'type' => 'boolean'],
		'um_api_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_apis_pk' => ['type' => 'pk', 'columns' => ['um_api_tenant_id', 'um_api_id']],
		'um_api_code_un' => ['type' => 'unique', 'columns' => ['um_api_tenant_id', 'um_api_code']],
		'um_api_login_username_un' => ['type' => 'unique', 'columns' => ['um_api_tenant_id', 'um_api_login_username']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'um_api_tenant_id' => 'wg_audit_tenant_id',
			'um_api_id' => 'wg_audit_api_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'um_api_name' => 'name',
		'um_api_inactive' => 'inactive'
	];
	public $options_active = [
		'um_api_inactive' => 0
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