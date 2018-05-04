<?php

namespace Numbers\Users\Workflow\Model\Assignment;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Assignment Roles';
	public $name = 'ww_assignment_roles';
	public $pk = ['ww_assignrol_tenant_id', 'ww_assignrol_assignment_id', 'ww_assignrol_role_id'];
	public $tenant = true;
	public $orderby = [
		'ww_assignrol_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ww_assignrol_';
	public $columns = [
		'ww_assignrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_assignrol_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'ww_assignrol_assignment_id' => ['name' => 'Assignment #', 'domain' => 'service_id'],
		'ww_assignrol_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'ww_assignrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_assignment_roles_pk' => ['type' => 'pk', 'columns' => ['ww_assignrol_tenant_id', 'ww_assignrol_assignment_id', 'ww_assignrol_role_id']],
		'ww_assignrol_assignment_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_assignrol_tenant_id', 'ww_assignrol_assignment_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Assignments',
			'foreign_columns' => ['ww_assignment_tenant_id', 'ww_assignment_id']
		],
		'ww_assignrol_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_assignrol_tenant_id', 'ww_assignrol_role_id'],
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}