<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Step;
class Alarms extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'ON Workflow Step Alarms';
	public $schema;
	public $name = 'on_workflow_step_alarms';
	public $pk = ['on_workstpalarm_tenant_id', 'on_workstpalarm_workflow_id', 'on_workstpalarm_step_id', 'on_workstpalarm_code'];
	public $tenant = true;
	public $orderby = [
		'on_workstpalarm_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workstpalarm_';
	public $columns = [
		'on_workstpalarm_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workstpalarm_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workstpalarm_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstpalarm_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_workstpalarm_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_workstpalarm_order' => ['name' => 'Order', 'domain' => 'order'],
		'on_workstpalarm_interval_period' => ['name' => 'Interval Period', 'domain' => 'group_id'],
		'on_workstpalarm_interval_type_id' => ['name' => 'Interval Type', 'domain' => 'type_id', 'default' => 10],
		'on_workstpalarm_business' => ['name' => 'Business', 'type' => 'boolean'],
		'on_workstpalarm_from_step_start' => ['name' => 'From Step Start', 'type' => 'boolean'],
		'on_workstpalarm_from_date_field_id' => ['name' => 'From Date Field #', 'domain' => 'field_id', 'null' => true],
		'on_workstpalarm_dashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id', 'null' => true],
		'on_workstpalarm_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_step_alarms_pk' => ['type' => 'pk', 'columns' => ['on_workstpalarm_tenant_id', 'on_workstpalarm_workflow_id', 'on_workstpalarm_step_id', 'on_workstpalarm_code']],
		'on_workstpalarm_code_un' => ['type' => 'unique', 'columns' => ['on_workstpalarm_tenant_id', 'on_workstpalarm_workflow_id', 'on_workstpalarm_step_id', 'on_workstpalarm_code']],
		'on_workstpalarm_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpalarm_tenant_id', 'on_workstpalarm_workflow_id', 'on_workstpalarm_step_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'foreign_columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}