<?php

namespace Numbers\Users\Organizations\Model\Service\Executed;
class Workflows extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Executed Workflows';
	public $schema;
	public $name = 'on_executed_workflows';
	public $pk = ['on_execwflow_tenant_id', 'on_execwflow_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_execwflow_';
	public $columns = [
		'on_execwflow_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_execwflow_id' => ['name' => 'Executed #', 'domain' => 'executed_workflow_id_sequence'],
		'on_execwflow_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_execwflow_versioned_workflow_id' => ['name' => 'Versioned Workflow #', 'domain' => 'workflow_id'],
		'on_execwflow_workflow_name' => ['name' => 'Workflow Name', 'domain' => 'name'],
		'on_execwflow_customer_name' => ['name' => 'Customer Name', 'domain' => 'name', 'null' => true],
		'on_execwflow_customer_phone' => ['name' => 'Customer Phone', 'domain' => 'phone', 'null' => true],
		'on_execwflow_customer_email' => ['name' => 'Customer Email', 'domain' => 'email', 'null' => true],
		'on_execwflow_status_id' => ['name' => 'Status', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Statuses'],
		'on_execwflow_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		// linked columns
		'on_execwflow_linked_type_code' => ['name' => 'Linked Type', 'domain' => 'group_code', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Linked\Types'],
		'on_execwflow_linked_module_id' => ['name' => 'Linked Module #', 'domain' => 'module_id'],
		'on_execwflow_linked_id' => ['name' => 'Linked #', 'domain' => 'big_id'], // we do not have fk for this field
		// current step
		'on_execwflow_current_execwfstep_id' => ['name' => 'Executed Step #', 'domain' => 'executed_workflow_id', 'null' => true],
		'on_execwflow_current_step_id' => ['name' => 'Current Step #', 'domain' => 'step_id', 'null' => true],
		'on_execwflow_current_step_start' => ['name' => 'Current Step Start', 'type' => 'timestamp', 'null' => true],
		'on_execwflow_current_alarm_code' => ['name' => 'Current Alarm Code', 'domain' => 'group_code', 'null' => true],
		'on_execwflow_current_alarm_name' => ['name' => 'Current Alarm Name', 'domain' => 'name', 'null' => true],
		// inactive
		'on_execwflow_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_executed_workflows_pk' => ['type' => 'pk', 'columns' => ['on_execwflow_tenant_id', 'on_execwflow_id']],
		'on_execwflow_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwflow_tenant_id', 'on_execwflow_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		],
		'on_execwflow_linked_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwflow_tenant_id', 'on_execwflow_linked_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
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
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}