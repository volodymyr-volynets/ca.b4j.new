<?php

namespace Model;
class Registrations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'B4';
	public $title = 'B/4 Registrations';
	public $schema;
	public $name = 'b4_registrations';
	public $pk = ['b4_registration_tenant_id', 'b4_registration_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'b4_registration_';
	public $columns = [
		'b4_registration_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'b4_registration_id' => ['name' => 'Registration #', 'domain' => 'big_id_sequence'],
		'b4_registration_register_id' => ['name' => 'Register #', 'domain' => 'big_id'],
		'b4_registration_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'b4_registration_period_id' => ['name' => 'Period #', 'domain' => 'group_id', 'options_model' => '\Model\Periods'],
		'b4_registration_period_code' => ['name' => 'Code', 'domain' => 'code'],
		'b4_registration_in_group_id' => ['name' => 'I/N Group #', 'domain' => 'group_id', 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups'],
		'b4_registration_status_id' => ['name' => 'Status', 'domain' => 'status_id', 'default' => 10, 'options_model' => '\Model\Registration\Statuses'],
		// name
		'b4_registration_child_name' => ['name' => 'Name of Child', 'domain' => 'name'],
		'b4_registration_parents_name' => ['name' => 'Parents Name', 'domain' => 'name'],
		'b4_registration_parish' => ['name' => 'Parish', 'domain' => 'name', 'null' => true],
		'b4_registration_date_of_birth' => ['name' => 'Date of Birth', 'type' => 'date'],
		'b4_registration_gender_id' => ['name' => 'Gender', 'domain' => 'status_id', 'default' => 10, 'options_model' => '\Model\Registration\Genders'],
		'b4_registration_grade' => ['name' => 'Grade', 'type' => 'smallint', 'null' => true],
		// address
		'b4_registration_address1' => ['name' => 'Address Line 1', 'domain' => 'name'],
		'b4_registration_address2' => ['name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
		'b4_registration_city' => ['name' => 'City', 'domain' => 'name'],
		'b4_registration_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'b4_registration_country_code' => ['name' => 'Country', 'domain' => 'country_code'],
		'b4_registration_province_code' => ['name' => 'Province', 'domain' => 'province_code'],
		// contact
		'b4_registration_email' => ['name' => 'Email', 'domain' => 'email'],
		'b4_registration_phone' => ['name' => 'Phone', 'domain' => 'phone'],
		'b4_registration_prefered_language_preference' => ['name' => 'Language Preference', 'type' => 'smallint', 'options_model' => '\Model\LanguagePreference'],
		'b4_registration_first_time' => ['name' => 'First Time', 'type' => 'boolean'],
		// emergency
		'b4_registration_emergency_line1' => ['name' => 'Emergency Line 1', 'type' => 'text', 'null' => true],
		'b4_registration_emergency_line2' => ['name' => 'Emergency Line 2', 'type' => 'text', 'null' => true],		
		// medical
		'b4_registration_medical_signature' => ['name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true],
		'b4_registration_medical_signing_date' => ['name' => 'Signing Date', 'type' => 'date', 'null' => true],
		'b4_registration_medical_health_card_number' => ['name' => 'Health Card Number', 'domain' => 'code', 'null' => true],
		'b4_registration_medical_doctors_contact' => ['name' => 'Doctors Name & Phone', 'type' => 'text', 'null' => true],
		'b4_registration_medical_alergies_flag' => ['name' => 'Alergies', 'type' => 'boolean'],
		'b4_registration_medical_alergies_details' => ['name' => 'Alergies Details', 'type' => 'text', 'null' => true],
		'b4_registration_medical_immunization_flag' => ['name' => 'Immunization', 'type' => 'boolean'],
		'b4_registration_medical_medication_flag' => ['name' => 'Medication', 'type' => 'boolean'],
		'b4_registration_medical_medication_details' => ['name' => 'Medication Details', 'type' => 'text', 'null' => true],
		'b4_registration_medical_special_food_flag' => ['name' => 'Special Food', 'type' => 'boolean'],
		'b4_registration_medical_special_food_details' => ['name' => 'Special Food Details', 'type' => 'text', 'null' => true],
		'b4_registration_medical_other_issues_details' => ['name' => 'Other Issues', 'type' => 'text', 'null' => true],
		'b4_registration_medical_special_need_flag' => ['name' => 'Special Need', 'type' => 'boolean'],
		'b4_registration_medical_special_need_details' => ['name' => 'Special Need Details', 'type' => 'text', 'null' => true],
		// drugs
		'b4_registration_medical_drug_acetaminophen' => ['name' => 'Acetaminophen (Tylenol)', 'type' => 'boolean'],
		'b4_registration_medical_drug_ibuprofen' => ['name' => 'Ibuprofen (Advil, Alive)', 'type' => 'boolean'],
		'b4_registration_medical_drug_polysporin' => ['name' => 'Topical antibiotic ointments (Polysporin)', 'type' => 'boolean'],
		'b4_registration_medical_drug_antacids' => ['name' => 'Antacids (Tums, Pepcid, Rolaids)', 'type' => 'boolean'],
		'b4_registration_medical_drug_antihistamines' => ['name' => 'Antihistamines (Benadryl)', 'type' => 'boolean'],
		'b4_registration_medical_drug_decongestants' => ['name' => 'Decongestants (Sudafed)', 'type' => 'boolean'],
		'b4_registration_medical_drug_hydrocortisone' => ['name' => 'Hydrocortisone cream (Hydrocortisone)', 'type' => 'boolean'],
		'b4_registration_medical_drug_cough_drops' => ['name' => 'Cough drops (Halls, Ricola)', 'type' => 'boolean'],
		'b4_registration_medical_drug_antiseptic_solutions' => ['name' => 'Antiseptic solutions (Betadine, wound wash)', 'type' => 'boolean'],
		'b4_registration_medical_drug_anti_emetics' => ['name' => 'Anti-emetics (nausea)', 'type' => 'boolean'],
		'b4_registration_medical_drug_bismuth_subsalicylate' => ['name' => 'Bismuth subsalicylate (PeptoBismol, upset stomach diarrhea)', 'type' => 'boolean'],
		'b4_registration_medical_non_prescription_medication' => ['name' => 'Non prescription medication', 'type' => 'boolean'],
		'b4_registration_medical_no_non_prescription_medication' => ['name' => 'No non prescription medication', 'type' => 'boolean'],
		// t-shirt
		'b4_registration_tshirt_size' => ['name' => 'T-Shirt size', 'type' => 'smallint', 'null' => true, 'options_model' => '\Model\TShirtSize'],
		// other
		'b4_registration_payment_received' => ['name' => 'Payment Received', 'type' => 'boolean'],
		'b4_registration_inactive' => ['name' => 'Inactive', 'type' => 'boolean'],
		'b4_registration_can_volunteer' => ['name' => 'Volunteer', 'type' => 'boolean']
	];
	public $constraints = [
		'b4_registrations_pk' => ['type' => 'pk', 'columns' => ['b4_registration_tenant_id', 'b4_registration_id']],
		'b4_registration_period_id_fk' => [
			'type' => 'fk',
			'columns' => ['b4_registration_tenant_id', 'b4_registration_period_id'],
			'foreign_model' => '\Model\Periods',
			'foreign_columns' => ['b4_period_tenant_id', 'b4_period_id']
		],
		'b4_registration_in_group_id_fk' => [
			'type' => 'fk',
			'columns' => ['b4_registration_tenant_id', 'b4_registration_in_group_id'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Groups',
			'foreign_columns' => ['in_group_tenant_id', 'in_group_id']
		],
		'b4_registration_register_id_fk' => [
			'type' => 'fk',
			'columns' => ['b4_registration_tenant_id', 'b4_registration_register_id'],
			'foreign_model' => '\Model\Register',
			'foreign_columns' => ['b4_register_tenant_id', 'b4_register_id']
		]
	];
	public $indexes = [
		'b4_registrations_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['b4_registration_child_name', 'b4_registration_parents_name', 'b4_registration_parish', 'b4_registration_email', 'b4_registration_phone']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'b4_registration_tenant_id' => 'wg_audit_tenant_id',
			'b4_registration_id' => 'wg_audit_registration_id'
		]
	];
	public $optimistic_lock = false;
	public $options_map;
	public $options_active;
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}