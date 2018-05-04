<?php

namespace Numbers\Users\Organizations\Form\Workflow\SubType;
class Assignment extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_assignment_form';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Assignments Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'user_id' => [
				'user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Users'],
			],
			self::HIDDEN => [
				'on_execwflow_linked_type_code' => ['label_name' => 'Linked Type Code', 'domain' => 'group_code', 'method' => 'hidden'],
				'on_execwflow_linked_module_id' => ['label_name' => 'Linked Module #', 'domain' => 'module_id', 'method' => 'hidden'],
				'on_execwflow_linked_id' => ['label_name' => 'Linked #', 'domain' => 'big_id', 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];
	public $collection = [];

	public function save(& $form) {
		$execwflow_id = (int) $form->options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $form->options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $form->options['input']['on_execwflow_workflow_id'];
		$model = new \Numbers\Users\Users\Model\Owner\Users();
		$model->db_object->begin();
		// step 1 fetch and add owner
		$existing_record = $model->collection()->get([
			'where' => [
				'um_owneruser_linked_type_code' => $form->values['on_execwflow_linked_type_code'],
				'um_owneruser_linked_module_id' => $form->values['on_execwflow_linked_module_id'],
				'um_owneruser_linked_id' => $form->values['on_execwflow_linked_id'],
				'um_owneruser_type_code' => 'SP'
			],
			'pk' => null,
			'for_update' => true,
			'single_row' => true
		]);
		$result = $model->collection()->merge([
			'um_owneruser_id' => $existing_record['data']['um_owneruser_id'],
			'um_owneruser_user_id' => $form->values['user_id']
		]);
		if (!$result['success']) {
			$model->db_object->rollback();
			$form->error(DANGER, $result['error']);
			return false;
		}
		// step 2 update step
		$result = \Numbers\Users\Organizations\Helper\Workflow\Helper::processSingleStep($execwflow_workflow_id, $execwflow_id, $execwflow_step_id);
		if (!$result['success']) {
			$model->db_object->rollback();
			$form->error(DANGER, $result['error']);
			return false;
		}
		$execwfstep_id = $result['new_serials']['on_execwfstep_id'];
		// step 3 insert field
		$result = \Numbers\Users\Organizations\Helper\Workflow\Helper::insertSingleField($execwflow_id, $execwfstep_id, 'SYSTEM_ASSIGNED_USER_ID', $form->values['user_id']);
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