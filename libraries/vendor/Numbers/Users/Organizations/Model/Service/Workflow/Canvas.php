<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow;
class Canvas extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Canvas';
	public $schema;
	public $name = 'on_workflow_canvases';
	public $pk = ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_id'];
	public $tenant = true;
	public $orderby = [
		'on_workcanvas_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workcanvas_';
	public $columns = [
		'on_workcanvas_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workcanvas_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workcanvas_id' => ['name' => 'Canvas #', 'domain' => 'canvas_id'],
		'on_workcanvas_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'on_workcanvas_order' => ['name' => 'Order', 'domain' => 'order'],
		'on_workcanvas_x1' => ['name' => 'X1 (Start)', 'domain' => 'dimension'],
		'on_workcanvas_y1' => ['name' => 'Y1 (Start)', 'domain' => 'dimension'],
		'on_workcanvas_x2' => ['name' => 'X2 (Width)', 'domain' => 'dimension'],
		'on_workcanvas_y2' => ['name' => 'Y2 (Height)', 'domain' => 'dimension'],
		'on_workcanvas_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Types'],
		'on_workcanvas_step_id' => ['name' => 'Step #', 'domain' => 'step_id', 'null' => true],
		'on_workcanvas_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_canvases_pk' => ['type' => 'pk', 'columns' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_id']],
		'on_workcanvas_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		],
		'on_workcanvas_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_step_id'],
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