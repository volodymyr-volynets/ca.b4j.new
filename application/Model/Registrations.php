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
		'b4_registration_id' => ['name' => 'Register #', 'domain' => 'big_id_sequence'],
		'b4_registration_period_id' => ['name' => 'Period #', 'domain' => 'group_id'],
		'b4_registration_period_code' => ['name' => 'Code', 'domain' => 'code'],
		'b4_registration_in_group_id' => ['name' => 'I/N Group #', 'domain' => 'group_id'],
		// name
		'b4_registration_child_name' => ['name' => 'Name of Child', 'domain' => 'name'],
		'b4_registration_parents_name' => ['name' => 'Parents Name', 'domain' => 'name'],
		'b4_registration_parish' => ['name' => 'Parish', 'domain' => 'name', 'null' => true],
		'b4_registration_grade' => ['name' => 'Grade', 'type' => 'smallint'],
		'b4_registration_age' => ['name' => 'Age', 'type' => 'smallint'],
		'b4_registration_date_of_birth' => ['name' => 'Date of Birth', 'type' => 'date'],
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
		'b4_registration_emergency_line1' => ['name' => 'Emergency Line 1', 'type' => 'text', 'null' => true],
		'b4_registration_emergency_line2' => ['name' => 'Emergency Line 2', 'type' => 'text', 'null' => true],
		//
		'b4_registration_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
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
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
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