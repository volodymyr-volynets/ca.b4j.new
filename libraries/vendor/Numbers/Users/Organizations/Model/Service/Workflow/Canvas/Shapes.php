<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Canvas;
class Shapes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Canvas Lines';
	public $schema;
	public $name = 'on_workflow_canvas_shapes';
	public $pk = ['on_workcanvshape_tenant_id', 'on_workcanvshape_workflow_id', 'on_workcanvshape_canvas_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workcanvshape_';
	public $columns = [
		'on_workcanvshape_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workcanvshape_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workcanvshape_canvas_id' => ['name' => 'Canvas #', 'domain' => 'canvas_id'],
		'on_workcanvshape_shape_border_style_id' => ['name' => 'Border Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'on_workcanvshape_shape_border_color' => ['name' => 'Border Color', 'domain' => 'html_color_code', 'default' => '000000'],
		'on_workcanvshape_shape_fill_color' => ['name' => 'Fill Color', 'domain' => 'html_color_code', 'default' => 'FFFFFF'],
		'on_workcanvshape_completed_border_style_id' => ['name' => 'Completed Border Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'on_workcanvshape_completed_border_color' => ['name' => 'Completed Border Color', 'domain' => 'html_color_code', 'default' => '000000'],
		'on_workcanvshape_completed_fill_color' => ['name' => 'Completed Fill Color', 'domain' => 'html_color_code', 'default' => 'FFFFFF'],
	];
	public $constraints = [
		'on_workflow_canvas_shapes_pk' => ['type' => 'pk', 'columns' => ['on_workcanvshape_tenant_id', 'on_workcanvshape_workflow_id', 'on_workcanvshape_canvas_id']],
		'on_workcanvshape_canvas_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workcanvshape_tenant_id', 'on_workcanvshape_workflow_id', 'on_workcanvshape_canvas_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas',
			'foreign_columns' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_id']
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