<?php

namespace Numbers\Users\Organizations\Form\Workflow\SubType;
class Decision extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_decision_form';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Decision Form';
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
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];
	public $collection = [];
	public static $cached_next_steps;

	public function __construct($options = []) {
		$execwflow_id = (int) $options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $options['input']['on_execwflow_workflow_id'];
		// load next steps
		self::$cached_next_steps = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Next::getStatic([
			'where' => [
				'on_workstpnext_workflow_id' => $execwflow_workflow_id,
				'on_workstpnext_step_id' => $execwflow_step_id,
			],
			'pk' => ['on_workstpnext_next_step_id'],
			'orderby' => [
				'on_workstpnext_name' => SORT_ASC
			]
		]);
		$index = 1;
		$radio_options = [];
		foreach (self::$cached_next_steps as $k => $v) {
			$radio_options[$k]['name'] = $v['on_workstpnext_name'];
		}
		$this->elements['top']['row1']['chosen_step'] = [
			'order' => 1,
			'row_order' => 100,
			'label_name' => 'Decision',
			'type' => 'group_id',
			'required' => true,
			'method' => 'radio',
			'options' => $radio_options,
			'percent' => 100
		];
		// call parent constructor
		parent::__construct($options);
	}

	public function save(& $form) {
		$execwflow_id = (int) $form->options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $form->options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $form->options['input']['on_execwflow_workflow_id'];
		$model = new \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields();
		$model->db_object->begin();
		// step 1 update step
		$result = \Numbers\Users\Organizations\Helper\Workflow\Helper::processSingleStep($execwflow_workflow_id, $execwflow_id, $execwflow_step_id, [
			'on_execwfstep_chosen_step_id' => $form->values['chosen_step']
		]);
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