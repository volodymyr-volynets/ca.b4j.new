<?php

namespace Numbers\Users\Advertising\Model\Promocode;
class Locations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'AM';
	public $title = 'A/M Promocode Locations';
	public $name = 'am_promocode_locations';
	public $pk = ['am_promoloc_tenant_id', 'am_promoloc_promocode_id', 'am_promoloc_location_id'];
	public $tenant = true;
	public $orderby = [
		'am_promoloc_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'am_promoloc_';
	public $columns = [
		'am_promoloc_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'am_promoloc_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'am_promoloc_promocode_id' => ['name' => 'Promocode #', 'domain' => 'promocode_id'],
		'am_promoloc_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'am_promoloc_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'am_promocode_locations_pk' => ['type' => 'pk', 'columns' => ['am_promoloc_tenant_id', 'am_promoloc_promocode_id', 'am_promoloc_location_id']],
		'am_promoloc_promocode_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_promoloc_tenant_id', 'am_promoloc_promocode_id'],
			'foreign_model' => '\Numbers\Users\Advertising\Model\Promocodes',
			'foreign_columns' => ['am_promocode_tenant_id', 'am_promocode_id']
		],
		'am_promoloc_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_promoloc_tenant_id', 'am_promoloc_location_id'],
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