<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Step;
class Fields extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'ON Workflow Step Fields';
	public $schema;
	public $name = 'on_workflow_step_fields';
	public $pk = ['on_workstpfield_tenant_id', 'on_workstpfield_workflow_id', 'on_workstpfield_step_id', 'on_workstpfield_field_id'];
	public $tenant = true;
	public $orderby = [
		'on_workstpfield_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workstpfield_';
	public $columns = [
		'on_workstpfield_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workstpfield_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workstpfield_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstpfield_field_id' => ['name' => 'Field #', 'domain' => 'field_id'],
		'on_workstpfield_order' => ['name' => 'Order', 'domain' => 'order'],
		'on_workstpfield_default' => ['name' => 'Default', 'type' => 'text', 'null' => true],
		'on_workstpfield_required' => ['name' => 'Required', 'type' => 'boolean'],
		'on_workstpfield_row_id' => ['name' => 'Row', 'domain' => 'code', 'default' => 'row1', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Field\Rows'],
		'on_workstpfield_percent' => ['name' => 'Percent', 'domain' => 'percent'],
		'on_workstpfield_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_step_fields_pk' => ['type' => 'pk', 'columns' => ['on_workstpfield_tenant_id', 'on_workstpfield_workflow_id', 'on_workstpfield_step_id', 'on_workstpfield_field_id']],
		'on_workstpfield_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpfield_tenant_id', 'on_workstpfield_workflow_id', 'on_workstpfield_step_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'foreign_columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']
		],
		'on_workstpfield_field_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpfield_tenant_id', 'on_workstpfield_field_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields',
			'foreign_columns' => ['on_workfield_tenant_id', 'on_workfield_id']
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