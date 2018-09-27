<?php

namespace Numbers\Users\Users\Model\Role;
class Manages extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Manages';
	public $name = 'um_role_manages';
	public $pk = ['um_rolman_tenant_id', 'um_rolman_parent_role_id', 'um_rolman_child_role_id'];
	public $tenant = true;
	public $orderby = [
		'um_rolman_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_rolman_';
	public $columns = [
		'um_rolman_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_rolman_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_rolman_parent_role_id' => ['name' => 'Parent Role #', 'domain' => 'role_id'],
		'um_rolman_child_role_id' => ['name' => 'Child Role #', 'domain' => 'role_id'],
		'um_rolman_view_users_type_id' => ['name' => 'View Users', 'domain' => 'type_id', 'default' =>0, 'options_model' => '\Numbers\Users\Users\Model\Role\Manage\ViewUsersTypes'],
		'um_rolman_assign_roles' => ['name' => 'Assign Roles', 'type' => 'boolean'],
		'um_rolman_reset_password' => ['name' => 'Reset Password', 'type' => 'boolean'],
		// todo - refactor here
		'um_rolman_assignment_code' => ['name' => 'Assignment Code', 'domain' => 'type_code', 'null' => true],
		'um_rolman_manage_children' => ['name' => 'Manage Children', 'type' => 'boolean'],
		'um_rolman_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_manages_pk' => ['type' => 'pk', 'columns' => ['um_rolman_tenant_id', 'um_rolman_parent_role_id', 'um_rolman_child_role_id']],
		'um_rolman_parent_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolman_tenant_id', 'um_rolman_parent_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolman_child_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolman_tenant_id', 'um_rolman_child_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}