<?php

namespace Numbers\Users\Workflow\Model;
class Assignments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Assignments';
	public $schema;
	public $name = 'ww_assignments';
	public $pk = ['ww_assignment_tenant_id', 'ww_assignment_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_assignment_';
	public $columns = [
		'ww_assignment_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_assignment_id' => ['name' => 'Assignment #', 'domain' => 'service_id_sequence'],
		'ww_assignment_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'ww_assignment_name' => ['name' => 'Name', 'domain' => 'name'],
		'ww_assignment_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'ww_assignment_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id', 'null' => true],
		'ww_assignment_all_roles' => ['name' => 'All Roles', 'type' => 'boolean'],
		'ww_assignment_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_assignments_pk' => ['type' => 'pk', 'columns' => ['ww_assignment_tenant_id', 'ww_assignment_id']],
		'ww_assignment_code_un' => ['type' => 'unique', 'columns' => ['ww_assignment_tenant_id', 'ww_assignment_code']],
		'ww_assignment_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_assignment_tenant_id', 'ww_assignment_workflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflows',
			'foreign_columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']
		],
	];
	public $indexes = [
		'ww_assignments_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ww_assignment_code', 'ww_assignment_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'ww_assignment_tenant_id' => 'wg_audit_tenant_id',
			'ww_assignment_id' => 'wg_audit_assignment_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'ww_assignment_name' => 'name',
		'ww_assignment_icon' => 'icon_class'
	];
	public $options_active = [
		'ww_assignment_inactive' => 0
	];
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