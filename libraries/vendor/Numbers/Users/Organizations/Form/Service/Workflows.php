<?php

namespace Numbers\Users\Organizations\Form\Service;
class Workflows extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflows';
	public $module_code = 'ON';
	public $title = 'O/N Workflows Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'canvas_preview_container' => ['default_row_type' => 'grid', 'order' => 32000, 'custom_renderer' => '\Numbers\Users\Organizations\Form\Service\Workflows::previewCanvas'],
		'canvas_global_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'steps_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'details_pk' => ['on_workstep_id'],
			'details_autoincrement' => ['on_workstep_id'],
			'required' => true,
			'order' => 34000
		],
		'canvas_local_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas',
			'details_pk' => ['on_workcanvas_id'],
			'details_autoincrement' => ['on_workcanvas_id'],
			'order' => 35000
		],
		'canvas_lines_container' => [
			'label_name' => 'Line Settings',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines',
			'details_pk' => ['on_workcanvline_canvas_id'],
			'details_11' => true,
			'details_cannot_delete' => true,
			'order' => 35001
		],
		'canvas_rectangles_container' => [
			'label_name' => 'Shape Settings',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes',
			'details_pk' => ['on_workcanvshape_canvas_id'],
			'details_11' => true,
			'details_cannot_delete' => true,
			'order' => 35002
		],
		'next_steps_container' => [
			'label_name' => 'Next Steps',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next',
			'details_pk' => ['on_workstpnext_next_step_id'],
			'order' => 35003
		],
		'form_fields_container' => [
			'label_name' => 'Form Fields',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields',
			'details_pk' => ['on_workstpfield_field_id'],
			'order' => 35003
		],
		'complementary_container' => [
			'label_name' => 'Complementary',
			'type' => 'subdetails',
			'details_rendering_type' => 'grid_with_label',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary',
			'details_pk' => ['on_workstpcomp_step_id'],
			'details_11' => true,
			'order' => 35003
		],
		'alarms_container' => [
			'label_name' => 'Alarms',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms',
			'details_pk' => ['on_workstpalarm_code'],
			'order' => 35003
		]
	];

	public $rows = [
		'top' => [
			'on_workflow_id' => ['order' => 100],
			'on_workflow_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'steps' => ['order' => 200, 'label_name' => 'Steps'],
			'canvas' => ['order' => 300, 'label_name' => 'Canvas'],
			'preview' => ['order' => 400, 'label_name' => 'Preview'],
		]
	];
	public $elements = [
		'top' => [
			'on_workflow_id' => [
				'on_workflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow #', 'domain' => 'workflow_id_sequence', 'percent' => 50, 'required' => false, 'navigation' => true],
				'on_workflow_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 45, 'required' => true, 'navigation' => true],
				'on_workflow_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_workflow_name' => [
				'on_workflow_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			self::HIDDEN => [
				'on_workflow_versioned' => ['label_name' => 'Versioned', 'type' => 'boolean', 'method' => 'hidden'],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'steps' => [
				'steps' => ['container' => 'steps_container', 'order' => 100],
			],
			'canvas' => [
				'canvas_global' => ['container' => 'canvas_global_container', 'order' => 100],
				'canvas_local' => ['container' => 'canvas_local_container', 'order' => 200],
			],
			'preview' => [
				'preview' => ['container' => 'canvas_preview_container', 'order' => 100],
			]
		],
		'general_container' => [
			'on_workflow_type_id' => [
				'on_workflow_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
				'on_workflow_parent_workflow_id' => ['order' => 2, 'label_name' => 'Parent Workflow', 'domain' => 'workflow_id', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflows::optionsActive', 'options_params' => ['on_workflow_versioned' => 0, 'on_workflow_type_id' => 10]],
			],
			'on_workflow_icon' => [
				'on_workflow_icon' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'steps_container' => [
			'row1' => [
				'on_workstep_order' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 15],
				'on_workstep_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 55, 'null' => true, 'required' => true],
				'on_workstep_code' => ['order' => 3, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 25, 'null' => true, 'required' => true],
				'on_workstep_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'on_workstep_type_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
				'on_workstep_subtype_id' => ['order' => 2, 'label_name' => 'Sub Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 25, 'placeholder' => 'Subtype', 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\SubTypes', 'onchange' => 'this.form.submit();'],
				'on_workstep_subflow_workflow_id' => ['order' => 3, 'label_name' => 'Subflow', 'domain' => 'workflow_id', 'null' => true, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflows::optionsActive', 'options_params' => ['on_workflow_versioned' => 0, 'on_workflow_type_id' => 20, 'on_workflow_parent_workflow_id' => 'parent::on_workflow_id']],
			],
			'row3' => [
				'on_workstep_dashboard_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Dashboard', 'domain' => 'dashboard_id', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboards::optionsActive'],
			],
			self::HIDDEN => [
				'on_workstep_id' => ['label_name' => 'Step #', 'domain' => 'step_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'canvas_global_container' => [
			'on_workflow_canvas_width' => [
				'on_workflow_canvas_width' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Canvas Width', 'domain' => 'dimension', 'percent' => 50],
				'on_workflow_canvas_height' => ['order' => 2, 'label_name' => 'Canvas Height', 'domain' => 'dimension', 'percent' => 50],
			]
		],
		'canvas_local_container' => [
			'row1' => [
				'on_workcanvas_order' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 15],
				'on_workcanvas_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'null' => true],
				'on_workcanvas_type_id' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Types', 'onchange' => 'this.form.submit();'],
				'on_workcanvas_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'on_workcanvas_x1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'X1 (Start)', 'domain' => 'dimension', 'required' => true, 'percent' => 25, 'placeholder' => 'X1 (Start)'],
				'on_workcanvas_y1' => ['order' => 2, 'label_name' => 'Y1 (Start)', 'domain' => 'dimension', 'required' => true, 'percent' => 25, 'placeholder' => 'Y1 (Start)'],
				'on_workcanvas_x2' => ['order' => 3, 'label_name' => 'X2 (Width)', 'domain' => 'dimension', 'required' => false, 'percent' => 25, 'placeholder' => 'X2 (Width)'],
				'on_workcanvas_y2' => ['order' => 4, 'label_name' => 'Y2 (Height)', 'domain' => 'dimension', 'required' => false, 'percent' => 25, 'placeholder' => 'Y2 (Height)'],
			],
			'row3' => [
				'on_workcanvas_step_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Step', 'domain' => 'step_id', 'null' => true, 'percent' =>50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps::optionsActive', 'options_depends' => ['on_workstep_workflow_id' => 'parent::on_workflow_id']],
			],
			self::HIDDEN => [
				'on_workcanvas_id' => ['label_name' => 'Canvas #', 'domain' => 'canvas_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'canvas_lines_container' => [
			'row1' => [
				'on_workcanvline_line_left_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Left Type', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes'],
				'on_workcanvline_line_right_type_id' => ['order' => 3, 'label_name' => 'Right Type', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes'],
				'on_workcanvline_line_style_id' => ['order' => 3, 'label_name' => 'Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'on_workcanvline_line_color' => ['order' => 4, 'label_name' => 'Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			]
		],
		'canvas_rectangles_container' => [
			'row1' => [
				'on_workcanvshape_shape_border_style_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Border Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'placeholder' => 'Border Style', 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'on_workcanvshape_shape_border_color' => ['order' => 2, 'label_name' => 'Border Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'placeholder' => 'Border Color', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
				'on_workcanvshape_shape_fill_color' => ['order' => 3, 'label_name' => 'Fill Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'placeholder' => 'Fill Color', 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			],
			'row2' => [
				'on_workcanvshape_completed_border_style_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Completed Border Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'placeholder' => 'Border Style (Completed)', 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'on_workcanvshape_completed_border_color' => ['order' => 2, 'label_name' => 'Completed Border Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'placeholder' => 'Border Color (Completed)', 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
				'on_workcanvshape_completed_fill_color' => ['order' => 3, 'label_name' => 'Completed Fill Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'placeholder' => 'Fill Color (Completed)', 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			]
		],
		'next_steps_container' => [
			'row1' => [
				'on_workstpnext_next_step_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Step', 'domain' => 'step_id', 'null' => true, 'required' => true, 'percent' =>95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps::optionsActive', 'options_depends' => ['on_workstep_workflow_id' => 'parent::on_workflow_id'], 'onchange' => 'this.form.submit();'],
				'on_workstpnext_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'on_workstpnext_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'null' => true, 'required' => true],
			]
		],
		'form_fields_container' => [
			'row1' => [
				'on_workstpfield_field_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Field #', 'domain' => 'field_id', 'null' => true, 'required' => true, 'percent' => 45, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_workstpfield_default' => ['order' => 2, 'label_name' => 'Default', 'type' => 'text', 'null' => true, 'percent' => 40, 'placeholder' => 'Default'],
				'on_workstpfield_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15],
			],
			'row2' => [
				'on_workstpfield_order' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'percent' => 25],
				'on_workstpfield_required' => ['order' => 2, 'label_name' => 'Required', 'type' => 'boolean', 'percent' => 15],
				'on_workstpfield_row_id' => ['order' => 3, 'label_name' => 'Row', 'domain' => 'code', 'default' => 'row1', 'null' => true, 'required' => true, 'percent' => 35, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Field\Rows'],
				'on_workstpfield_percent' => ['order' => 4, 'label_name' => 'Percent', 'domain' => 'percent', 'null' => true, 'required' => true, 'percent' => 25],
			]
		],
		'complementary_container' => [
			'row1' => [
				'on_workstpcomp_date_field_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Date Field', 'domain' => 'field_id', 'null' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields::optionsActive', 'options_params' => ['on_workfield_type' => 'timestamp']],
			],
			'row2' => [
				'on_workstpcomp_description' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Description / Information', 'domain' => 'description', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'wysiwyg'],
			]
		],
		'alarms_container' => [
			'row1' => [
				'on_workstpalarm_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'required' => true, 'percent' => 50, 'onchange' => 'this.form.submit();'],
				'on_workstpalarm_interval_period' => ['order' => 2, 'label_name' => 'Interval Period', 'domain' => 'group_id', 'null' => true, 'required' => true, 'percent' => 25],
				'on_workstpalarm_interval_type_id' => ['order' => 3, 'label_name' => 'Interval Type', 'domain' => 'type_id', 'default' => 10, 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarm\IntervalTypes', 'onchange' => 'this.form.submit();'],
			],
			'row1_1' => [
				'on_workstpalarm_name' => ['order' => 1, 'row_order' => 150, 'label_name' => 'Name', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 100, 'onchange' => 'this.form.submit();'],
			],
			'row2' => [
				'on_workstpalarm_business' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Business Hours', 'type' => 'boolean', 'percent' => 15, 'readonly' => true],
				'on_workstpalarm_from_step_start' => ['order' => 2, 'label_name' => 'From Step Start', 'type' => 'boolean', 'percent' => 15],
				'on_workstpalarm_from_date_field_id' => ['order' => 3, 'label_name' => 'From Date Field', 'domain' => 'field_id', 'null' => true, 'perent' => 55, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields::optionsActive', 'options_params' => ['on_workfield_type' => 'timestamp']],
				'on_workstpalarm_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			],
			'row3' => [
				'on_workstpalarm_dashboard_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Dashboard', 'domain' => 'dashboard_id', 'null' => true, 'percent' => 85, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboards::optionsActive'],
				'on_workstpalarm_order' => ['order' => 2, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'percent' => 15, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas' => [
				'name' => 'Canvas',
				'pk' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_id'],
				'type' => '1M',
				'map' => ['on_workflow_tenant_id' => 'on_workcanvas_tenant_id', 'on_workflow_id' => 'on_workcanvas_workflow_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines' => [
						'name' => 'Line Settings',
						'pk' => ['on_workcanvline_tenant_id', 'on_workcanvline_workflow_id', 'on_workcanvline_canvas_id'],
						'type' => '11',
						'map' => ['on_workcanvas_tenant_id' => 'on_workcanvline_tenant_id', 'on_workcanvas_workflow_id' => 'on_workcanvline_workflow_id', 'on_workcanvas_id' => 'on_workcanvline_canvas_id']
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes' => [
						'name' => 'Shape Settings',
						'pk' => ['on_workcanvshape_tenant_id', 'on_workcanvshape_workflow_id', 'on_workcanvshape_canvas_id'],
						'type' => '11',
						'map' => ['on_workcanvas_tenant_id' => 'on_workcanvshape_tenant_id', 'on_workcanvas_workflow_id' => 'on_workcanvshape_workflow_id', 'on_workcanvas_id' => 'on_workcanvshape_canvas_id']
					]
				]
			],
			'\Numbers\Users\Organizations\Model\Service\Workflow\Steps' => [
				'name' => 'Steps',
				'pk' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id'],
				'type' => '1M',
				'map' => ['on_workflow_tenant_id' => 'on_workstep_tenant_id', 'on_workflow_id' => 'on_workstep_workflow_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next' => [
						'name' => 'Next Steps',
						'pk' => ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_step_id', 'on_workstpnext_next_step_id'],
						'type' => '1M',
						'map' => ['on_workstep_tenant_id' => 'on_workstpnext_tenant_id', 'on_workstep_workflow_id' => 'on_workstpnext_workflow_id', 'on_workstep_id' => 'on_workstpnext_step_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields' => [
						'name' => 'Form Fields',
						'pk' => ['on_workstpfield_tenant_id', 'on_workstpfield_workflow_id', 'on_workstpfield_step_id', 'on_workstpfield_field_id'],
						'type' => '1M',
						'map' => ['on_workstep_tenant_id' => 'on_workstpfield_tenant_id', 'on_workstep_workflow_id' => 'on_workstpfield_workflow_id', 'on_workstep_id' => 'on_workstpfield_step_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary' => [
						'name' => 'Complementary',
						'pk' => ['on_workstpcomp_tenant_id', 'on_workstpcomp_workflow_id', 'on_workstpcomp_step_id'],
						'type' => '11',
						'map' => ['on_workstep_tenant_id' => 'on_workstpcomp_tenant_id', 'on_workstep_workflow_id' => 'on_workstpcomp_workflow_id', 'on_workstep_id' => 'on_workstpcomp_step_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms' => [
						'name' => 'Alarms',
						'pk' => ['on_workstpalarm_tenant_id', 'on_workstpalarm_workflow_id', 'on_workstpalarm_step_id', 'on_workstpalarm_code'],
						'type' => '1M',
						'map' => ['on_workstep_tenant_id' => 'on_workstpalarm_tenant_id', 'on_workstep_workflow_id' => 'on_workstpalarm_workflow_id', 'on_workstep_id' => 'on_workstpalarm_step_id'],
					]
				]
			]
		]
	];

	public function validate(& $form) {
		// steps
		foreach ($form->values['\Numbers\Users\Organizations\Model\Service\Workflow\Steps'] as $k => $v) {
			// not ending step must have next steps
			/*
			if ($v['on_workstep_type_id'] != 30 && empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\Workflow\Steps[{$k}][\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next][1][on_workstpnext_next_step_id]");
			}
			*/
			// not decission must have one step
			if ($v['on_workstep_subtype_id'] != 200 && count($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next']) > 1) {
				$form->error(DANGER, 'Only one next step allowed!', "\Numbers\Users\Organizations\Model\Service\Workflow\Steps[{$k}][on_workstep_subtype_id]");
			}
			// form subtype must have form fields
			if ($v['on_workstep_subtype_id'] == 100 && empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\Workflow\Steps[{$k}][\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields][1][on_workstpfield_field_id]");
			}
			// information
			if ($v['on_workstep_subtype_id'] == 300 && empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary']['on_workstpcomp_description'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\Workflow\Steps[{$k}][\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary][on_workstpcomp_description]");
			}
			// step fields
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields'])) {
				$temp = [];
				foreach ($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields'] as $k2 => $v2) {
					if (!isset($temp[$v2['on_workstpfield_row_id']])) {
						$temp[$v2['on_workstpfield_row_id']][1] = $v2['on_workstpfield_percent'];
						$temp[$v2['on_workstpfield_row_id']][2] = [$k2];
					} else {
						$temp[$v2['on_workstpfield_row_id']][1]+= $v2['on_workstpfield_percent'];
						$temp[$v2['on_workstpfield_row_id']][2][] = $k2;
					}
				}
				foreach ($temp as $k2 => $v2) {
					if ($v2[1] != 100) {
						foreach ($v2[2] as $v3) {
							$form->error(DANGER, 'Sum is not 100%!', "\Numbers\Users\Organizations\Model\Service\Workflow\Steps[{$k}][\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields][{$v3}][on_workstpfield_percent]");
						}
					}
				}
			}
		}
	}

	public function refresh(& $form) {
		if (!empty($form->values['on_workflow_versioned'])) {
			$form->misc_settings['global']['readonly'] = true;
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'on_workflow_parent_workflow_id') {
			if ($neighbouring_values['on_workflow_type_id'] != 20) {
				$options['options']['readonly'] = true;
			}
		}
		if (in_array($options['options']['field_name'], ['on_workcanvshape_shape_border_style_id', 'on_workcanvshape_shape_border_color', 'on_workcanvshape_completed_border_style_id', 'on_workcanvshape_completed_border_color'])) {
			if (($options['options']['__detail_values']['on_workcanvas_type_id'] ?? null) == 4000) {
				$options['options']['readonly'] = true;
			}
		}
	}

	public function overrideTabs(& $form, & $tab_options, & $tab_name, & $neighbouring_values = []) {
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines') {
			if ($neighbouring_values['on_workcanvas_type_id'] != 2000) {
				return ['hidden' => true];
			}
		}
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes') {
			if (!in_array($neighbouring_values['on_workcanvas_type_id'], [1000, 1100, 3000, 4000])) {
				return ['hidden' => true];
			}
		}
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields') {
			if ($neighbouring_values['on_workstep_subtype_id'] != 100) {
				return ['hidden' => true];
			}
		}
	}

	public function previewCanvas(& $form) {
		$data = [];
		foreach ($form->values['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas'] as $k => $v) {
			if (!empty($v['on_workcanvas_inactive'])) continue;
			$data[$k] = [
				'order' => $v['on_workcanvas_order'],
				'type' => $v['on_workcanvas_type_id'],
				'name' => $v['on_workcanvas_name'],
				'x1' => $v['on_workcanvas_x1'],
				'x2' => $v['on_workcanvas_x2'],
				'y1' => $v['on_workcanvas_y1'],
				'y2' => $v['on_workcanvas_y2'],
				// line attributes
				'line_left_type' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_left_type_id'] ?? 10,
				'line_right_type' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_right_type_id'] ?? 10,
				'line_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_style_id'] ?? 10,
				'line_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_color'] ?? '000000',
				// shape attributes
				'shape_border_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_border_style_id'] ?? 10,
				'shape_border_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_border_color'] ?? '000000',
				'shape_fill_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_fill_color'] ?? 'FFFFFF',
				'completed_border_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_border_style_id'] ?? 10,
				'completed_border_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_border_color'] ?? '000000',
				'completed_fill_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_fill_color'] ?? 'FFFFFF',
			];
		}
		$result = \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $form->values['on_workflow_canvas_width'],
			'height' => $form->values['on_workflow_canvas_height'],
			'show_as_completed' => false
		]);
		$result.= '<hr/>';
		$result.= \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $form->values['on_workflow_canvas_width'],
			'height' => $form->values['on_workflow_canvas_height'],
			'show_as_completed' => true
		]);
		return $result;
	}
}