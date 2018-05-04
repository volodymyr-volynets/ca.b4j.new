<?php

namespace Numbers\Users\Workflow\Form\Account;
class StartWorkflow extends \Object\Form\Wrapper\Base {
	public $form_link = 'ww_account_start_workflow';
	public $module_code = 'WW';
	public $title = 'W/W Account Start Workflow';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'ww_execwflow_assignment_id' => [
				'ww_execwflow_assignment_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Assignment', 'domain' => 'service_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\DataSource\Assignments::optionsActive'],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		]
	];

	public function save(& $form) {
		$assignment = \Numbers\Users\Workflow\Model\Assignments::getStatic([
			'where' => [
				'ww_assignment_id' => $form->values['ww_execwflow_assignment_id'],
			],
			'pk' => null
		]);
		$workflow = \Numbers\Users\Workflow\Model\Workflows::getStatic([
			'where' => [
				'ww_workflow_id' => $assignment[0]['ww_assignment_workflow_id'],
			],
			'pk' => null
		]);
		$data = [
			'ww_execwflow_assignment_id' => $form->values['ww_execwflow_assignment_id'],
			'ww_execwflow_assignment_name' => $assignment[0]['ww_assignment_name'],
			'ww_execwflow_workflow_id' => $assignment[0]['ww_assignment_workflow_id'],
			'ww_execwflow_workflow_name' => $workflow[0]['ww_workflow_name'],
			'ww_execwflow_user_id' => \User::id(),
			'ww_execwflow_inactive' => 0
		];
		$merge_result = \Numbers\Users\Workflow\Model\Executed\Workflows::collectionStatic()->merge($data);
		if (!$merge_result['success']) {
			$form->error(DANGER, $merge_result['error']);
			return;
		}
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		// redirect
		\Request::redirect('/Numbers/Users/Workflow/Controller/Account/Workflows/_Edit?ww_execwflow_id=' . $merge_result['new_pk']['ww_execwflow_id']);
	}
}