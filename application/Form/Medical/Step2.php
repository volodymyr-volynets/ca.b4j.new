<?php

namespace Form\Medical;
class Step2 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_medical_step2';
	public $module_code = 'B4';
	public $title = 'B/4 Medical Step 2 Form';
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
				'b4_registration_status_id' => ['label_name' => 'Status', 'domain' => 'status_id', 'null' => true, 'persistent' => true, 'method' => 'hidden'],
			],
			'b4_registration_emergency_line1' => [
				'b4_registration_emergency_line1' => ['order' => 1, 'row_order' => 800, 'label_name' => 'Emergency Contact 1', 'type' => 'text', 'null' => true, 'required' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
				'b4_registration_emergency_line2' => ['order' => 2, 'label_name' => 'Emergency Contact 2', 'type' => 'text', 'null' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
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
			'href' => \Application::get('mvc.full') . '?__wizard_step=1&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token')
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token')
		];
		$form->values['__wizard_step'] = 2;
		if ($form->values['b4_registration_status_id'] != 30) {
			$form->error(DANGER, \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED);
			$form->readonly();
		}
	}

	public function success(& $form) {
		if (!empty($form->values['b4_registration_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=3&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token'));
		}
	}
}