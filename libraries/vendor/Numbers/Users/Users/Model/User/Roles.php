<?php

namespace Numbers\Users\Users\Model\User;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Roles';
	public $name = 'um_user_roles';
	public $pk = ['um_usrrol_tenant_id', 'um_usrrol_user_id', 'um_usrrol_role_id'];
	public $tenant = true;
	public $orderby = [
		'um_usrrol_inserted_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrrol_';
	public $columns = [
		'um_usrrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrrol_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrrol_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'um_usrrol_unique' => ['name' => 'Unique', 'type' => 'smallint', 'null' => true, 'default' => null],
		'um_usrrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_roles_pk' => ['type' => 'pk', 'columns' => ['um_usrrol_tenant_id', 'um_usrrol_user_id', 'um_usrrol_role_id']],
		'um_usrrol_unique_un' => ['type' => 'unique', 'columns' => ['um_usrrol_tenant_id', 'um_usrrol_user_id', 'um_usrrol_unique']],
		'um_usrrol_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrrol_tenant_id', 'um_usrrol_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrrol_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrrol_tenant_id', 'um_usrrol_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
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