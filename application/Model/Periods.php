<?php

namespace Model;
class Periods extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'B4';
	public $title = 'B/4 Periods';
	public $name = 'b4_periods';
	public $pk = ['b4_period_tenant_id', 'b4_period_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'b4_period_';
	public $columns = [
		'b4_period_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'b4_period_id' => ['name' => 'Period #', 'domain' => 'group_id_sequence'],
		'b4_period_code' => ['name' => 'Code', 'domain' => 'code'],
		'b4_period_name' => ['name' => 'Name', 'domain' => 'name'],
		'b4_period_start_date' => ['name' => 'Registration Start Date', 'type' => 'datetime'],
		'b4_period_end_date' => ['name' => 'Registration End Date', 'type' => 'datetime'],
		'b4_period_camp_start_date' => ['name' => 'Camp Start Date', 'type' => 'datetime'],
		'b4_period_camp_end_date' => ['name' => 'Camp End Date', 'type' => 'datetime'],
		// training
		'b4_period_training_start_date' => ['name' => 'Training Start Date', 'type' => 'date', 'null' => true],
		'b4_period_training_end_date' => ['name' => 'Training End Date', 'type' => 'date', 'null' => true],
		'b4_period_training_submit_date' => ['name' => 'Training Submit Date', 'type' => 'date', 'null' => true],
		'b4_period_training_notification_date' => ['name' => 'Training Notification Date', 'type' => 'date', 'null' => true],
		// counters
		'b4_period_max_registrations' => ['name' => 'Max Registrations', 'domain' => 'counter'],
		'b4_period_new_registrations' => ['name' => 'New Registrations', 'domain' => 'counter'], // readonly field
		'b4_period_confirmed_registrations' => ['name' => 'Confirmed Registrations', 'domain' => 'counter'], // readonly field
		'b4_period_current' => ['name' => 'Current', 'type' => 'char', 'null' => true],
		'b4_period_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'b4_periods_pk' => ['type' => 'pk', 'columns' => ['b4_period_tenant_id', 'b4_period_id']],
		'b4_period_code_un' => ['type' => 'unique', 'columns' => ['b4_period_tenant_id', 'b4_period_code']],
		'b4_period_current_un' => ['type' => 'unique', 'columns' => ['b4_period_tenant_id', 'b4_period_current']],
	];
	public $indexes = [
		'b4_periods_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['b4_period_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'b4_period_tenant_id' => 'wg_audit_tenant_id',
			'b4_period_id' => 'wg_audit_period_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}