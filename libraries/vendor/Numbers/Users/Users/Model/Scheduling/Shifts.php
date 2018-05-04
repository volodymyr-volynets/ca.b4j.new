<?php

namespace Numbers\Users\Users\Model\Scheduling;
class Shifts extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Shifts';
	public $name = 'um_scheduling_shifts';
	public $pk = ['um_schedshift_tenant_id', 'um_schedshift_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_schedshift_';
	public $columns = [
		'um_schedshift_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_schedshift_id' => ['name' => 'Shift #', 'domain' => 'shift_id_sequence'],
		'um_schedshift_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_schedshift_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'null' => true],
		'um_schedshift_location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'null' => true],
		'um_schedshift_work_starts' => ['name' => 'Work Starts', 'type' => 'time'],
		'um_schedshift_work_ends' => ['name' => 'Work Ends', 'type' => 'time'],
		'um_schedshift_lunch_starts' => ['name' => 'Lunch Starts', 'type' => 'time'],
		'um_schedshift_lunch_ends' => ['name' => 'Lunch Ends', 'type' => 'time'],
		'um_schedshift_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_scheduling_shifts_pk' => ['type' => 'pk', 'columns' => ['um_schedshift_tenant_id', 'um_schedshift_id']],
	];
	public $indexes = [
		'um_scheduling_shifts_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_schedshift_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_schedshift_tenant_id' => 'wg_audit_tenant_id',
			'um_schedshift_id' => 'wg_audit_shift_id'
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