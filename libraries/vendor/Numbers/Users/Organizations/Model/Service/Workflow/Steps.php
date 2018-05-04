<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow;
class Steps extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Steps';
	public $schema;
	public $name = 'on_workflow_steps';
	public $pk = ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id'];
	public $tenant = true;
	public $orderby = [
		'on_workstep_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workstep_';
	public $columns = [
		'on_workstep_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workstep_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workstep_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstep_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_workstep_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_workstep_order' => ['name' => 'Order', 'domain' => 'order'],
		'on_workstep_subflow_workflow_id' => ['name' => 'Subflow #', 'domain' => 'workflow_id', 'null' => true],
		'on_workstep_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Types'],
		'on_workstep_subtype_id' => ['name' => 'Sub Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\SubTypes'],
		'on_workstep_dashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id', 'null' => true],
		'on_workstep_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_steps_pk' => ['type' => 'pk', 'columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']],
		'on_workstep_code_un' => ['type' => 'unique', 'columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_code']],
		'on_workstep_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		],
		'on_workstep_subflow_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstep_tenant_id', 'on_workstep_subflow_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		]
	];
	public $indexes = [
		'on_workflow_steps_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_workstep_name', 'on_workstep_code']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'on_workstep_name' => 'name'
	];
	public $options_active = [
		'on_workstep_inactive' => 0
	];
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