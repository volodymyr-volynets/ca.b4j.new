<?php

namespace Numbers\Users\Workflow\Model\Workflow;
class Canvas extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflow Canvas';
	public $schema;
	public $name = 'ww_workflow_canvas';
	public $pk = ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_id'];
	public $tenant = true;
	public $orderby = [
		'ww_wrkflwcanvas_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ww_wrkflwcanvas_';
	public $columns = [
		'ww_wrkflwcanvas_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_wrkflwcanvas_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_wrkflwcanvas_id' => ['name' => 'Canvas #', 'domain' => 'workflow_id'],
		'ww_wrkflwcanvas_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'ww_wrkflwcanvas_order' => ['name' => 'Order', 'domain' => 'order'],
		'ww_wrkflwcanvas_x1' => ['name' => 'X1 (Start)', 'domain' => 'dimension'],
		'ww_wrkflwcanvas_y1' => ['name' => 'Y1 (Start)', 'domain' => 'dimension'],
		'ww_wrkflwcanvas_x2' => ['name' => 'X2 (Width)', 'domain' => 'dimension'],
		'ww_wrkflwcanvas_y2' => ['name' => 'Y2 (Height)', 'domain' => 'dimension'],
		'ww_wrkflwcanvas_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Types'],
		'ww_wrkflwcanvas_step_id' => ['name' => 'Step #', 'domain' => 'workflow_id', 'null' => true],
		'ww_wrkflwcanvas_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_workflow_canvas_pk' => ['type' => 'pk', 'columns' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_id']],
		'ww_wrkflwcanvas_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflows',
			'foreign_columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']
		],
		'ww_wrkflwcanvas_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_step_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflow\Steps',
			'foreign_columns' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id']
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