<?php

namespace Numbers\Users\Users\Model\Registration;
class Tenants extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Registration Tenants';
	public $schema;
	public $name = 'um_registration_tenants';
	public $pk = ['um_regten_id'];
	public $tenant = false;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_regten_';
	public $columns = [
		'um_regten_id' => ['name' => 'Registration #', 'domain' => 'group_id_sequence'],
		'um_regten_inserted' => ['name' => 'Inserted', 'type' => 'timestamp'],
		'um_regten_status' => ['name' => 'Inserted', 'domain' => 'status_id', 'default' => 0],
		// tenant information
		'um_regten_tenant_name' => ['name' => 'Screen Name', 'domain' => 'name'],
		'um_regten_tenant_code' => ['name' => 'Code', 'domain' => 'domain_part'],
		'um_regten_tenant_email' => ['name' => 'Primary Email', 'domain' => 'email', 'null' => true],
		'um_regten_tenant_phone' => ['name' => 'Primary Phone', 'domain' => 'phone', 'null' => true],
		// organization
		'um_regten_organization_name' => ['name' => 'Organization Name', 'domain' => 'name'],
		'um_regten_organization_code' => ['name' => 'Organization Code', 'domain' => 'group_code'],
		// user
		'um_regten_user_first_name' => ['name' => 'User First Name', 'domain' => 'personal_name'],
		'um_regten_user_last_name' => ['name' => 'User Last Name', 'domain' => 'personal_name'],
		'um_regten_user_email' => ['name' => 'Primary Email', 'domain' => 'email', 'null' => true],
		'um_regten_user_phone' => ['name' => 'Primary Phone', 'domain' => 'phone', 'null' => true],
		'um_regten_user_cell' => ['name' => 'Cell Phone', 'domain' => 'phone', 'null' => true],
		'um_regten_user_login_username' => ['name' => 'Username', 'domain' => 'login', 'null' => true],
		// inactive
		'um_regten_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_registration_tenants_pk' => ['type' => 'pk', 'columns' => ['um_regten_id']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
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