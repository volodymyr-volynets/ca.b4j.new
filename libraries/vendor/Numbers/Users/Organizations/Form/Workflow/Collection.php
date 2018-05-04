<?php

namespace Numbers\Users\Organizations\Form\Workflow;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'on_workflow_executing_collection';
	public $data = [];
	public $__options;

	public function __construct($options = []) {
		$on_execwflow_linked_type_code = $options['input']['__linked_type_code'];
		$on_execwflow_linked_module_id = (int) $options['input']['__linked_module_id'];
		$on_execwflow_linked_id = (int) $options['input']['__linked_id'];
		$workflows_data = [];
		$workflows_model = new \Numbers\Users\Organizations\Model\Service\Executed\Workflows();
		if (!empty($on_execwflow_linked_id) && !empty($on_execwflow_linked_module_id) && !empty($on_execwflow_linked_type_code)) {
			$workflows_data = $workflows_model->get([
				'where' => [
					'on_execwflow_linked_type_code' => $on_execwflow_linked_type_code,
					'on_execwflow_linked_module_id' => $on_execwflow_linked_module_id,
					'on_execwflow_linked_id' => $on_execwflow_linked_id,
				],
				'pk' => ['on_execwflow_id'],
				'orderby' => [
					'on_execwflow_id' => SORT_DESC
				]
			]);
		}
		if (!empty($workflows_data)) {
			$this->data = [
				self::MAIN_SCREEN => [
					'options' => [
						'type' => 'forms',
					],
					'order' => 1000,
					self::ROWS => []
				]
			];
			$index = 1;
			foreach ($workflows_data as $k => $v) {
				$input = $options['input'];
				$input['on_execwflow_id'] = $k;
				$this->data[self::MAIN_SCREEN][self::ROWS]['row' . $k] = [
					'order' => $index,
					'options' => [
						'type' => 'tabs',
						'segment' => [
							'type' => 'success',
							'header' => [
								'icon' => ['type' => ' fab fa-hubspot'],
								'title' => 'Workflow: ' . $v['on_execwflow_workflow_name']
							]
						],
						'its_own_segment' => true
					]
				];
				$this->data[self::MAIN_SCREEN][self::ROWS]['row' . $k][self::FORMS]['on_workflow_form_id_' . $k] = [
					'model' => '\Numbers\Users\Organizations\Form\Workflow\Workflows',
					'options' => [
						'label_name' => 'Workflow',
						'form_link' => 'on_workflow_form_id_' . $k,
						'percent' => 100,
						'input' => $input,
						'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
					],
					'order' => $index
				];
				$index++;
				// render next step
				$next_result = \Numbers\Users\Organizations\Helper\Workflow\Helper::prepareForRenderNextStep($v['on_execwflow_workflow_id'], $k);
				if ($next_result['success']) {
					$input['on_execwflow_id'] = $k;
					$input['on_execwflow_step_id'] = $next_result['step_id'];
					$input['on_execwflow_workflow_id'] = $v['on_execwflow_workflow_id'];
					$input['on_execwflow_linked_type_code'] = $on_execwflow_linked_type_code;
					$input['on_execwflow_linked_module_id'] = $on_execwflow_linked_module_id;
					$input['on_execwflow_linked_id'] = $on_execwflow_linked_id;
					$input['__anchor'] = "form_on_workflow_form_id_{$k}_next_form_anchor";
					$this->data[self::MAIN_SCREEN][self::ROWS]['row' . $k][self::FORMS]['on_workflow_form_id_' . $k . '_next'] = [
						'model' => $next_result['form_model'],
						'options' => [
							'label_name' => 'Next Step',
							'form_link' => 'on_workflow_form_id_' . $k . '_next',
							'percent' => 100,
							'input' => $input,
							'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
						],
						'order' => $index
					];
					$index++;
				}
			}
		}
		// call parent constructor
		parent::__construct($options);
	}

	public function distribute() {

	}
}