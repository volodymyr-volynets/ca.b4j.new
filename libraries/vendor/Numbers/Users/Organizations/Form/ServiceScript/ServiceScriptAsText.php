<?php

namespace Numbers\Users\Organizations\Form\ServiceScript;

class ServiceScriptAsText extends \Object\Form\Wrapper\Base {

	public $form_link = 'on_service_script_service_script_as_text_form';
	public $module_code = 'ON';
	public $title = 'O/N Service Script As Text Form';
	public $options = [];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'on_execsscript_id' => ['label_name' => 'Executed #', 'domain' => 'executed_service_script_id', 'method' => 'hidden']
			]
		]
	];
	public $collection = [];
	public $service_script_values;

	public function __construct($options = []) {
		// preload service script
		if (!empty($options['input']['on_execsscript_id'])) {
			$result = \Numbers\Users\Organizations\Model\Service\Executed\ServiceScripts::getStatic([
				'where' => [
					'on_execsscript_id' => (int) $options['input']['on_execsscript_id']
				],
				'pk' => null
			]);
			$this->service_script_values = json_decode($result[0]['on_execsscript_values'], true);
			// render questions
			$questions = \Numbers\Users\Organizations\Helper\ServiceScript\Helper::getQuestions($result[0]['on_execsscript_service_script_id'], $result[0]['on_execsscript_region_id'], $result[0]['on_execsscript_channel_code']);
			\Numbers\Users\Organizations\Helper\ServiceScript\Helper::renderQuestionAsText($this, $questions['data'], $this->service_script_values);
		}
		// call parent constructor
		parent::__construct($options);
	}

	public function refresh(& $form) {
		if (!$form->submitted) {
			foreach ($this->service_script_values as $k => $v) {
				if (is_array($v) && !empty($v) && empty($form->values[$k])) {
					$form->values[$k] = $v;
				} else if (($form->values[$k] ?? '') == '') {
					$form->values[$k] = $v;
				}
			}
		}
	}
}