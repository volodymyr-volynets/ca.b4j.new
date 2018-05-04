<?php

namespace Numbers\Users\Workflow\Model\Workflow\Canvas;
class Shapes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflow Canvas Lines';
	public $schema;
	public $name = 'ww_workflow_canvas_shapes';
	public $pk = ['ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcnvsshape_canvas_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_wrkflwcnvsshape_';
	public $columns = [
		'ww_wrkflwcnvsshape_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_wrkflwcnvsshape_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_wrkflwcnvsshape_canvas_id' => ['name' => 'Canvas #', 'domain' => 'workflow_id'],
		'ww_wrkflwcnvsshape_shape_border_style_id' => ['name' => 'Border Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'ww_wrkflwcnvsshape_shape_border_color' => ['name' => 'Border Color', 'domain' => 'html_color_code', 'default' => '000000'],
		'ww_wrkflwcnvsshape_shape_fill_color' => ['name' => 'Fill Color', 'domain' => 'html_color_code', 'default' => 'FFFFFF'],
		'ww_wrkflwcnvsshape_completed_border_style_id' => ['name' => 'Completed Border Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'ww_wrkflwcnvsshape_completed_border_color' => ['name' => 'Completed Border Color', 'domain' => 'html_color_code', 'default' => '000000'],
		'ww_wrkflwcnvsshape_completed_fill_color' => ['name' => 'Completed Fill Color', 'domain' => 'html_color_code', 'default' => 'FFFFFF'],
	];
	public $constraints = [
		'ww_workflow_canvas_shapes_pk' => ['type' => 'pk', 'columns' => ['ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcnvsshape_canvas_id']],
		'ww_wrkflwcnvsshape_canvas_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcnvsshape_canvas_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas',
			'foreign_columns' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_id']
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