<?php

namespace Numbers\Users\Workflow\Form\Account;
class ContinueWorkflow extends \Object\Form\Wrapper\Base {
	public $form_link = 'ww_account_continue_workflow';
	public $module_code = 'WW';
	public $title = 'W/W Account Continue Workflow';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => ['href' => '/Numbers/Users/Workflow/Controller/Account/Workflows/_New?__submit_blank=1']
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'ww_execwflow_id' => [
				'ww_execwflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow #', 'domain' => 'workflow_id_sequence', 'percent' => 95, 'navigation' => true],
				'ww_execwflow_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'ww_execwflow_assignment_name' => [
				'ww_execwflow_assignment_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Assignment Name', 'domain' => 'name', 'percent' => 100, 'readonly' => true],
			],
			'ww_execwflow_workflow_name' => [
				'ww_execwflow_workflow_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Workflow Name', 'domain' => 'name', 'percent' => 100, 'readonly' => true],
			],
			'ww_execwflow_status_id' => [
				'ww_execwflow_status_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Status', 'domain' => 'type_id', 'percent' => 50, 'readonly' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Executed\Workflow\Statuses'],
			],
			self::HIDDEN => [
				'ww_execwflow_assignment_id' => ['label_name' => 'Assignment #', 'domain' => 'service_id', 'method' => 'hidden'],
				'ww_execwflow_workflow_id' => ['label_name' => 'Workflow #', 'domain' => 'workflow_id', 'method' => 'hidden'],
			],
			self::BUTTONS => [
				self::BUTTON_CONTINUE => self::BUTTON_CONTINUE_DATA,
				self::BUTTON_STOP => self::BUTTON_STOP_DATA
			]
		]
	];
	public $collection = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Workflow\Model\Executed\Workflows',
	];

	public function validate(& $form) {
		// put this workflow into sessions
		if (!empty($form->process_submit[self::BUTTON_CONTINUE])) {
			\Session::set(['numbers', 'workflow', 'workflow_id'], $form->values['ww_execwflow_workflow_id']);
			\Session::set(['numbers', 'workflow', 'assignment_id'], $form->values['ww_execwflow_assignment_id']);
			\Session::set(['numbers', 'workflow', 'execution_id'], $form->values['ww_execwflow_id']);
			$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		}
		// remove workflow from session
		if (!empty($form->process_submit[self::BUTTON_STOP])) {
			\Session::set(['numbers', 'workflow'], []);
			$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		}
	}

	public function save(& $form) {
		return false;
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == self::BUTTON_STOP) {
			$workflow_id = \Session::get(['numbers', 'workflow', 'execution_id']);
			if (empty($workflow_id)) {
				$options['options']['method'] = 'hidden';
			}
		}
		if ($options['options']['field_name'] == self::BUTTON_CONTINUE) {
			$workflow_id = \Session::get(['numbers', 'workflow', 'execution_id']);
			if ($workflow_id == $form->values['ww_execwflow_id']) {
				$options['options']['method'] = 'hidden';
			}
		}
	}
}