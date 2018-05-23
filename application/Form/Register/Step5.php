<?php

namespace Form\Register;
class Step5 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step5';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 5 Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'__wizard_step' => ['label_name' => 'Wizzard Step', 'domain' => 'type_id', 'null' => true, 'method' => 'hidden'],
				'b4_register_id' => ['label_name' => 'Register #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden'],
				'b4_registration_id' => ['label_name' => 'Registration #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden'],
			],
			'text1' => [
				'text1' => ['order' => 1, 'row_order' => 100, 'label_name' => '', 'method' => 'b', 'value' => "Each child will receive a t-shirt at the end of the camp, please indicate what size your child wears below.", 'percent' => 100]
			],
			'text2' => [
				'text2' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'method' => 'b', 'value' => "All t-shirts are in adult sizes.", 'percent' => 100]
			],
			'b4_registration_tshirt_size' => [
				'b4_registration_tshirt_size' => ['order' => 1, 'row_order' => 300, 'label_name' => 'T-Shirt size', 'type' => 'smallint', 'null' => true, 'default' => null, 'required' => true, 'method' => 'select', 'options_model' => '\Model\TShirtSize', 'placeholder' => 'Size', 'options_options' => ['i18n' => 'skip_sorting']],
			],
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_CONTINUE => self::BUTTON_CONTINUE_DATA
			]
		]
	];
	public $collection = [
		'name' => 'B4 Register',
		'readonly' => true,
		'model' => '\Model\Register',
	];

	public function refresh(& $form) {
		$form->options['actions']['back'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=4&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=5&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 5;
		// preload data
		if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
			\Object\Table\Complementary::jsonPreloadData(
				new \Model\Register(),
				[
					'b4_register_id' => $form->values['b4_register_id']
				],
				['b4_register_step5'],
				$form->values
			);
		}
	}

	public function validate(& $form) {

	}

	public function save(& $form) {
		// write data
		$result = \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 5,
				'b4_register_step5' => json_encode($form->values)
			],
			$form,
			'b4_register_id'
		);
		if (!$result) return false;
		// convert
		$model = new \Model\Registrations();
		$data = [];
		\Object\Table\Complementary::jsonPreloadData(
			new \Model\Register(),
			[
				'b4_register_id' => $form->values['b4_register_id']
			],
			['b4_register_step1', 'b4_register_step2', 'b4_register_step3', 'b4_register_step4', 'b4_register_step5'],
			$data
		);
		foreach ($data as $k => $v) {
			if (empty($model->columns[$k])) unset($data[$k]);
		}
		$data['b4_registration_register_id'] = $form->values['b4_register_id'];
		$result = \Model\Registrations::collectionStatic()->merge($data);
		$form->values['b4_registration_id'] = $result['new_serials']['b4_registration_id'];
		return $result['success'];
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=6&b4_register_id=' . $form->values['b4_register_id'] . '&b4_registration_id=' . $form->values['b4_registration_id']);
		}
	}
}