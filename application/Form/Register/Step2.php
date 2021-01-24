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
		'children_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Model\Register\Details',
			'details_pk' => ['b4_registration_child_name', 'b4_registration_date_of_birth'],
			'required' => true,
			'order' => 800
		],
		'volunteer' => ['default_row_type' => 'grid', 'order' => 825],
		'signature' => ['default_row_type' => 'grid', 'order' => 850],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'__wizard_step' => ['label_name' => 'Wizzard Step', 'domain' => 'type_id', 'null' => true, 'method' => 'hidden'],
				'b4_register_id' => ['label_name' => 'Register #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden', 'validate_through_session' => true],
				'b4_registration_in_group_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Language', 'domain' => 'group_id', 'placeholder' => 'Language', 'null' => true, 'default' => NUMBERS_FLAG_GLOBAL___IN_GROUP_ID ?? NUMBERS_FLAG_GLOBAL_I18N_GROUP_ID, 'required' => true, 'percent' => 100, 'method' => 'hidden'],
				'b4_registration_period_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'code', 'null' => true, 'method' => 'hidden'],
			],
			'b4_registration_period_id' => [
				'b4_registration_period_id' => ['order' => 1, 'row_order' => 50, 'label_name' => 'Period', 'domain' => 'group_id', 'null' => true, 'required' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Model\Periods', 'options_params' => ['b4_period_current' => 1], 'placeholder' => 'Period'],
			],
			'b4_registration_parents_name' => [
				'b4_registration_parents_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent\'s Name', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 100],
				'b4_registration_parish' => ['order' => 2, 'label_name' => 'Parish', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 100],
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
				'b4_registration_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'required' => true],
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
				'b4_registration_email' => ['order' => 2, 'label_name' => 'Email', 'domain' => 'email', 'required' => true],
			],
			'b4_registration_prefered_language_preference' => [
				'b4_registration_prefered_language_preference' => ['order' => 1, 'row_order' => 750, 'label_name' => 'Language Preference', 'type' => 'smallint', 'default' => null, 'null' => true, 'required' => true, 'percent' => 50, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'select', 'options_model' => '\Model\LanguagePreference', 'options_options' => ['i18n' => 'skip_sorting']],
			],
			'children' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 800, 'label_name' => 'Children', 'icon' => 'fas fa-users', 'percent' => 100],
			],
		],
		'children_container' => [
			'row1' => [
				'b4_registration_child_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Child Name', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 65],
				'b4_registration_grade' => ['order' => 2, 'label_name' => 'Grade', 'type' => 'smallint', 'null' => true, 'required' => true, 'percent' => 35],
			],
			'row2' => [
				'b4_registration_date_of_birth' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Date of Birth', 'type' => 'date', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'input', 'placeholder' => NUMBERS_FLAG_TIMESTAMP_FORMATED_DATE],
				'b4_registration_first_time' => ['order' => 2, 'label_name' => 'First Time', 'type' => 'boolean', 'percent' => 15],
				'b4_registration_gender_id' => ['order' => 3, 'label_name' => 'Gender', 'domain' => 'status_id', 'null' => true, 'required' => true, 'percent' => 35, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'select', 'options_model' => '\Model\Registration\Genders', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
			]
		],
		'volunteer' => [
			'b4_registration_can_volunteer' => [
				'b4_registration_can_volunteer' => ['order' => 1, 'row_order' => 10000, 'label_name' => 'Volunteer', 'type' => 'boolean', 'description' => 'I am able to volunteer for some time during camp. Please contact me!'],
			]
		],
		'signature' => [
			'medication' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 100, 'label_name' => 'Signature', 'icon' => 'fas fa-american-sign-language-interpreting', 'percent' => 100],
			],
			'b4_registration_first_signature' => [
				'b4_registration_first_signature' => ['order' => 1, 'row_order' => 999, 'label_name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'signature'],
				'b4_registration_first_signing_date' => ['order' => 2, 'label_name' => 'Signing Date', 'type' => 'date', 'null' => true, 'default' => NUMBERS_FLAG_TIMESTAMP_DATE, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
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
			'href' => \Application::get('mvc.full') . '?__wizard_step=1&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 2;
		// preload data
		if (empty($form->is_ajax_reload)) {
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
	}

	public function validate(& $form) {
		
	}

	public function save(& $form) {
		// concat children
		$children = [];
		foreach ($form->values['\Model\Register\Details'] as $v) {
			$children[] = $v['b4_registration_child_name'];
		}
		$period = \Model\Periods::getStatic([
			'where' => [
				'b4_period_id' => $form->values['b4_registration_period_id']
			],
			'pk' => null
		]);
		$form->values['b4_registration_period_code'] = $period[0]['b4_period_code'];
		// write data
		$model = new \Model\Periods();
		$model->db_object->begin();
		$result = \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 1,
				'b4_register_step1' => json_encode($form->values),
				'b4_register_period_id' => $form->values['b4_registration_period_id'],
				//'b4_register_period' => $this->tmp_period_dates,
				//'b4_register_period_id' => $form->values['b4_registration_period_id'],
			],
			$form,
			'b4_register_id'
		);
		\Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 2,
				'b4_register_step2' => json_encode($form->values),
				'b4_register_period_id' => $form->values['b4_registration_period_id'],
				'b4_register_parents_name' => $form->values['b4_registration_parents_name'],
				'b4_register_parents_phone' => $form->values['b4_registration_phone'],
				'b4_register_parents_email' => $form->values['b4_registration_email'],
				'b4_register_children' => implode(', ', $children),
			],
			$form,
			'b4_register_id'
		);
		// update counter
		if ($result) {
			\Model\Periods::queryBuilderStatic()->update()->set(['b4_period_new_registrations;=;~~' => 'b4_period_new_registrations + 1'])->where('AND', ['b4_period_id', '=', $form->values['b4_registration_period_id']])->query();
			$model->db_object->commit();
		} else {
			$model->db_object->rollback();
		}
		return true;
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=3&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}