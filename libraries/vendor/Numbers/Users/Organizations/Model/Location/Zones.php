<?php

namespace Numbers\Users\Organizations\Model\Location;
class Zones extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Location Zones / Slots';
	public $schema;
	public $name = 'on_location_zones';
	public $pk = ['on_loczone_tenant_id', 'on_loczone_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_loczone_';
	public $columns = [
		'on_loczone_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_loczone_id' => ['name' => 'Zone / Slot #', 'domain' => 'group_id_sequence'],
		'on_loczone_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'on_loczone_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'on_loczone_zone_code' => ['name' => 'Zone Code', 'domain' => 'type_code'],
		'on_loczone_aisle_code' => ['name' => 'Aisle Code', 'domain' => 'type_code'],
		'on_loczone_bay_code' => ['name' => 'Bay Code', 'domain' => 'type_code'],
		'on_loczone_level_code' => ['name' => 'Level Code', 'domain' => 'type_code'],
		'on_loczone_slot_code' => ['name' => 'Slot Code', 'domain' => 'type_code'],
		'on_loczone_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_location_zones_pk' => ['type' => 'pk', 'columns' => ['on_loczone_tenant_id', 'on_loczone_id']],
		'on_loczone_slot_code_un' => ['type' => 'unique', 'columns' => ['on_loczone_tenant_id', 'on_loczone_location_id', 'on_loczone_zone_code', 'on_loczone_aisle_code', 'on_loczone_bay_code', 'on_loczone_level_code', 'on_loczone_slot_code']],
		'on_loczone_location_id_un' => ['type' => 'unique', 'columns' => ['on_loczone_tenant_id', 'on_loczone_id', 'on_loczone_location_id']],
		'on_loczone_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_loczone_tenant_id', 'on_loczone_location_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Locations',
			'foreign_columns' => ['on_location_tenant_id', 'on_location_id']
		],
	];
	public $indexes = [
		'on_location_zones_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_loczone_name', 'on_loczone_zone_code', 'on_loczone_aisle_code', 'on_loczone_bay_code', 'on_loczone_level_code', 'on_loczone_slot_code']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_loczone_tenant_id' => 'wg_audit_tenant_id',
			'on_loczone_id' => 'wg_audit_loczone_id'
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