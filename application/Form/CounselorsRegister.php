<?php

namespace Form;
class CounselorsRegister extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_counselors_register';
	public $module_code = 'B4';
	public $title = 'B/J Counselors Register Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'signature' => ['default_row_type' => 'grid', 'order' => 800],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		'address_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'emergency_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'medical_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'tshirt_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'additional_container' => ['default_row_type' => 'grid', 'order' => 33000],
		'references_container' => ['default_row_type' => 'grid', 'order' => 34000],
		'responsibilities_container' => ['default_row_type' => 'grid', 'order' => 35000],
		'declaration_container' => ['default_row_type' => 'grid', 'order' => 36000],
	];
	public $rows = [
		'tabs' => [
			'address' => ['order' => 200, 'label_name' => 'Address'],
			'emergency' => ['order' => 250, 'label_name' => 'Emergency'],
			'medical' => ['order' => 300, 'label_name' => 'Medical'],
			'additional' => ['order' => 350, 'label_name' => 'Additional'],
			'references' => ['order' => 360, 'label_name' => 'References'],
			'responsibilities' => ['order' => 370, 'label_name' => 'Responsibilities'],
			'declaration' => ['order' => 380, 'label_name' => 'Declaration'],
			'tshirt' => ['order' => 400, 'label_name' => 'T-Shirt'],
		],
	];
	public $elements = [
		'top' => [
			'b4_counselor_period_id' => [
				'b4_counselor_period_id' => ['order' => 1, 'row_order' => 50, 'label_name' => 'Period', 'domain' => 'group_id', 'null' => true, 'required' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Model\Periods', 'options_params' => ['b4_period_current' => 1], 'placeholder' => 'Period'],
			],
			'b4_counselor_child_name' => [
				'b4_counselor_child_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'b4_counselor_badge_name' => ['order' => 2, 'label_name' => 'First name, as you want it to appear on name tag', 'domain' => 'name', 'percent' => 50, 'required' => true],
			],
			'b4_counselor_parish' => [
				'b4_counselor_date_of_birth' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Date of Birth', 'type' => 'date', 'required' => true, 'percent' => 50, 'placeholder' => NUMBERS_FLAG_TIMESTAMP_FORMATED_DATE],
				'b4_counselor_parish' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parish', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			'b4_counselor_email' => [
				'b4_counselor_phone' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Phone', 'domain' => 'phone', 'required' => true],
				'b4_counselor_email' => ['order' => 2, 'label_name' => 'Email', 'domain' => 'email', 'required' => true],
			],
			'b4_counselor_declartion_police_check_submitted' => [
				'b4_counselor_declartion_police_check_submitted' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Did you submit Police check to Break for Jesus before?', 'type' => 'boolean', 'onchange' => 'this.form.submit();'],
			]
		],
		'tabs' => [
			'address' => [
				'address' => ['container' => 'address_container', 'order' => 100]
			],
			'emergency' => [
				'emergency' => ['container' => 'emergency_container', 'order' => 100]
			],
			'medical' => [
				'medical' => ['container' => 'medical_container', 'order' => 100],
			],
			'additional' => [
				'additional' => ['container' => 'additional_container', 'order' => 100]
			],
			'references' => [
				'references' => ['container' => 'references_container', 'order' => 100]
			],
			'responsibilities' => [
				'responsibilities' => ['container' => 'responsibilities_container', 'order' => 100]
			],
			'declaration' => [
				'declaration' => ['container' => 'declaration_container', 'order' => 100]
			],
			'tshirt' => [
				'tshirt' => ['container' => 'tshirt_container', 'order' => 100]
			]
		],
		'address_container' => [
			'b4_counselor_address1' => [
				'b4_counselor_address1' => ['order' => 1, 'row_order' => 350, 'label_name' => 'Address Line 1', 'domain' => 'name', 'required' => true],
				'b4_counselor_address2' => ['order' => 2, 'label_name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
			],
			'b4_counselor_city' => [
				'b4_counselor_city' => ['order' => 1, 'row_order' => 400, 'label_name' => 'City', 'domain' => 'name', 'required' => true],
				'b4_counselor_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'required' => true],
			],
			'b4_counselor_country_code' => [
				'b4_counselor_country_code' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'default' => 'CA', 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'b4_counselor_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'required' => true, 'default' => 'ON', 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'b4_counselor_country_code']],
			],
		],
		'emergency_container' => [
			'b4_counselor_emergency_line1' => [
				'b4_counselor_emergency_line1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Emergency Contact 1', 'type' => 'text', 'null' => true, 'required' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
				'b4_counselor_emergency_line2' => ['order' => 2, 'label_name' => 'Emergency Contact 2', 'type' => 'text', 'null' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
			],
		],
		'medical_container' => [
			'b4_counselor_medical_health_card_number' => [
				'b4_counselor_medical_health_card_number' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Health Card Number', 'domain' => 'code', 'required' => true, 'placeholder' => 'NNNN-NNN-NNN-AA'],
			],
			'b4_counselor_medical_doctors_info' => [
				'b4_counselor_medical_doctors_info' => ['order' => 1, 'row_order' => 110, 'label_name' => 'Doctors Name & Phone', 'type' => 'text', 'null' => true, 'required' => true, 'method' => 'textarea', 'placeholder' => 'Name / Phone'],
			],
			'b4_counselor_medical_alergies_flag' => [
				'b4_counselor_medical_alergies' => ['order' => 1, 'row_order' => 120, 'label_name' => 'Alergies?', 'type' => 'text', 'null' => true, 'percent' => 100, 'method' => 'textarea', 'placeholder' => 'Name, Name, ...'],
			],
			'b4_counselor_medical_dietary_restrictions' => [
				'b4_counselor_medical_dietary_restrictions' => ['order' => 1, 'row_order' => 130, 'label_name' => 'Do you have any dietary restrictions?', 'type' => 'text', 'null' => true, 'percent' => 100, 'method' => 'textarea', 'placeholder' => ''],
			],
			'b4_counselor_medical_anything_we_should_know' => [
				'b4_counselor_medical_anything_we_should_know' => ['order' => 1, 'row_order' => 140, 'label_name' => 'Is there anything we should know?', 'type' => 'text', 'null' => true, 'percent' => 100, 'method' => 'textarea', 'placeholder' => ''],
			],
		],
		'additional_container' => [
			'b4_counselor_additional_why_councelor' => [
				'b4_counselor_additional_why_councelor' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Why do I want to be a counselor?', 'type' => 'text', 'required' => true, 'method' => 'textarea'],
			],
			'b4_counselor_additional_leadership_expirience' => [
				'b4_counselor_additional_leadership_expirience' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Leadership experience', 'type' => 'text', 'null' => true, 'method' => 'textarea'],
			],
			'b4_counselor_additional_memorable_offer' => [
				'b4_counselor_additional_memorable_offer' => ['order' => 1, 'row_order' => 300, 'label_name' => 'What can I offer to make the children\'s experience at camp memorable?', 'type' => 'text', 'null' => true, 'method' => 'textarea'],
			],
			'b4_counselor_ukrainian_level_id' => [
				'b4_counselor_ukrainian_level_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Level of Ukrainian', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => 'Model\Counselor\UkrainianLevel'],
			]
		],
		'references_container' => [
			'ref1' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 100, 'label_name' => 'Reference 1', 'icon' => 'far fa-user', 'percent' => 100],
			],
			'b4_counselor_reference_1_name' => [
				'b4_counselor_reference_1_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'required' => true, 'percent' => 50],
				'b4_counselor_reference_1_position' => ['order' => 2, 'label_name' => 'Position/Title', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			'b4_counselor_reference_1_phone' => [
				'b4_counselor_reference_1_phone' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Phone', 'domain' => 'phone', 'required' => true, 'percent' => 50],
				'b4_counselor_reference_1_email' => ['order' => 2, 'label_name' => 'Email', 'domain' => 'email', 'required' => true, 'percent' => 50],
			],
			'ref2' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 400, 'label_name' => 'Reference 2', 'icon' => 'far fa-user', 'percent' => 100],
			],
			'b4_counselor_reference_2_name' => [
				'b4_counselor_reference_2_name' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Name', 'domain' => 'name', 'required' => true, 'percent' => 50],
				'b4_counselor_reference_2_position' => ['order' => 2, 'label_name' => 'Position/Title', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			'b4_counselor_reference_2_phone' => [
				'b4_counselor_reference_2_phone' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Phone', 'domain' => 'phone', 'required' => true, 'percent' => 50],
				'b4_counselor_reference_2_email' => ['order' => 2, 'label_name' => 'Email', 'domain' => 'email', 'required' => true, 'percent' => 50],
			],
		],
		'responsibilities_container' => [
			'text' => [
				'text' => ['row_order' => 50, 'value' => 'Please identified your preferences for helping with various tasks during the camp (1 being highest).', 'method' => 'b']
			],
			'b4_counselor_responsibility_sports' => [
				'b4_counselor_responsibility_sports' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sports', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_slideshow' => [
				'b4_counselor_responsibility_slideshow' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Slideshow', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_chapel' => [
				'b4_counselor_responsibility_chapel' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Chapel', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_olympiada' => [
				'b4_counselor_responsibility_olympiada' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Olympiada', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_technology' => [
				'b4_counselor_responsibility_technology' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Technology', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_bingo' => [
				'b4_counselor_responsibility_bingo' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Bingo', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			],
			'b4_counselor_responsibility_games' => [
				'b4_counselor_responsibility_games' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Games', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Model\Counselor\Responsibilities'],
			]
		],
		'declaration_container' => [
			'b4_counselor_declartion_signed_at' => [
				'b4_counselor_declartion_signed_at' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Signed At', 'domain' => 'name', 'null' => true, 'required' => 'c', 'percent' => 50],
				'b4_counselor_declartion_last_police_check' => ['order' => 2, 'label_name' => 'Last police Check', 'type' => 'date', 'null' => true, 'required' => 'c', 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'b4_counselor_declartion_signature' => [
				'b4_counselor_declartion_signature' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Child Signature', 'domain' => 'signature', 'null' => true, 'required' => 'c', 'percent' => 50, 'method' => 'signature'],
				'b4_counselor_declartion_signing_date' => ['order' => 2, 'label_name' => 'Signing Date', 'type' => 'date', 'null' => true, 'default' => NUMBERS_FLAG_TIMESTAMP_DATE, 'required' => 'c', 'method' => 'calendar', 'calendar_icon' => 'right'],
			]
		],
		'tshirt_container' => [
			'b4_counselor_tshirt_size' => [
				'b4_counselor_tshirt_size' => ['order' => 1, 'row_order' => 300, 'label_name' => 'T-Shirt size', 'type' => 'smallint', 'null' => true, 'default' => null, 'required' => true, 'method' => 'select', 'options_model' => '\Model\TShirtSize', 'placeholder' => 'Size', 'options_options' => ['i18n' => 'skip_sorting']],
			],
		],
		'signature' => [
			'b4_counselor_parents_name' => [
				'b4_counselor_parents_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Parents Name', 'domain' => 'name', 'required' => true, 'percent' => 100],
			],
			'b4_counselor_signature' => [
				'b4_counselor_signature' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'signature'],
				'b4_counselor_signing_date' => ['order' => 2, 'label_name' => 'Signing Date', 'type' => 'date', 'null' => true, 'default' => NUMBERS_FLAG_TIMESTAMP_DATE, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];
	public $collection = [
		'name' => 'Counselors',
		'model' => '\Model\Counselors'
	];

	public function refresh(& $form) {
		if (!\Registry::get('b4j.ignore_dates')) {
			$period = \Model\Periods::getStatic([
				'where' => [
					'b4_period_current' => 1
				],
				'pk' => null
			]);
			if (!\Helper\Date::between(\Format::now('datetime'), $period[0]['b4_period_start_date'], $period[0]['b4_period_end_date'])) {
				$form->error(DANGER,  \Helper\Messages::NO_LONGER_ACCEPT_REGISTRATIONS, 'b4_counselor_period_id');
				return;
			}
		}
	}

	public function validate(& $form) {
		if (!empty($form->values['b4_counselor_declartion_police_check_submitted'])) {
			$form->validateAsRequiredFields([
				'b4_counselor_declartion_signed_at',
				'b4_counselor_declartion_last_police_check',
				'b4_counselor_declartion_signature',
				'b4_counselor_declartion_signing_date'
			]);
		}
	}

	public function overrideTabs(& $form, & $tab_options, & $tab_name, & $neighbouring_values = []) {
		if (empty($form->values['b4_counselor_declartion_police_check_submitted'])) {
			if (in_array($tab_name, ['declaration'])) {
				return ['hidden' => true];
			}
		}
	}
}