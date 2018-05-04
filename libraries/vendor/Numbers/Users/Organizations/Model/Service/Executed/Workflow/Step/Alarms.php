<?php

namespace Numbers\Users\Organizations\Model\Service\Executed\Workflow\Step;
class Alarms extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Executed Workflow Step Alarms';
	public $schema;
	public $name = 'on_executed_workflow_step_alarms';
	public $pk = ['on_execwfstpalarm_tenant_id', 'on_execwfstpalarm_execwflow_id', 'on_execwfstpalarm_execwfstep_id', 'on_execwfstpalarm_alarm_code'];
	public $tenant = true;
	public $orderby = [
		'on_execwfstpalarm_execwfstep_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_execwfstpalarm_';
	public $columns = [
		'on_execwfstpalarm_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_execwfstpalarm_execwflow_id' => ['name' => 'Executed #', 'domain' => 'executed_workflow_id'],
		'on_execwfstpalarm_execwfstep_id' => ['name' => 'Executed Step #', 'domain' => 'executed_workflow_id'],
		'on_execwfstpalarm_alarm_code' => ['name' => 'Alarm Code', 'domain' => 'group_code'],
		'on_execwfstpalarm_alarm_name' => ['name' => 'Alarm Name', 'domain' => 'name'],
	];
	public $constraints = [
		'on_executed_workflow_step_alarms_pk' => ['type' => 'pk', 'columns' => ['on_execwfstpalarm_tenant_id', 'on_execwfstpalarm_execwflow_id', 'on_execwfstpalarm_execwfstep_id', 'on_execwfstpalarm_alarm_code']],
		'on_execwfstpalarm_execwflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwfstpalarm_tenant_id', 'on_execwfstpalarm_execwflow_id', 'on_execwfstpalarm_execwfstep_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps',
			'foreign_columns' => ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id', 'on_execwfstep_id']
		],
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
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}