<?php

namespace Numbers\Users\Workflow\Form;
class Workflows extends \Object\Form\Wrapper\Base {
	public $form_link = 'ww_workflows';
	public $module_code = 'WW';
	public $title = 'W/W Workflows Form';
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
		'canvas_preview_container' => ['default_row_type' => 'grid', 'order' => 32000, 'custom_renderer' => '\Numbers\Users\Workflow\Form\Workflows::previewCanvas'],
		'canvas_global_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'steps_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Workflow\Model\Workflow\Steps',
			'details_pk' => ['ww_wrkflwstep_id'],
			'details_autoincrement' => ['ww_wrkflwstep_id'],
			'required' => true,
			'order' => 34000
		],
		'canvas_local_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Workflow\Model\Workflow\Canvas',
			'details_pk' => ['ww_wrkflwcanvas_id'],
			'details_autoincrement' => ['ww_wrkflwcanvas_id'],
			'order' => 35000
		],
		'canvas_lines_container' => [
			'label_name' => 'Line Settings',
			'type' => 'subdetails',
			'details_rendering_type' => 'grid_with_label',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Workflow\Model\Workflow\Canvas',
			'details_key' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines',
			'details_pk' => ['ww_wrkflwcnvsline_canvas_id'],
			'details_11' => true,
			'details_cannot_delete' => true,
			'order' => 35001
		],
		'canvas_rectangles_container' => [
			'label_name' => 'Shape Settings',
			'type' => 'subdetails',
			'details_rendering_type' => 'grid_with_label',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Workflow\Model\Workflow\Canvas',
			'details_key' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes',
			'details_pk' => ['ww_wrkflwcnvsshape_canvas_id'],
			'details_11' => true,
			'details_cannot_delete' => true,
			'order' => 35002
		],
		'next_steps_container' => [
			'label_name' => 'Next Steps',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Workflow\Model\Workflow\Steps',
			'details_key' => '\Numbers\Users\Workflow\Model\Workflow\Step\Next',
			'details_pk' => ['ww_wrkflwstepnext_next_step_id'],
			'order' => 35003
		],
	];

	public $rows = [
		'top' => [
			'ww_workflow_id' => ['order' => 100],
			'ww_workflow_name' => ['order' => 200],
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
			'ww_workflow_id' => [
				'ww_workflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow #', 'domain' => 'workflow_id_sequence', 'percent' => 50, 'required' => false, 'navigation' => true],
				'ww_workflow_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 45, 'required' => true, 'navigation' => true],
				'ww_workflow_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'ww_workflow_name' => [
				'ww_workflow_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			self::HIDDEN => [
				'ww_workflow_versioned' => ['label_name' => 'Versioned', 'type' => 'boolean', 'method' => 'hidden'],
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
			'ww_workflow_icon' => [
				'ww_workflow_icon' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'steps_container' => [
			'row1' => [
				'ww_wrkflwstep_order' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 15],
				'ww_wrkflwstep_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 55, 'null' => true, 'required' => true],
				'ww_wrkflwstep_type_id' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Step\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
				'ww_wrkflwstep_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'ww_wrkflwstep_page_resource_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Page Resource', 'domain' => 'resource_id', 'required' => true, 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\ACL\Controllers2::optionsJson', 'options_params' => ['sm_resource_acl_permission' => 1], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'ww_wrkflwstep_page_module_id', 'resource_id' => 'ww_wrkflwstep_page_resource_id']],
			],
			self::HIDDEN => [
				'ww_wrkflwstep_id' => ['label_name' => 'Step #', 'domain' => 'workflow_id', 'null' => true, 'method' => 'hidden'],
				'ww_wrkflwstep_page_module_id' => ['label_name' => 'Page Module #', 'domain' => 'module_id', 'required' => true, 'null' => true, 'method' => 'hidden'],
			]
		],
		'canvas_global_container' => [
			'ww_workflow_canvas_width' => [
				'ww_workflow_canvas_width' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Canvas Width', 'domain' => 'dimension', 'required' => true, 'percent' => 50],
				'ww_workflow_canvas_height' => ['order' => 2, 'label_name' => 'Canvas Height', 'domain' => 'dimension', 'required' => true, 'percent' => 50],
			]
		],
		'canvas_local_container' => [
			'row1' => [
				'ww_wrkflwcanvas_order' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 15],
				'ww_wrkflwcanvas_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'null' => true],
				'ww_wrkflwcanvas_type_id' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\Types', 'onchange' => 'this.form.submit();'],
				'ww_wrkflwcanvas_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'ww_wrkflwcanvas_x1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'X1 (Start)', 'domain' => 'dimension', 'required' => true, 'percent' => 25, 'placeholder' => 'X1 (Start)'],
				'ww_wrkflwcanvas_y1' => ['order' => 2, 'label_name' => 'Y1 (Start)', 'domain' => 'dimension', 'required' => true, 'percent' => 25, 'placeholder' => 'Y1 (Start)'],
				'ww_wrkflwcanvas_x2' => ['order' => 3, 'label_name' => 'X2 (Width)', 'domain' => 'dimension', 'required' => false, 'percent' => 25, 'placeholder' => 'X2 (Width)'],
				'ww_wrkflwcanvas_y2' => ['order' => 4, 'label_name' => 'Y2 (Height)', 'domain' => 'dimension', 'required' => false, 'percent' => 25, 'placeholder' => 'Y2 (Height)'],
			],
			'row3' => [
				'ww_wrkflwcanvas_step_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Step', 'domain' => 'workflow_id', 'null' => true, 'percent' =>50, 'placeholder' => 'Step', 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Steps::optionsActive', 'options_depends' => ['ww_wrkflwstep_workflow_id' => 'parent::ww_workflow_id']],
			],
			self::HIDDEN => [
				'ww_wrkflwcanvas_id' => ['label_name' => 'Canvas #', 'domain' => 'workflow_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'canvas_lines_container' => [
			'row1' => [
				'ww_wrkflwcnvsline_line_left_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Left Type', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes'],
				'ww_wrkflwcnvsline_line_right_type_id' => ['order' => 3, 'label_name' => 'Right Type', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineTypes'],
				'ww_wrkflwcnvsline_line_style_id' => ['order' => 3, 'label_name' => 'Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'ww_wrkflwcnvsline_line_color' => ['order' => 4, 'label_name' => 'Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			]
		],
		'canvas_rectangles_container' => [
			'row1' => [
				'ww_wrkflwcnvsshape_shape_border_style_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Border Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'ww_wrkflwcnvsshape_shape_border_color' => ['order' => 2, 'label_name' => 'Border Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
				'ww_wrkflwcnvsshape_shape_fill_color' => ['order' => 3, 'label_name' => 'Fill Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			],
			'row2' => [
				'ww_wrkflwcnvsshape_completed_border_style_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Completed Border Style', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Canvas\LineStyles'],
				'ww_wrkflwcnvsshape_completed_border_color' => ['order' => 2, 'label_name' => 'Completed Border Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
				'ww_wrkflwcnvsshape_completed_fill_color' => ['order' => 3, 'label_name' => 'Completed Fill Color', 'domain' => 'html_color_code', 'null' => true, 'percent' => 25, 'method' => 'select', 'color_picker' => true, 'searchable' => true, 'tree' => true, 'options_model' => '\Numbers\Frontend\HTML\Renderers\Common\Colors::optgroups'],
			]
		],
		'next_steps_container' => [
			'row1' => [
				'ww_wrkflwstepnext_next_step_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Step', 'domain' => 'workflow_id', 'null' => true, 'percent' => 85, 'placeholder' => 'Step', 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Steps::optionsActive', 'options_depends' => ['ww_wrkflwstep_workflow_id' => 'parent::ww_workflow_id']],
				'ww_wrkflwstepnext_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Workflow\Model\Workflows',
		'details' => [
			'\Numbers\Users\Workflow\Model\Workflow\Canvas' => [
				'name' => 'Canvas',
				'pk' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_id'],
				'type' => '1M',
				'map' => ['ww_workflow_tenant_id' => 'ww_wrkflwcanvas_tenant_id', 'ww_workflow_id' => 'ww_wrkflwcanvas_workflow_id'],
				'details' => [
					'\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines' => [
						'name' => 'Line Settings',
						'pk' => ['ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcnvsline_canvas_id'],
						'type' => '11',
						'map' => ['ww_wrkflwcanvas_tenant_id' => 'ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcanvas_workflow_id' => 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcanvas_id' => 'ww_wrkflwcnvsline_canvas_id']
					],
					'\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes' => [
						'name' => 'Shape Settings',
						'pk' => ['ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcnvsshape_canvas_id'],
						'type' => '11',
						'map' => ['ww_wrkflwcanvas_tenant_id' => 'ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcanvas_workflow_id' => 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcanvas_id' => 'ww_wrkflwcnvsshape_canvas_id']
					]
				]
			],
			'\Numbers\Users\Workflow\Model\Workflow\Steps' => [
				'name' => 'Steps',
				'pk' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id'],
				'type' => '1M',
				'map' => ['ww_workflow_tenant_id' => 'ww_wrkflwstep_tenant_id', 'ww_workflow_id' => 'ww_wrkflwstep_workflow_id'],
				'details' => [
					'\Numbers\Users\Workflow\Model\Workflow\Step\Next' => [
						'name' => 'Next Steps',
						'pk' => ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_step_id', 'ww_wrkflwstepnext_next_step_id'],
						'type' => '1M',
						'map' => ['ww_wrkflwstep_tenant_id' => 'ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstep_workflow_id' => 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstep_id' => 'ww_wrkflwstepnext_step_id'],
					]
				]
			]
		]
	];

	public function validate(& $form) {

	}

	public function refresh(& $form) {
		if (!empty($form->values['ww_workflow_versioned'])) {
			$form->misc_settings['global']['readonly'] = true;
		}
	}

	public function overrideTabs(& $form, & $tab_options, & $tab_name, & $neighbouring_values = []) {
		if ($tab_name == '\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines') {
			if ($neighbouring_values['ww_wrkflwcanvas_type_id'] != 2000) {
				return ['hidden' => true];
			}
		}
		if ($tab_name == '\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes') {
			if (!in_array($neighbouring_values['ww_wrkflwcanvas_type_id'], [1000, 1100, 3000, 4000])) {
				return ['hidden' => true];
			}
		}
	}

	public function previewCanvas(& $form) {
		$data = [];
		foreach ($form->values['\Numbers\Users\Workflow\Model\Workflow\Canvas'] as $k => $v) {
			if (!empty($v['ww_wrkflwcanvas_inactive'])) continue;
			$data[$k] = [
				'order' => $v['ww_wrkflwcanvas_order'],
				'type' => $v['ww_wrkflwcanvas_type_id'],
				'name' => $v['ww_wrkflwcanvas_name'],
				'x1' => $v['ww_wrkflwcanvas_x1'],
				'x2' => $v['ww_wrkflwcanvas_x2'],
				'y1' => $v['ww_wrkflwcanvas_y1'],
				'y2' => $v['ww_wrkflwcanvas_y2'],
				// line attributes
				'line_left_type' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_left_type_id'] ?? 10,
				'line_right_type' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_right_type_id'] ?? 10,
				'line_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_style_id'] ?? 10,
				'line_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_color'] ?? '000000',
				// shape attributes
				'shape_border_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_border_style_id'] ?? 10,
				'shape_border_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_border_color'] ?? '000000',
				'shape_fill_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_fill_color'] ?? 'FFFFFF',
				'completed_border_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_border_style_id'] ?? 10,
				'completed_border_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_border_color'] ?? '000000',
				'completed_fill_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_fill_color'] ?? 'FFFFFF',
			];
		}
		$result = \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $form->values['ww_workflow_canvas_width'],
			'height' => $form->values['ww_workflow_canvas_height'],
			'show_as_completed' => false
		]);
		$result.= '<hr/>';
		$result.= \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $form->values['ww_workflow_canvas_width'],
			'height' => $form->values['ww_workflow_canvas_height'],
			'show_as_completed' => true
		]);
		return $result;
	}
}