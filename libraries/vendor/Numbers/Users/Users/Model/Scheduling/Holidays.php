<?php

namespace Numbers\Users\Users\Model\Scheduling;
class Holidays extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Holidays';
	public $name = 'um_scheduling_holidays';
	public $pk = ['um_schedholi_tenant_id', 'um_schedholi_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_schedholi_';
	public $columns = [
		'um_schedholi_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_schedholi_id' => ['name' => 'Holiday #', 'domain' => 'holiday_id_sequence'],
		'um_schedholi_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_schedholi_date' => ['name' => 'Date', 'type' => 'date'],
		'um_schedholi_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'null' => true],
		'um_schedholi_location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'null' => true],
		'um_schedholi_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'um_schedholi_province_code' => ['name' => 'Province Code', 'domain' => 'province_code', 'null' => true],
		'um_schedholi_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_scheduling_holidays_pk' => ['type' => 'pk', 'columns' => ['um_schedholi_tenant_id', 'um_schedholi_id']],
	];
	public $indexes = [
		'um_scheduling_holidays_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_schedholi_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_schedholi_tenant_id' => 'wg_audit_tenant_id',
			'um_schedholi_id' => 'wg_audit_holiday_id'
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