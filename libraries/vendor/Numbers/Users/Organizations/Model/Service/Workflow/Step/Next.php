<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Step;
class Next extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'ON Workflow Step Next';
	public $schema;
	public $name = 'on_workflow_step_next';
	public $pk = ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_step_id', 'on_workstpnext_next_step_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workstpnext_';
	public $columns = [
		'on_workstpnext_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workstpnext_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workstpnext_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstpnext_next_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstpnext_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'on_workstpnext_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_step_next_pk' => ['type' => 'pk', 'columns' => ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_step_id', 'on_workstpnext_next_step_id']],
		'on_workstpnext_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_step_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'foreign_columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']
		],
		'on_workstpnext_next_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_next_step_id'],
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}