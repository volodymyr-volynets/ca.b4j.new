<?php

namespace Numbers\Users\Workflow\Model\Workflow\Canvas;
class Lines extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflow Canvas Lines';
	public $schema;
	public $name = 'ww_workflow_canvas_lines';
	public $pk = ['ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcnvsline_canvas_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_wrkflwcnvsline_';
	public $columns = [
		'ww_wrkflwcnvsline_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_wrkflwcnvsline_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_wrkflwcnvsline_canvas_id' => ['name' => 'Canvas #', 'domain' => 'workflow_id'],
		'ww_wrkflwcnvsline_line_right_type_id' => ['name' => 'Right Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes', 'null' => true],
		'ww_wrkflwcnvsline_line_left_type_id' => ['name' => 'Left Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes', 'null' => true],
		'ww_wrkflwcnvsline_line_style_id' => ['name' => 'Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'ww_wrkflwcnvsline_line_color' => ['name' => 'Color', 'domain' => 'html_color_code', 'default' => '000000'],
	];
	public $constraints = [
		'ww_workflow_canvas_lines_pk' => ['type' => 'pk', 'columns' => ['ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcnvsline_canvas_id']],
		'ww_wrkflwcnvsline_canvas_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcnvsline_canvas_id'],
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