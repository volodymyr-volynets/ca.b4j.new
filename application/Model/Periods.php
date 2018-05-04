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
		'b4_period_id' => ['name' => 'Group #', 'domain' => 'group_id_sequence'],
		'b4_period_code' => ['name' => 'Code', 'domain' => 'code'],
		'b4_period_name' => ['name' => 'Name', 'domain' => 'name'],
		'b4_period_start_date' => ['name' => 'Start Date', 'type' => 'datetime'],
		'b4_period_end_date' => ['name' => 'End Date', 'type' => 'datetime'],
		'b4_period_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'b4_periods_pk' => ['type' => 'pk', 'columns' => ['b4_period_tenant_id', 'b4_period_id']],
		'b4_period_code_un' => ['type' => 'unique', 'columns' => ['b4_period_tenant_id', 'b4_period_code']],
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