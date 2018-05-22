<?php

namespace Form\Register;
class Step3 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step3';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 3 Form';
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
			],
			'b4_registration_medical_signature' => [
				'b4_registration_medical_signature' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'signature'],
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
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=3&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 3;
		// preload data
		if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
			\Object\Table\Complementary::jsonPreloadData(
				new \Model\Register(),
				[
					'b4_register_id' => $form->values['b4_register_id']
				],
				['b4_register_step3'],
				$form->values
			);
		}
	}

	public function validate(& $form) {
		$form->error(DANGER, 'asdasd');
	}

	public function save(& $form) {
		// write data
		return \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 3,
				'b4_register_step3' => json_encode($form->values)
			],
			$form,
			'b4_register_id'
		);
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=6&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}