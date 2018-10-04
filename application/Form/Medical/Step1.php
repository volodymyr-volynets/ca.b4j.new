<?php

namespace Form\Medical;
class Step1 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_medical_step1';
	public $module_code = 'B4';
	public $title = 'B/4 Medical Step 1 Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'medication' => ['default_row_type' => 'table', 'order' => 700, 'column_name_width_percent' => 80],
		'medication2' => ['default_row_type' => 'table', 'order' => 701, 'column_name_width_percent' => 80],
		'signature' => ['default_row_type' => 'grid', 'order' => 800],
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
			'b4_registration_child_name' => [
				'b4_registration_child_name' => ['order' => 1, 'row_order' => 50, 'label_name' => 'Name of Child', 'domain' => 'name', 'persistent' => true, 'percent' => 100, 'required' => true, 'readonly' => true],
			],
			'b4_registration_medical_health_card_number' => [
				'b4_registration_medical_health_card_number' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Health Card Number', 'domain' => 'code', 'required' => true, 'placeholder' => 'NNNN-NNN-NNN-AA'],
			],
			'b4_registration_medical_doctors_contact' => [
				'b4_registration_medical_doctors_contact' => ['order' => 1, 'row_order' => 110, 'label_name' => 'Doctors Name & Phone', 'type' => 'text', 'null' => true, 'required' => true, 'method' => 'textarea', 'placeholder' => 'Name / Phone'],
			],
			'b4_registration_medical_alergies_flag' => [
				'b4_registration_medical_alergies_flag' => ['order' => 1, 'row_order' => 120, 'label_name' => 'Alergies', 'type' => 'boolean', 'required' => 'c', 'percent' => 25],
				'b4_registration_medical_alergies_details' => ['order' => 2, 'label_name' => 'Alergies (Please Specify)', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'textarea', 'placeholder' => 'Name, Name, ...'],
			],
			'b4_registration_medical_immunization_flag' => [
				'b4_registration_medical_immunization_flag' => ['order' => 1, 'row_order' => 130, 'label_name' => 'Has your child received the required immunization for their age?', 'type' => 'boolean', 'required' => 'c', 'percent' => 100, 'description' => 'IMPORTANT NOTE: Immunization schedules and requirements vary in different jurisdictions; campers who reside outside of Ontario must attach a copy of updated immunization records.'],
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
				'b4_registration_medical_special_need_details' => ['order' => 1, 'row_order' => 180, 'label_name' => 'Special Need', 'type' => 'text', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'textarea', 'placeholder' => 'Please Specify', 'description' => "IMPORTANT NOTE: Please make sure medication is given to the camp nurse. Campers will not be allowed to store their medication in the dorm for safety reasons, unless agreed upon with the nurse (i.e. Epi-Pens). If your child requires medications while at camp be sure they are in the original bottles and clearly labeled. Please do not send any medication (pill form, gels, naturopathic aids/medication, vitamins) in a Ziploc bag with a written note. Please check for expiry date as the nurse is not allowed to give any expired medication to any of the camp participants. The medication will be stored in the nurse's room and dispensed by the nurse only. If your child has any additional medical requirements, please ensure they have been noted on this form."],
			],
			'medication' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 900, 'label_name' => 'NON-PRESCRIPTION MEDICATION (OTC)', 'icon' => 'fas fa-medkit', 'percent' => 100],
			],
		],
		'medication' => [
			'text1' => [
				'text1' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'method' => 'span', 'description' => 'We will have various non-prescription medications available to be given to your child by the Nurse or Senior Staff if necessary, please identify all those that you authorize for your child.', 'percent' => 100]
			],
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
			'text2' => [
				'text2' => ['order' => 1, 'row_order' => 400, 'label_name' => '', 'method' => 'span', 'description' => "These medications would be given only in the best interest of the camper.  Medication will be administered by the Nurse. However, if the Nurse is unavailable, this duty will be performed by a senior staff member. Neither Break for Jesus Camp nor any of its staff are responsible for any side effects or difficulties encountered from taking any such authorized medications.<br/> If your child will need to take medication during camp, please bring it in its original packaging with instructions, sealed in a ziplock bag labeled with your child's name.  Please note that only essential medication can be administered, as there are many campers that need to be looked after.", 'percent' => 100]
			],
			'text3' => [
				'text3' => ['order' => 1, 'row_order' => 410, 'label_name' => '', 'method' => 'span', 'description' => "I authorize any Senior Staff to transport my son/daughter to/from any treatments/medical visits via automobile should it be medically necessary during their stay at Camp. I authorize any medication to be given per doctor order that is prescribed during camp stay.", 'percent' => 100]
			],
		],
		'medication2' => [
			'b4_registration_medical_non_prescription_medication' => [
				'b4_registration_medical_non_prescription_medication' => ['order' => 1, 'row_order' => 100, 'label_name' => 'I give Break For Jesus Camp Nurse or Senior Staff permission to administer non-prescription medications to my child as needed.', 'type' => 'boolean', 'percent' => 100],
			],
			'b4_registration_medical_no_non_prescription_medication' => [
				'b4_registration_medical_no_non_prescription_medication' => ['order' => 1, 'row_order' => 200, 'label_name' => 'I DO NOT allow Break For Jesus Camp Nurse or Senior Staff to give my child non-prescription medication.', 'type' => 'boolean', 'percent' => 100],
			],
			'text4' => [
				'text4' => ['order' => 1, 'row_order' => 300, 'label_name' => '', 'method' => 'span', 'description' => "Please note that room requests will not be accepted/accommodated.", 'percent' => 100]
			],
			'text5' => [
				'text5' => ['order' => 1, 'row_order' => 400, 'label_name' => '', 'method' => 'b', 'value' => "Should any disciplinary problems occur during the week I am aware that I will be contacted and it is my responsibility to pick up my child.", 'percent' => 100]
			],
		],
		'signature' => [
			'medication' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 100, 'label_name' => 'SIGNATURE', 'icon' => 'fas fa-american-sign-language-interpreting', 'percent' => 100],
			],
			'b4_registration_medical_signature' => [
				'b4_registration_medical_signature' => ['order' => 1, 'row_order' => 999, 'label_name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'signature'],
				'b4_registration_medical_signing_date' => ['order' => 2, 'label_name' => 'Signing Date', 'type' => 'date', 'null' => true, 'default' => NUMBERS_FLAG_TIMESTAMP_DATE, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
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
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=1&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token')
		];
		$form->values['__wizard_step'] = 1;
		if (!in_array($form->values['b4_registration_status_id'], [30, 300])) {
			$form->error(DANGER, \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED);
			$form->readonly();
			return;
		}
	}

	public function validate(& $form) {
		if (!empty($form->values['b4_registration_medical_alergies_flag'])) {
			if (empty($form->values['b4_registration_medical_alergies_details'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'b4_registration_medical_alergies_details');
			}
		}
		if (!empty($form->values['b4_registration_medical_medication_flag'])) {
			if (empty($form->values['b4_registration_medical_medication_details'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'b4_registration_medical_medication_details');
			}
		}
		if (!empty($form->values['b4_registration_medical_special_food_flag'])) {
			if (empty($form->values['b4_registration_medical_special_food_details'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'b4_registration_medical_special_food_details');
			}
		}
		if (!empty($form->values['b4_registration_medical_special_need_flag'])) {
			if (empty($form->values['b4_registration_medical_special_need_details'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'b4_registration_medical_special_need_details');
			}
		}
	}

	public function success(& $form) {
		if (!empty($form->values['b4_registration_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=2&b4_registration_id=' . $form->values['b4_registration_id'] . '&token=' . \Request::input('token'));
		}
	}
}