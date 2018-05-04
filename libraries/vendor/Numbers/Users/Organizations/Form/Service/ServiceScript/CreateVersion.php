<?php

namespace Numbers\Users\Organizations\Form\Service\ServiceScript;
class CreateVersion extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_service_script_create_version';
	public $module_code = 'ON';
	public $title = 'O/N Create Version (Service Script)';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'on_servscript_id' => [
				'on_servscript_id' => ['name' => 'Service Script', 'domain' => 'service_script_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts::optionsActive', 'options_params' => ['on_servscript_versioned' => 0]],
			],
			'on_servscript_version_code' => [
				'on_servscript_version_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Version Code', 'domain' => 'version_code', 'required' => true, 'percent' => 50],
				'on_servscript_version_name' => ['order' => 2, 'label_name' => 'Version Name', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		]
	];

	public function save(& $form) {
		$model = \Numbers\Users\Organizations\Form\Service\ServiceScripts::API();
		$model->begin();
		// copy service script
		$result = $model->get([
			'on_servscript_id' => $form->values['on_servscript_id']
		]);
		$result['values']['on_servscript_versioned'] = 1;
		$result['values']['on_servscript_version_service_script_id'] = $form->values['on_servscript_id'];
		$result['values']['on_servscript_version_code'] = $form->values['on_servscript_version_code'];
		$result['values']['on_servscript_version_name'] = $form->values['on_servscript_version_name'];
		$result['values']['on_servscript_code'] = concat_ws(' - ', $result['values']['on_servscript_code'], strtoupper($result['values']['on_servscript_version_code']));
		unset($result['values']['on_servscript_id'], $result['values']['on_servscript_optimistic_lock']);
		$result = $model->save($result['values']);
		if ($result['success']) {
			$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
			$model->commit();
		} else {
			$form->error(DANGER, $result['error']);
			$model->rollback();
		}
	}
}