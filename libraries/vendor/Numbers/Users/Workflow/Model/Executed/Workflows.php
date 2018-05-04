<?php

namespace Numbers\Users\Workflow\Model\Executed;
class Workflows extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Executed Workflows';
	public $schema;
	public $name = 'ww_executed_workflows';
	public $pk = ['ww_execwflow_tenant_id', 'ww_execwflow_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_execwflow_';
	public $columns = [
		'ww_execwflow_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_execwflow_id' => ['name' => 'Executed #', 'domain' => 'big_id_sequence'],
		'ww_execwflow_assignment_id' => ['name' => 'Assignment #', 'domain' => 'service_id'],
		'ww_execwflow_assignment_name' => ['name' => 'Assignment Name', 'domain' => 'name'],
		'ww_execwflow_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_execwflow_workflow_name' => ['name' => 'Workflow Name', 'domain' => 'name'],
		'ww_execwflow_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'ww_execwflow_status_id' => ['name' => 'Status', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\Workflow\Model\Executed\Workflow\Statuses'],
		'ww_execwflow_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_executed_workflows_pk' => ['type' => 'pk', 'columns' => ['ww_execwflow_tenant_id', 'ww_execwflow_id']],
		'ww_execwflow_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_execwflow_tenant_id', 'ww_execwflow_workflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflows',
			'foreign_columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']
		],
		'ww_execwflow_assignment_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_execwflow_tenant_id', 'ww_execwflow_assignment_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Assignments',
			'foreign_columns' => ['ww_assignment_tenant_id', 'ww_assignment_id']
		],
		'ww_execwflow_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_execwflow_tenant_id', 'ww_execwflow_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		]
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