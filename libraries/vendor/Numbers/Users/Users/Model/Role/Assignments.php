<?php

namespace Numbers\Users\Users\Model\Role;
class Assignments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Assignments';
	public $name = 'um_role_assignments';
	public $pk = ['um_rolassign_tenant_id', 'um_rolassign_parent_role_id', 'um_rolassign_assignment_code', 'um_rolassign_child_role_id'];
	public $tenant = true;
	public $orderby = [
		'um_rolassign_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_rolassign_';
	public $columns = [
		'um_rolassign_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_rolassign_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_rolassign_parent_role_id' => ['name' => 'Parent Role #', 'domain' => 'role_id'],
		'um_rolassign_assignment_code' => ['name' => 'Assignment Code', 'domain' => 'type_code'],
		'um_rolassign_child_role_id' => ['name' => 'Child Role #', 'domain' => 'role_id'],
		'um_rolassign_mandatory' => ['name' => 'Mandatory', 'type' => 'boolean'],
		'um_rolassign_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_assignments_pk' => ['type' => 'pk', 'columns' => ['um_rolassign_tenant_id', 'um_rolassign_parent_role_id', 'um_rolassign_assignment_code', 'um_rolassign_child_role_id']],
		'um_rolassign_parent_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolassign_tenant_id', 'um_rolassign_parent_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolassign_child_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolassign_tenant_id', 'um_rolassign_child_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolassign_assignment_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolassign_tenant_id', 'um_rolassign_assignment_code', 'um_rolassign_parent_role_id', 'um_rolassign_child_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Assignment\Types',
			'foreign_columns' => ['um_assigntype_tenant_id', 'um_assigntype_code', 'um_assigntype_parent_role_id', 'um_assigntype_child_role_id']
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