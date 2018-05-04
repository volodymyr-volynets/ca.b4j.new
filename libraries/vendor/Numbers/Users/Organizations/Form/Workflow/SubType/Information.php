<?php

namespace Numbers\Users\Organizations\Form\Workflow\SubType;
class Information extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_information_form';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Information Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100, 'custom_renderer' => '\Numbers\Users\Organizations\Form\Workflow\SubType\Information::renderInformation'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_CONTINUE_DATA,
			]
		]
	];
	public $collection = [];

	public function renderInformation(& $form) {
		$execwflow_id = (int) $form->options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $form->options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $form->options['input']['on_execwflow_workflow_id'];
		// load complementary
		$info_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary::getStatic([
			'where' => [
				'on_workstpcomp_workflow_id' => $execwflow_workflow_id,
				'on_workstpcomp_step_id' => $execwflow_step_id,
			],
			'pk' => null,
			'single_row' => true
		]);
		return $info_result['on_workstpcomp_description'];
	}

	public function save(& $form) {
		$execwflow_id = (int) $form->options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $form->options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $form->options['input']['on_execwflow_workflow_id'];
		$model = new \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields();
		$model->db_object->begin();
		// step 1 update step
		$result = \Numbers\Users\Organizations\Helper\Workflow\Helper::processSingleStep($execwflow_workflow_id, $execwflow_id, $execwflow_step_id);
		if (!$result['success']) {
			$model->db_object->rollback();
			$form->error(DANGER, $result['error']);
			return false;
		}
		$model->db_object->commit();
		return true;
	}

	public function success(& $form) {
		$form->redirectOnSuccess();
	}
}