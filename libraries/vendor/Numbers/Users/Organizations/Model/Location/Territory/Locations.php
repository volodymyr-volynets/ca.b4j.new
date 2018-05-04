<?php

namespace Numbers\Users\Organizations\Model\Location\Territory;
class Locations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Territory Locations';
	public $name = 'on_territory_locations';
	public $pk = ['on_terrloc_tenant_id', 'on_terrloc_territory_id', 'on_terrloc_location_id'];
	public $tenant = true;
	public $orderby = [
		'on_terrloc_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_terrloc_';
	public $columns = [
		'on_terrloc_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_terrloc_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_terrloc_territory_id' => ['name' => 'Territory #', 'domain' => 'territory_id'],
		'on_terrloc_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'on_terrloc_primary' => ['name' => 'Primary', 'type' => 'boolean'],
		'on_terrloc_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_territory_locations_pk' => ['type' => 'pk', 'columns' => ['on_terrloc_tenant_id', 'on_terrloc_territory_id', 'on_terrloc_location_id']],
		'on_terrloc_territory_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_terrloc_tenant_id', 'on_terrloc_territory_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Location\Territories',
			'foreign_columns' => ['on_territory_tenant_id', 'on_territory_id']
		],
		'on_terrloc_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_terrloc_tenant_id', 'on_terrloc_location_id'],
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