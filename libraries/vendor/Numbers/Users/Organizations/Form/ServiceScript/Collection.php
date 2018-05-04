<?php

namespace Numbers\Users\Organizations\Form\ServiceScript;

class Collection extends \Object\Form\Wrapper\Collection {

	public $collection_link = 'on_service_script_executing_collection';
	public $data = [];

	public function __construct($options = []) {
		$linked_type_code = $options['input']['__linked_type_code'];
		$linked_module_id = (int) $options['input']['__linked_module_id'];
		$linked_id = (int) $options['input']['__linked_id'];
		$data = [];
		if (!empty($linked_id) && !empty($linked_module_id) && !empty($linked_type_code)) {
			$model = new \Numbers\Users\Organizations\Model\Service\Executed\ServiceScripts();
			$data = $model->get([
				'where' => [
					'on_execsscript_linked_type_code' => $linked_type_code,
					'on_execsscript_linked_module_id' => $linked_module_id,
					'on_execsscript_linked_id' => $linked_id,
				],
				'pk' => ['on_execsscript_id'],
				'orderby' => [
					'on_execsscript_id' => SORT_DESC
				]
			]);
		}
		if (!empty($data) && \Application::$controller->can('Record_View_Service_Script', 'Edit')) {
			$this->data = [
				self::MAIN_SCREEN => [
					'options' => [
						'type' => 'forms',
					],
					'order' => 1000,
					self::ROWS => []
				]
			];
			$this->data[self::MAIN_SCREEN][self::ROWS]['row1'] = [
				'order' => 1000,
				'options' => [
					'type' => 'tabs',
					'segment' => [
						'type' => 'warning',
						'header' => [
							'icon' => ['type' => 'fas fa-question-circle'],
							'title' => 'Service Scripts'
						]
					],
					'its_own_segment' => true
				]
			];
			$index = 1;
			foreach ($data as $k => $v) {
				$input = $options['input'];
				$input['on_execsscript_id'] = $k;
				// view
				$this->data[self::MAIN_SCREEN][self::ROWS]['row1'][self::FORMS]['on_service_script_form_as_text_id_' . $k] = [
					'model' => '\Numbers\Users\Organizations\Form\ServiceScript\ServiceScriptAsText',
					'options' => [
						'label_name' => $v['on_execsscript_service_script_name'],
						'form_link' => 'on_service_script_form_as_text_id_' . $k,
						'percent' => 100,
						'input' => $input,
					],
					'order' => $index
				];
				// edit
				if (\Application::$controller->can('Record_Execute_Service_Script', 'Edit')) {
					$input['__anchor'] = "form_on_service_script_form_id_{$k}_form_anchor";
					$this->data[self::MAIN_SCREEN][self::ROWS]['row1'][self::FORMS]['on_service_script_form_id_' . $k] = [
						'model' => '\Numbers\Users\Organizations\Form\ServiceScript\ServiceScripts',
						'options' => [
							'label_name' => $v['on_execsscript_service_script_name'] . ' (Edit)',
							'form_link' => 'on_service_script_form_id_' . $k,
							'percent' => 100,
							'input' => $input,
							'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
						],
						'order' => ($index + 1)
					];
				}
				$index++;
			}
		}
		// call parent constructor
		parent::__construct($options);
	}

	public function distribute() {}
}