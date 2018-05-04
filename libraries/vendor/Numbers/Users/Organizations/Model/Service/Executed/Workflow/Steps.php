<?php

namespace Numbers\Users\Organizations\Model\Service\Executed\Workflow;
class Steps extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Executed Workflow Steps';
	public $schema;
	public $name = 'on_executed_workflow_steps';
	public $pk = ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id', 'on_execwfstep_id'];
	public $tenant = true;
	public $orderby = [
		'on_execwfstep_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_execwfstep_';
	public $columns = [
		'on_execwfstep_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_execwfstep_execwflow_id' => ['name' => 'Executed #', 'domain' => 'executed_workflow_id'],
		'on_execwfstep_id' => ['name' => 'Executed Step #', 'domain' => 'executed_workflow_id_sequence'],
		'on_execwfstep_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_execwfstep_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_execwfstep_chosen_step_id' => ['name' => 'Chosen Step #', 'domain' => 'step_id', 'null' => true],
		'on_execwfstep_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_execwfstep_status_id' => ['name' => 'Status', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Statuses'],
	];
	public $constraints = [
		'on_executed_workflow_steps_pk' => ['type' => 'pk', 'columns' => ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id', 'on_execwfstep_id']],
		'on_execwfstep_execwflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflows',
			'foreign_columns' => ['on_execwflow_tenant_id', 'on_execwflow_id']
		],
		'on_execwfstep_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwfstep_tenant_id', 'on_execwfstep_workflow_id', 'on_execwfstep_step_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'foreign_columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']
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