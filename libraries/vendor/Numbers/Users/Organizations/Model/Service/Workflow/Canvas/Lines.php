<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Canvas;
class Lines extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Canvas Lines';
	public $schema;
	public $name = 'on_workflow_canvas_lines';
	public $pk = ['on_workcanvline_tenant_id', 'on_workcanvline_workflow_id', 'on_workcanvline_canvas_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workcanvline_';
	public $columns = [
		'on_workcanvline_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workcanvline_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workcanvline_canvas_id' => ['name' => 'Canvas #', 'domain' => 'canvas_id'],
		'on_workcanvline_line_right_type_id' => ['name' => 'Right Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes', 'null' => true],
		'on_workcanvline_line_left_type_id' => ['name' => 'Left Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes', 'null' => true],
		'on_workcanvline_line_style_id' => ['name' => 'Style #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles', 'null' => true],
		'on_workcanvline_line_color' => ['name' => 'Color', 'domain' => 'html_color_code', 'default' => '000000'],
	];
	public $constraints = [
		'on_workflow_canvas_lines_pk' => ['type' => 'pk', 'columns' => ['on_workcanvline_tenant_id', 'on_workcanvline_workflow_id', 'on_workcanvline_canvas_id']],
		'on_workcanvline_canvas_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workcanvline_tenant_id', 'on_workcanvline_workflow_id', 'on_workcanvline_canvas_id'],
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