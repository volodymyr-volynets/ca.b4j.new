<?php

namespace Form\Register;
class Step2 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step2';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 2 Form';
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
			'b4_registration_child_name' => [
				'b4_registration_child_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Name of Child', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 100],
			],
			'b4_registration_parents_name' => [
				'b4_registration_parents_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent\'s Name', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 100],
			],
			'b4_registration_parish' => [
				'b4_registration_parish' => ['order' => 1, 'row_order' => 250, 'label_name' => 'Parish', 'domain' => 'name', 'null' => true, 'percent' => 100],
			],
			'b4_registration_grade' => [
				'b4_registration_grade' => ['order' => 1, 'row_order' => 260, 'label_name' => 'Grade', 'type' => 'smallint', 'null' => true, 'percent' => 25, 'required' => true],
				'b4_registration_age' => ['order' => 2, 'label_name' => 'Age', 'type' => 'smallint', 'null' => true, 'percent' => 25, 'required' => true],
				'b4_registration_date_of_birth' => ['order' => 3, 'label_name' => 'Date of Birth', 'type' => 'date', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'address' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 300, 'label_name' => 'Address', 'icon' => 'fas fa-map', 'percent' => 100],
			],
			'b4_register_address1' => [
				'b4_registration_address1' => ['order' => 1, 'row_order' => 350, 'label_name' => 'Address Line 1', 'domain' => 'name', 'required' => true],
				'b4_registration_address2' => ['order' => 2, 'label_name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
			],
			'b4_register_city' => [
				'b4_registration_city' => ['order' => 1, 'row_order' => 400, 'label_name' => 'City', 'domain' => 'name', 'required' => true],
				'b4_registration_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'required' => true, 'onblur' => 'this.form.submit();'],
			],
			'b4_register_country_code' => [
				'b4_registration_country_code' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'default' => 'CA', 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'b4_registration_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'required' => true, 'default' => 'ON', 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'b4_registration_country_code']],
			],
			'contact' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 600, 'label_name' => 'Contact', 'icon' => 'fas fa-phone', 'percent' => 100],
			],
			'b4_registration_email' => [
				'b4_registration_phone' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Phone', 'domain' => 'phone', 'required' => true],
				'b4_registration_email' => ['order' => 2, 'label_name' => 'Email', 'domain' => 'email'],
			],
			'b4_registration_emergency_line1' => [
				'b4_registration_emergency_line1' => ['order' => 1, 'row_order' => 800, 'label_name' => 'Emergency Contact 1', 'type' => 'text', 'null' => true, 'required' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
				'b4_registration_emergency_line2' => ['order' => 2, 'label_name' => 'Emergency Contact 2', 'type' => 'text', 'null' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
			],
			'b4_registration_prefered_language_preference' => [
				'b4_registration_prefered_language_preference' => ['order' => 1, 'row_order' => 900, 'label_name' => 'Language Preference', 'type' => 'smallint', 'default' => null, 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Model\LanguagePreference', 'options_options' => ['i18n' => 'skip_sorting']],
				'b4_registration_first_time' => ['order' => 2, 'label_name' => 'First Time', 'type' => 'boolean', 'percent' => 50],
			]
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
			'href' => \Application::get('mvc.full') . '?__wizard_step=1&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 2;
		// preload data
		if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
			\Object\Table\Complementary::jsonPreloadData(
				new \Model\Register(),
				[
					'b4_register_id' => $form->values['b4_register_id']
				],
				['b4_register_step2', 'b4_register_step1'],
				$form->values
			);
		}
	}

	public function validate(& $form) {
		
	}

	public function save(& $form) {
		// write data
		return \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 2,
				'b4_register_step2' => json_encode($form->values),
				'b4_register_parents_name' => $form->values['b4_registration_parents_name'],
				'b4_register_parents_phone' => $form->values['b4_registration_phone'],
				'b4_register_parents_email' => $form->values['b4_registration_email']
			],
			$form,
			'b4_register_id'
		);
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=3&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}