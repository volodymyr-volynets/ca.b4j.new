<?php

namespace Numbers\Users\Users\Model;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Roles';
	public $schema;
	public $name = 'um_roles';
	public $pk = ['um_role_tenant_id', 'um_role_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_role_';
	public $columns = [
		'um_role_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_role_id' => ['name' => 'Role #', 'domain' => 'role_id_sequence'],
		'um_role_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'um_role_type_id' => ['name' => 'Type', 'domain' => 'type_id'],
		'um_role_department_id' => ['name' => 'Department #', 'domain' => 'department_id', 'null' => true],
		'um_role_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_role_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'um_role_global' => ['name' => 'Global', 'type' => 'boolean'],
		'um_role_super_admin' => ['name' => 'Super Admin', 'type' => 'boolean'],
		'um_role_handle_exceptions' => ['name' => 'Handle Exceptions', 'type' => 'boolean'],
		'um_role_weight' => ['name' => 'Weight', 'domain' => 'weight', 'null' => true], // based on this field priorities would be set
		'um_role_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_roles_pk' => ['type' => 'pk', 'columns' => ['um_role_tenant_id', 'um_role_id']],
		'um_role_code_un' => ['type' => 'unique', 'columns' => ['um_role_tenant_id', 'um_role_code']],
		'um_role_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_role_type_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Role\Types',
			'foreign_columns' => ['um_roltype_id']
		],
		'um_role_department_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_role_tenant_id', 'um_role_department_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Departments',
			'foreign_columns' => ['on_department_tenant_id', 'on_department_id']
		],
	];
	public $indexes = [
		'um_roles_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_role_code', 'um_role_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_role_tenant_id' => 'wg_audit_tenant_id',
			'um_role_id' => 'wg_audit_role_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'um_role_name' => 'name',
		'um_role_icon' => 'icon_class'
	];
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