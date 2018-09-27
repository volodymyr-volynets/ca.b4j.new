<?php

namespace Numbers\Users\Organizations\Model;
class Locations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Locations';
	public $schema;
	public $name = 'on_locations';
	public $pk = ['on_location_tenant_id', 'on_location_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_location_';
	public $columns = [
		'on_location_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_location_id' => ['name' => 'Location #', 'domain' => 'location_id_sequence'],
		'on_location_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_location_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_location_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Types'],
		// contact
		'on_location_email' => ['name' => 'Primary Email', 'domain' => 'email', 'null' => true],
		'on_location_email2' => ['name' => 'Secondary Email', 'domain' => 'email', 'null' => true],
		'on_location_phone' => ['name' => 'Primary Phone', 'domain' => 'phone', 'null' => true],
		'on_location_phone2' => ['name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true],
		'on_location_cell' => ['name' => 'Cell Phone', 'domain' => 'phone', 'null' => true],
		'on_location_fax' => ['name' => 'Fax', 'domain' => 'phone', 'null' => true],
		// primary address
		'on_location_address_line1' => ['name' => 'Address Line 1', 'domain' => 'name'],
		'on_location_address_line2' => ['name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
		'on_location_city' => ['name' => 'City', 'domain' => 'name'],
		'on_location_province_code' => ['name' => 'Province Code', 'domain' => 'province_code'],
		'on_location_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'on_location_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'on_location_latitude' => ['name' => 'Latitude', 'domain' => 'geo_coordinate'],
		'on_location_longitude' => ['name' => 'Longitude', 'domain' => 'geo_coordinate'],
		// organization
		'on_location_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_location_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'on_location_district_id' => ['name' => 'District #', 'domain' => 'district_id'],
		'on_location_market_id' => ['name' => 'Market #', 'domain' => 'market_id'],
		'on_location_region_id' => ['name' => 'Region #', 'domain' => 'region_id'],
		'on_location_item_master_id' => ['name' => 'Item Master #', 'domain' => 'item_master_id'],
		// logo
		'on_location_logo_file_id' => ['name' => 'Logo File #', 'domain' => 'file_id', 'null' => true],
		// inactive & hold
		'on_location_hold' => ['name' => 'Hold', 'type' => 'boolean'],
		'on_location_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_locations_pk' => ['type' => 'pk', 'columns' => ['on_location_tenant_id', 'on_location_id']],
		'on_location_code_un' => ['type' => 'unique', 'columns' => ['on_location_tenant_id', 'on_location_code']],
		'on_location_item_master_id_un' => ['type' => 'unique', 'columns' => ['on_location_tenant_id', 'on_location_id', 'on_location_item_master_id']],
		'on_location_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_location_brand_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_brand_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Brands',
			'foreign_columns' => ['on_brand_tenant_id', 'on_brand_id']
		],
		'on_location_district_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_district_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Districts',
			'foreign_columns' => ['on_district_tenant_id', 'on_district_id']
		],
		'on_location_market_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_market_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Markets',
			'foreign_columns' => ['on_market_tenant_id', 'on_market_id']
		],
		'on_location_region_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_region_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Regions',
			'foreign_columns' => ['on_region_tenant_id', 'on_region_id']
		],
		'on_location_item_master_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_location_tenant_id', 'on_location_item_master_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\ItemMasters',
			'foreign_columns' => ['on_itemmaster_tenant_id', 'on_itemmaster_id']
		]
	];
	public $indexes = [
		'on_locations_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_location_code', 'on_location_name', 'on_location_phone', 'on_location_email']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_location_tenant_id' => 'wg_audit_tenant_id',
			'on_location_id' => 'wg_audit_location_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_location_name' => 'name',
		'on_location_logo_file_id' => 'photo_id',
		'on_location_inactive' => 'inactive'
	];
	public $options_active = [
		'on_location_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $addresses = [
		'map' => [
			'on_location_tenant_id' => 'wg_address_tenant_id',
			'on_location_id' => 'wg_address_location_id'
		]
	];

	public $attributes = [
		'map' => [
			'on_location_tenant_id' => 'wg_attribute_tenant_id',
			'on_location_id' => 'wg_attribute_location_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}