<?php

namespace Form\Medical;
class Step3 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_medical_step3';
	public $module_code = 'B4';
	public $title = 'B/4 Medical Step 3 Form';
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
				'b4_registration_id' => ['label_name' => 'Registration #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden'],
				'b4_registration_status_id' => ['label_name' => 'Status', 'domain' => 'status_id', 'null' => true, 'method' => 'hidden'],
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
		'name' => 'B4 Registrations',
		'model' => '\Model\Registrations',
	];

	public function refresh(& $form) {
		$form->options['actions']['back'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token')
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=3&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token')
		];
		$form->values['__wizard_step'] = 3;
		if ($form->values['b4_registration_status_id'] != 30) {
			$form->error(DANGER, \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED);
			$form->readonly();
		}
	}

	public function validate(& $form) {
		$form->values['b4_registration_status_id'] = 40;
	}

	public function success(& $form) {
		if (!empty($form->values['b4_registration_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=4&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token'));
		}
	}
}