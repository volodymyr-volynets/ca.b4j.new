<?php

namespace Numbers\Users\Organizations\Form\Workflow;
class Workflows extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_workflows_form';
	public $module_code = 'ON';
	public $title = 'O/N Workflows Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'canvas_container' => ['default_row_type' => 'grid', 'order' => 32000, 'custom_renderer' => '\Numbers\Users\Organizations\Form\Workflow\Workflows::previewCanvas'],
		'steps_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps',
			'details_pk' => ['on_execwfstep_id'],
			'details_cannot_delete' => true,
			'order' => 35000
		],
		'step_fields_container' => [
			'label_name' => 'Form Fields',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields',
			'details_pk' => ['on_execwffield_field_id'],
			'details_cannot_delete' => true,
			'order' => 35000
		],
		'step_alarms_container' => [
			'label_name' => 'Alarms',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Step\Alarms',
			'details_pk' => ['on_execwfstpalarm_alarm_code'],
			'details_cannot_delete' => true,
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'on_execwflow_id' => ['order' => 100],
			'on_execwflow_workflow_name' => ['order' => 200],
		],
		'tabs' => [
			'steps' => ['order' => 100, 'label_name' => 'Steps'],
			'canvas' => ['order' => 200, 'label_name' => 'Canvas'],
		],
	];
	public $elements = [
		'top' => [
			'on_execwflow_id' => [
				'on_execwflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Executed #', 'domain' => 'executed_workflow_id', 'percent' => 50, 'readonly' => true],
				'on_execwflow_workflow_id' => ['order' => 2, 'label_name' => 'Workflow', 'domain' => 'workflow_id', 'percent' => 50, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflows', 'readonly' => true],
			],
			'on_execwflow_workflow_name' => [
				'on_execwflow_status_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Status', 'domain' => 'type_id', 'default' => 10, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Statuses', 'readonly' => true],
				'on_execwflow_current_alarm_name' => ['order' => 2, 'label_name' => 'Current Alarm', 'domain' => 'name', 'percent' => 50, 'readonly' => true],
			],
		],
		'tabs' => [
			'steps' => [
				'steps' => ['container' => 'steps_container', 'order' => 100],
			],
			'canvas' => [
				'canvas' => ['container' => 'canvas_container', 'order' => 100],
			],
		],
		'steps_container' => [
			'row1' => [
				'on_execwfstep_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Step Name', 'domain' => 'name', 'percent' => 100, 'readonly' => true],
			],
			self::HIDDEN => [
				'on_execwfstep_step_id' => ['label_name' => 'Step #', 'domain' => 'step_id', 'method' => 'hidden'],
			]
		],
		'step_fields_container' => [
			'row1' => [
				'on_execwffield_field_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Field Name', 'domain' => 'field_id', 'percent' => 50, 'readonly' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields'],
				'on_execwffield_field_value' => ['order' => 2, 'label_name' => 'Field Value', 'type' => 'mixed', 'percent' => 50, 'readonly' => true, 'custom_renderer' => '\Numbers\Users\Organizations\Form\Workflow\Workflows::renderFormFieldValue'],
			],
			self::HIDDEN => [
				'on_execwffield_php_type' => ['label_name' => 'PHP Type', 'domain' => 'code', 'method' => 'hidden'],
				'on_execwffield_value_integer' => ['label_name' => 'Value (Integer)', 'type' => 'bigint', 'null' => true, 'method' => 'hidden'],
				'on_execwffield_value_numeric' => ['label_name' => 'Value (Numeric)', 'type' => 'numeric', 'null' => true, 'method' => 'hidden'],
				'on_execwffield_value_timestamp' => ['label_name' => 'Value (Timestamp)', 'type' => 'timestamp', 'null' => true, 'method' => 'hidden'],
				'on_execwffield_value_text' => ['label_name' => 'Value (Text)', 'type' => 'text', 'null' => true, 'method' => 'hidden'],
				'on_execwffield_value_mixed' => ['label_name' => 'Value (Mixed)', 'type' => 'json', 'null' => true, 'method' => 'hidden'],
			]
		],
		'step_alarms_container' => [
			'row1' => [
				'on_execwfstpalarm_alarm_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Alarm Code', 'domain' => 'group_code', 'percent' => 50, 'readonly' => true],
				'on_execwfstpalarm_alarm_name' => ['order' => 2, 'label_name' => 'Alarm Name', 'domain' => 'name', 'percent' => 50, 'readonly' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				//self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];
	public $collection = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflows',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps' => [
				'name' => 'Steps',
				'readonly' => true,
				'pk' => ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id', 'on_execwfstep_id'],
				'type' => '1M',
				'map' => ['on_execwflow_tenant_id' => 'on_execwfstep_tenant_id', 'on_execwflow_id' => 'on_execwfstep_execwflow_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields' => [
						'name' => 'Form Fields',
						'readonly' => true,
						'pk' => ['on_execwffield_tenant_id', 'on_execwffield_execwflow_id', 'on_execwffield_execwfstep_id', 'on_execwffield_field_id'],
						'type' => '1M',
						'map' => ['on_execwfstep_tenant_id' => 'on_execwffield_tenant_id', 'on_execwfstep_execwflow_id' => 'on_execwffield_execwflow_id', 'on_execwfstep_id' => 'on_execwffield_execwfstep_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Step\Alarms' => [
						'name' => 'Step Alarms',
						'readonly' => true,
						'pk' => ['on_execwfstpalarm_tenant_id', 'on_execwfstpalarm_execwflow_id', 'on_execwfstpalarm_execwfstep_id', 'on_execwfstpalarm_alarm_code'],
						'type' => '1M',
						'map' => ['on_execwfstep_tenant_id' => 'on_execwfstpalarm_tenant_id', 'on_execwfstep_execwflow_id' => 'on_execwfstpalarm_execwflow_id', 'on_execwfstep_id' => 'on_execwfstpalarm_execwfstep_id'],
					]
				]
			]
		]
	];

	public function refresh(& $form) {

	}

	public function validate(& $form) {

	}

	public function renderFormFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		$temp = $neighbouring_values['on_execwffield_value_' . $neighbouring_values['on_execwffield_php_type']];
		if ($neighbouring_values['on_execwffield_php_type'] == 'timestamp') {
			$temp = \Format::timestamp($temp);
		}
		return '<div class="form-control" readonly="readonly">' . $temp . '</div>';
	}

	public function previewCanvas(& $form) {
		$executed_steps = array_extract_values_by_key($form->values['\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps'], 'on_execwfstep_step_id');
		return \Numbers\Users\Organizations\Helper\Workflow\Helper::previewWorkflow($form->values['on_execwflow_workflow_id'], $executed_steps);
	}
}