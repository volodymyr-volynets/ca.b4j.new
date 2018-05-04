<?php

namespace Numbers\Users\Organizations\Form\Workflow\SubType;
class Form extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_form_form';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Form Form';
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

	public static $cached_workflow_fields;
	public static $cached_all_fields;
	public static $cached_all_models;

	public function __construct($options = []) {
		$execwflow_id = (int) $options['input']['on_execwflow_id'];
		$execwflow_step_id = (int) $options['input']['on_execwflow_step_id'];
		$execwflow_workflow_id = (int) $options['input']['on_execwflow_workflow_id'];
		// pull fields
		self::$cached_workflow_fields = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields::getStatic([
			'where' => [
				'on_workstpfield_workflow_id' => $execwflow_workflow_id,
				'on_workstpfield_step_id' => $execwflow_step_id,
			],
			'pk' => ['on_workstpfield_field_id'],
			'orderby' => [
				'on_workstpfield_order' => SORT_ASC
			]
		]);
		self::$cached_all_fields = \Numbers\Users\Organizations\Model\Service\Workflow\Fields::getStatic([
			'pk' => ['on_workfield_id']
		]);
		self::$cached_all_models = \Numbers\Backend\Db\Common\Model\Models::getStatic([
			'pk' => ['sm_model_id']
		]);
		// add fields
		foreach (self::$cached_workflow_fields as $k => $v) {
			// fix text
			$method = self::$cached_all_fields[$k]['on_workfield_method'];
			if ($method == 'boolean') $method = 'checkbox';
			$this->elements['top'][$v['on_workstpfield_row_id']]['field_' . $k] = [
				'order' => 1,
				'row_order' => $v['on_workstpfield_order'],
				'label_name' => self::$cached_all_fields[$k]['on_workfield_name'],
				'domain' => self::$cached_all_fields[$k]['on_workfield_domain'],
				'type' => self::$cached_all_fields[$k]['on_workfield_type'],
				'default' => $v['on_workstpfield_default'],
				'method' => $method,
				'required' => $v['on_workstpfield_required'],
				'percent' => $v['on_workstpfield_percent']
			];
			if (!empty(self::$cached_all_fields[$k]['on_workfield_model_id'])) {
				$this->elements['top'][$v['on_workstpfield_row_id']]['field_' . $k]['options_model'] = self::$cached_all_models[self::$cached_all_fields[$k]['on_workfield_model_id']]['sm_model_code'];
			}
			// calendar fields
			if (in_array(self::$cached_all_fields[$k]['on_workfield_type'], ['date', 'time', 'datetime', 'timestamp'])) {
				$this->elements['top'][$v['on_workstpfield_row_id']]['field_' . $k]['method'] = 'calendar';
				$this->elements['top'][$v['on_workstpfield_row_id']]['field_' . $k]['calendar_icon'] = 'right';
			}
		}
		// call parent constructor
		parent::__construct($options);
	}

	public function validate(& $form) {

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
		$execwfstep_id = $result['new_serials']['on_execwfstep_id'];
		foreach (self::$cached_workflow_fields as $k => $v) {
			$field_code = self::$cached_all_fields[$k]['on_workfield_code'];
			$field_result = \Numbers\Users\Organizations\Helper\Workflow\Helper::insertSingleField($execwflow_id, $execwfstep_id, $field_code, $form->values['field_' . $k]);
			if (!$field_result['success']) {
				$model->db_object->rollback();
				$form->error(DANGER, $field_result['error']);
				return false;
			}
		}
		$model->db_object->commit();
		return true;
	}

	public function success(& $form) {
		$form->redirectOnSuccess();
	}
}