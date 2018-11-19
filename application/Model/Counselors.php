<?php

namespace Model;
class Counselors extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'B4';
	public $title = 'B/4 Counselors';
	public $schema;
	public $name = 'b4_counselors';
	public $pk = ['b4_counselor_tenant_id', 'b4_counselor_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'b4_counselor_';
	public $columns = [
		'b4_counselor_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'b4_counselor_id' => ['name' => 'Registration #', 'domain' => 'big_id_sequence'],
		'b4_counselor_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'b4_counselor_period_id' => ['name' => 'Period #', 'domain' => 'group_id', 'options_model' => '\Model\Periods'],
		'b4_counselor_status_id' => ['name' => 'Status', 'domain' => 'status_id', 'default' => 10, 'options_model' => '\Model\Counselor\Statuses'],
		// name
		'b4_counselor_child_name' => ['name' => 'Name of Child', 'domain' => 'name'],
		'b4_counselor_badge_name' => ['name' => 'Badge Name', 'domain' => 'name'],
		'b4_counselor_parish' => ['name' => 'Parish', 'domain' => 'name', 'null' => true],
		'b4_counselor_date_of_birth' => ['name' => 'Date of Birth', 'type' => 'date'],
		'b4_counselor_grade' => ['name' => 'Grade', 'type' => 'smallint', 'null' => true],
		// address
		'b4_counselor_address1' => ['name' => 'Address Line 1', 'domain' => 'name'],
		'b4_counselor_address2' => ['name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
		'b4_counselor_city' => ['name' => 'City', 'domain' => 'name'],
		'b4_counselor_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'b4_counselor_country_code' => ['name' => 'Country', 'domain' => 'country_code'],
		'b4_counselor_province_code' => ['name' => 'Province', 'domain' => 'province_code'],
		// contact
		'b4_counselor_email' => ['name' => 'Email', 'domain' => 'email'],
		'b4_counselor_phone' => ['name' => 'Phone', 'domain' => 'phone'],
		// emergency
		'b4_counselor_emergency_line1' => ['name' => 'Emergency Line 1', 'type' => 'text'],
		'b4_counselor_emergency_line2' => ['name' => 'Emergency Line 2', 'type' => 'text', 'null' => true],
		// medical
		'b4_counselor_medical_health_card_number' => ['name' => 'Health Card Number', 'domain' => 'code'],
		'b4_counselor_medical_doctors_info' => ['name' => 'Doctors Name and Phone', 'type' => 'text'],
		'b4_counselor_medical_alergies' => ['name' => 'Alergies', 'type' => 'text', 'null' => true],
		'b4_counselor_medical_dietary_restrictions' => ['name' => 'Dietary Restrictions', 'type' => 'text', 'null' => true],
		'b4_counselor_medical_anything_we_should_know' => ['name' => 'Anything we should know', 'type' => 'text', 'null' => true],
		// additional information
		'b4_counselor_additional_why_councelor' => ['name' => 'Why Councelor', 'type' => 'text'],
		'b4_counselor_additional_leadership_expirience' => ['name' => 'Leadership Expirience', 'type' => 'text', 'null' => true],
		'b4_counselor_additional_memorable_offer' => ['name' => 'Offer For Children Expirience Memorable', 'type' => 'text', 'null' => true],
		'b4_counselor_ukrainian_level_id' => ['name' => 'Level of Ukrainian', 'domain' => 'status_id', 'options_model' => '\Model\Counselor\UkrainianLevel'],
		// references
		'b4_counselor_reference_1_name' => ['name' => 'Reference 1 Name', 'domain' => 'name'],
		'b4_counselor_reference_1_position' => ['name' => 'Reference 1 Position', 'domain' => 'name'],
		'b4_counselor_reference_1_phone' => ['name' => 'Reference 1 Phone', 'domain' => 'phone'],
		'b4_counselor_reference_1_email' => ['name' => 'Reference 1 Email', 'domain' => 'email'],
		'b4_counselor_reference_2_name' => ['name' => 'Reference 2 Name', 'domain' => 'name'],
		'b4_counselor_reference_2_position' => ['name' => 'Reference 2 Position', 'domain' => 'name'],
		'b4_counselor_reference_2_phone' => ['name' => 'Reference 2 Phone', 'domain' => 'phone'],
		'b4_counselor_reference_2_email' => ['name' => 'Reference 2 Email', 'domain' => 'email'],
		// responsibility
		'b4_counselor_responsibility_sports' => ['name' => 'Responsiblity Sports', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_slideshow' => ['name' => 'Responsiblity Slideshow', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_chapel' => ['name' => 'Responsiblity Chapel', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_olympiada' => ['name' => 'Responsiblity Olympiada', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_technology' => ['name' => 'Responsiblity Technology', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_bingo' => ['name' => 'Responsiblity Bingo', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		'b4_counselor_responsibility_games' => ['name' => 'Responsiblity Games', 'domain' => 'status_id', 'null' => true, 'options_model' => '\Model\Counselor\Responsibilities'],
		// t-shirt
		'b4_counselor_tshirt_size' => ['name' => 'T-Shirt size', 'type' => 'smallint', 'null' => true, 'options_model' => '\Model\TShirtSize'],
		// signature
		'b4_counselor_parents_name' => ['name' => 'Parents Name', 'domain' => 'name'],
		'b4_counselor_signature' => ['name' => 'Signature of Parent/Guardian', 'domain' => 'signature'],
		'b4_counselor_signing_date' => ['name' => 'Signing Date', 'type' => 'date'],
		// declaration
		'b4_counselor_declartion_police_check_submitted' => ['name' => 'Police Check Submitted', 'type' => 'boolean'],
		'b4_counselor_declartion_signed_at' => ['name' => 'Declaration Singed At', 'domain' => 'name', 'null' => true],
		'b4_counselor_declartion_last_police_check' => ['name' => 'Declaration Last police Check', 'type' => 'date', 'null' => true],
		'b4_counselor_declartion_signature' => ['name' => 'Child Declaration Signature', 'domain' => 'signature', 'null' => true],
		'b4_counselor_declartion_signing_date' => ['name' => 'Child Declaration Signing Date', 'type' => 'date', 'null' => true],
		// other
		'b4_counselor_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'b4_counselors_pk' => ['type' => 'pk', 'columns' => ['b4_counselor_tenant_id', 'b4_counselor_id']],
		'b4_counselor_period_id_fk' => [
			'type' => 'fk',
			'columns' => ['b4_counselor_tenant_id', 'b4_counselor_period_id'],
			'foreign_model' => '\Model\Periods',
			'foreign_columns' => ['b4_period_tenant_id', 'b4_period_id']
		],
	];
	public $indexes = [
		'b4_counselors_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['b4_counselor_child_name', 'b4_counselor_parents_name', 'b4_counselor_parish', 'b4_counselor_email', 'b4_counselor_phone']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'b4_counselor_tenant_id' => 'wg_audit_tenant_id',
			'b4_counselor_id' => 'wg_audit_counselor_id'
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