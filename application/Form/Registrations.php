<?php

namespace Form;
class Registrations extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_registrations';
	public $module_code = 'B4';
	public $title = 'B/J Registrations Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'address_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'emergency_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'medical_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'tshirt_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'medical2_container' => ['default_row_type' => 'table', 'order' => 32000, 'column_name_width_percent' => 80],
		'medical3_container' => ['default_row_type' => 'table', 'order' => 32000, 'column_name_width_percent' => 80],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'address' => ['order' => 200, 'label_name' => 'Address'],
			'emergency' => ['order' => 250, 'label_name' => 'Emergency'],
			'medical' => ['order' => 300, 'label_name' => 'Medical'],
			'tshirt' => ['order' => 400, 'label_name' => 'T-Shirt'],
		],
	];
	public $elements = [
		'top' => [
			'b4_registration_id' => [
				'b4_registration_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Registration #', 'domain' => 'big_id_sequence', 'percent' => 95, 'navigation' => true],
				'b4_registration_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'b4_registration_child_name' => [
				'b4_registration_child_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name of Child', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'b4_registration_parents_name' => ['order' => 2, 'label_name' => 'Parents Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
			],
			'b4_registration_timestamp' => [
				'b4_registration_timestamp' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Datetime', 'domain' => 'timestamp_now', 'required' => true, 'format' => 'datetime', 'percent' => 30, 'readonly' => true],
				'b4_registration_status_id' => ['order' => 2, 'label_name' => 'Status', 'domain' => 'status_id', 'null' => true, 'required' => true, 'method' => 'select', 'percent' => 30, 'no_choose' => true, 'options_model' => '\Model\Registration\Statuses', 'options_options' => ['i18n' => 'skip_sorting'], 'track_previous_values' => true],
				'b4_registration_period_id' => ['order' => 3, 'label_name' => 'Period', 'domain' => 'group_id', 'null' => true, 'required' => true, 'method' => 'select', 'percent' => 40, 'no_choose' => true, 'options_model' => '\Model\Periods', 'readonly' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'address' => [
				'address' => ['container' => 'address_container', 'order' => 100]
			],
			'emergency' => [
				'emergency' => ['container' => 'emergency_container', 'order' => 100]
			],
			'medical' => [
				'medical' => ['container' => 'medical_container', 'order' => 100],
				'medical2' => ['container' => 'medical2_container', 'order' => 200],
				'medical3' => ['container' => 'medical3_container', 'order' => 300]
			],
			'tshirt' => [
				'tshirt' => ['container' => 'tshirt_container', 'order' => 100]
			]
		],
		'general_container' => [
			'b4_registration_parents_name' => [
				'b4_registration_parish' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Parish', 'domain' => 'name', 'null' => true, 'required' => true, 'percent' => 50],
				'b4_registration_payment_received' => ['label_name' => 'Payment Received', 'type' => 'boolean', 'percent' => 50],
			],
			'b4_registration_date_of_birth' => [
				'b4_registration_date_of_birth' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Date of Birth', 'type' => 'date', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right', 'onchange' => 'this.form.submit();'],
				'b4_registration_grade' => ['order' => 2, 'label_name' => 'Grade', 'type' => 'smallint', 'null' => true, 'percent' => 25],
				'b4_registration_first_time' => ['order' => 3, 'label_name' => 'First Time', 'type' => 'boolean', 'percent' => 15],
				'b4_registration_gender_id' => ['order' => 4, 'label_name' => 'Gender', 'domain' => 'status_id', 'null' => true, 'required' => true, 'percent' => 35, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'select', 'options_model' => '\Model\Registration\Genders', 'options_options' => ['i18n' => 'skip_sorting']],
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
				'b4_registration_can_volunteer' => ['order' => 2, 'label_name' => 'Volunteer', 'type' => 'boolean', 'description' => 'I am able to volunteer for some time during camp. Please contact me!'],
			],
		],
		'address_container' => [
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
		],
		'emergency_container' => [
			'b4_registration_emergency_line1' => [
				'b4_registration_emergency_line1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Emergency Contact 1', 'type' => 'text', 'null' => true, 'required' => 'c', 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
				'b4_registration_emergency_line2' => ['order' => 2, 'label_name' => 'Emergency Contact 2', 'type' => 'text', 'null' => true, 'method' => 'textarea', 'percent' => 50, 'placeholder' => 'Name / Phone'],
			],
		],
		'medical_container' => [
			'b4_registration_medical_health_card_number' => [
				'b4_registration_medical_health_card_number' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Health Card Number', 'domain' => 'code', 'required' => 'c', 'placeholder' => 'NNNN-NNN-NNN-AA'],
			],
			'b4_registration_medical_doctors_contact' => [
				'b4_registration_medical_doctors_contact' => ['order' => 1, 'row_order' => 110, 'label_name' => 'Doctors Name & Phone', 'type' => 'text', 'null' => true, 'required' => 'c', 'method' => 'textarea', 'placeholder' => 'Name / Phone'],
			],
			'b4_registration_medical_alergies_flag' => [
				'b4_registration_medical_alergies_flag' => ['order' => 1, 'row_order' => 120, 'label_name' => 'Allergies', 'type' => 'boolean', 'required' => 'c', 'percent' => 25],
				'b4_registration_medical_alergies_details' => ['order' => 2, 'label_name' => 'Allergies (Please Specify)', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'textarea', 'placeholder' => 'Name, Name, ...'],
			],
			'b4_registration_medical_immunization_flag' => [
				'b4_registration_medical_immunization_flag' => ['order' => 1, 'row_order' => 130, 'label_name' => 'Has your child received the required immunization for their age?', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_medication_flag' => [
				'b4_registration_medical_medication_flag' => ['order' => 1, 'row_order' => 140, 'label_name' => 'Medication', 'type' => 'boolean', 'required' => 'c', 'percent' => 25],
				'b4_registration_medical_medication_details' => ['order' => 2, 'label_name' => 'Medication (Please Specify)', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'textarea', 'placeholder' => 'Name, Name, ...'],
			],
			'b4_registration_medical_special_food_flag' => [
				'b4_registration_medical_special_food_flag' => ['order' => 1, 'row_order' => 150, 'label_name' => 'Does your child have any dietary restrictions?', 'type' => 'boolean', 'required' => 'c', 'percent' => 25],
				'b4_registration_medical_special_food_details' => ['order' => 2, 'label_name' => 'Dietary Restrictions (Please Specify)', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'textarea', 'placeholder' => 'Name, Name, ...'],
			],
			'b4_registration_medical_other_issues_details' => [
				'b4_registration_medical_other_issues_details' => ['order' => 1, 'row_order' => 160, 'label_name' => 'Does your child have any other issues (eg. anxiety, behavioural, fears, etc.) that we should be aware of, to help them adjust to camp?', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'textarea', 'placeholder' => 'Please specify'],
			],
			'b4_registration_medical_special_need_flag' => [
				'b4_registration_medical_special_need_flag' => ['order' => 1, 'row_order' => 170, 'label_name' => 'Does the camper have any special need or requirements (ex. Mobility aids, glasses, contacts, orthodontia, sleepwalking, bed wetting, etc.)?', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_special_need_details' => [
				'b4_registration_medical_special_need_details' => ['order' => 1, 'row_order' => 180, 'label_name' => 'Special Need', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'textarea', 'placeholder' => 'Please Specify'],
			],
			'medication' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 900, 'label_name' => 'NON-PRESCRIPTION MEDICATION (OTC)', 'icon' => 'fas fa-medkit', 'percent' => 100],
			],
		],
		'medical2_container' => [
			'b4_registration_medical_drug_acetaminophen' => [
				'b4_registration_medical_drug_acetaminophen' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Acetaminophen (Tylenol)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_ibuprofen' => [
				'b4_registration_medical_drug_ibuprofen' => ['order' => 1, 'row_order' => 310, 'label_name' => 'Ibuprofen (Advil, Alive)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_polysporin' => [
				'b4_registration_medical_drug_polysporin' => ['order' => 1, 'row_order' => 320, 'label_name' => 'Topical antibiotic ointments (Polysporin)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_antacids' => [
				'b4_registration_medical_drug_antacids' => ['order' => 1, 'row_order' => 330, 'label_name' => 'Antacids (Tums, Pepcid, Rolaids)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_antihistamines' => [
				'b4_registration_medical_drug_antihistamines' => ['order' => 1, 'row_order' => 340, 'label_name' => 'Antihistamines (Benadryl)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_decongestants' => [
				'b4_registration_medical_drug_decongestants' => ['order' => 1, 'row_order' => 350, 'label_name' => 'Decongestants (Sudafed)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_hydrocortisone' => [
				'b4_registration_medical_drug_hydrocortisone' => ['order' => 1, 'row_order' => 360, 'label_name' => 'Hydrocortisone cream (Hydrocortisone)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_cough_drops' => [
				'b4_registration_medical_drug_cough_drops' => ['order' => 1, 'row_order' => 370, 'label_name' => 'Cough drops (Halls, Ricola)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_antiseptic_solutions' => [
				'b4_registration_medical_drug_antiseptic_solutions' => ['order' => 1, 'row_order' => 380, 'label_name' => 'Antiseptic solutions (Betadine, wound wash)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_anti_emetics' => [
				'b4_registration_medical_drug_anti_emetics' => ['order' => 1, 'row_order' => 390, 'label_name' => 'Anti-emetics (nausea)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_drug_bismuth_subsalicylate' => [
				'b4_registration_medical_drug_bismuth_subsalicylate' => ['order' => 1, 'row_order' => 391, 'label_name' => 'Bismuth subsalicylate (PeptoBismol, upset stomach diarrhea)', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
		],
		'medical3_container' => [
			'b4_registration_medical_non_prescription_medication' => [
				'b4_registration_medical_non_prescription_medication' => ['order' => 1, 'row_order' => 100, 'label_name' => 'I give Break For Jesus Camp Nurse or Senior Staff permission to administer non-prescription medications to my child as needed.', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
			'b4_registration_medical_no_non_prescription_medication' => [
				'b4_registration_medical_no_non_prescription_medication' => ['order' => 1, 'row_order' => 200, 'label_name' => 'I DO NOT allow Break For Jesus Camp Nurse or Senior Staff to give my child non-prescription medication.', 'type' => 'boolean', 'required' => 'c', 'percent' => 100],
			],
		],
		'tshirt_container' => [
			'b4_registration_tshirt_size' => [
				'b4_registration_tshirt_size' => ['order' => 1, 'row_order' => 300, 'label_name' => 'T-Shirt size', 'type' => 'smallint', 'null' => true, 'default' => null, 'required' => 'c', 'method' => 'select', 'options_model' => '\Model\TShirtSize', 'placeholder' => 'Size', 'options_options' => ['i18n' => 'skip_sorting']],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Registrations',
		'model' => '\Model\Registrations'
	];

	public function validate(& $form) {
		// if we change status to need medical we need to send an email
		$prev_status = (int) ($form->misc_settings['__track_previous_values']['b4_registration_status_id'] ?? 0);
		if ($prev_status != $form->values['b4_registration_status_id'] && $form->values['b4_registration_status_id'] == 30) {
			
		}
	}

	public function post(& $form) {
		$prev_status_id = (int) $form->tracked_values['b4_registration_status_id'] ?? 0;
		if ($prev_status_id != ($form->values['b4_registration_status_id'] ?? 0)) {
			// medical email
			if ($form->values['b4_registration_status_id'] == 30) {
				\Helper\Notifications::sendChildAccpetedMessage($form->values['b4_registration_id']);
			}
			// waiting list
			if ($form->values['b4_registration_status_id'] == 300) {
				\Helper\Notifications::sendWaitingListMessage($form->values['b4_registration_id']);
			}
		}
	}
}