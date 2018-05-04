<?php

namespace Numbers\Users\Workflow\Model\Executed\Workflow;
class Steps extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Executed Workflow Steps';
	public $schema;
	public $name = 'ww_executed_workflow_steps';
	public $pk = ['ww_execwstep_tenant_id', 'ww_execwstep_execwflow_id', 'ww_execwstep_id'];
	public $tenant = true;
	public $orderby = [
		'ww_execwstep_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ww_execwstep_';
	public $columns = [
		'ww_execwstep_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_execwstep_execwflow_id' => ['name' => 'Executed #', 'domain' => 'big_id'],
		'ww_execwstep_id' => ['name' => 'Execute #', 'domain' => 'big_id_sequence'],
		'ww_execwstep_step_id' => ['name' => 'Step #', 'domain' => 'workflow_id'],
		'ww_execwstep_status_id' => ['name' => 'Status', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\Workflow\Model\Executed\Workflow\Statuses'],
	];
	public $constraints = [
		'ww_executed_workflow_steps_pk' => ['type' => 'pk', 'columns' => ['ww_execwstep_tenant_id', 'ww_execwstep_execwflow_id', 'ww_execwstep_id']],
		'ww_execwstep_execwflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_execwstep_tenant_id', 'ww_execwstep_execwflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Executed\Workflows',
			'foreign_columns' => ['ww_execwflow_tenant_id', 'ww_execwflow_id']
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