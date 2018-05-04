<?php

namespace Numbers\Users\Advertising\Model\AdCode;
class Locations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'AM';
	public $title = 'A/M Ad Code Locations';
	public $name = 'am_adcode_locations';
	public $pk = ['am_adcodloc_tenant_id', 'am_adcodloc_adcode_id', 'am_adcodloc_location_id'];
	public $tenant = true;
	public $orderby = [
		'am_adcodloc_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'am_adcodloc_';
	public $columns = [
		'am_adcodloc_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'am_adcodloc_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'am_adcodloc_adcode_id' => ['name' => 'Adcode #', 'domain' => 'adcode_id'],
		'am_adcodloc_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'am_adcodloc_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'am_adcode_locations_pk' => ['type' => 'pk', 'columns' => ['am_adcodloc_tenant_id', 'am_adcodloc_adcode_id', 'am_adcodloc_location_id']],
		'am_adcodloc_adcode_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_adcodloc_tenant_id', 'am_adcodloc_adcode_id'],
			'foreign_model' => '\Numbers\Users\Advertising\Model\AdCodes',
			'foreign_columns' => ['am_adcode_tenant_id', 'am_adcode_id']
		],
		'am_adcodloc_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_adcodloc_tenant_id', 'am_adcodloc_location_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Locations',
			'foreign_columns' => ['on_location_tenant_id', 'on_location_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
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