<?php

namespace Numbers\Users\Advertising\Model;
class Promocodes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'AM';
	public $title = 'A/M Promocodes';
	public $schema;
	public $name = 'am_promocodes';
	public $pk = ['am_promocode_tenant_id', 'am_promocode_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'am_promocode_';
	public $columns = [
		'am_promocode_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'am_promocode_id' => ['name' => 'Promocode #', 'domain' => 'promocode_id_sequence'],
		'am_promocode_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'am_promocode_name' => ['name' => 'Name', 'domain' => 'name'],
		'am_promocode_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
		'am_promocode_category_id' => ['name' => 'Category #', 'domain' => 'group_id'],
		'am_promocode_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'am_promocode_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'am_promocode_effective_from' => ['name' => 'Effective From', 'type' => 'date', 'null' => true],
		'am_promocode_effective_to' => ['name' => 'Effective To', 'type' => 'date', 'null' => true],
		'am_promocode_promocode' => ['name' => 'Promocode', 'domain' => 'promocode'],
		'am_promocode_barcode' => ['name' => 'Barcode', 'domain' => 'barcode', 'null' => true],
		'am_promocode_all_locations' => ['name' => 'All Locations', 'type' => 'boolean'],
		'am_promocode_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'am_promocodes_pk' => ['type' => 'pk', 'columns' => ['am_promocode_tenant_id', 'am_promocode_id']],
		'am_promocode_code_un' => ['type' => 'unique', 'columns' => ['am_promocode_tenant_id', 'am_promocode_code']],
		'am_promocode_category_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_promocode_tenant_id', 'am_promocode_category_id'],
			'foreign_model' => '\Numbers\Users\Advertising\Model\Categories',
			'foreign_columns' => ['am_category_tenant_id', 'am_category_id']
		],
		'am_promocode_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_promocode_tenant_id', 'am_promocode_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'am_promocode_brand_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_promocode_tenant_id', 'am_promocode_brand_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Brands',
			'foreign_columns' => ['on_brand_tenant_id', 'on_brand_id']
		]
	];
	public $indexes = [
		'am_promocodes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['am_promocode_code', 'am_promocode_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'am_promocode_tenant_id' => 'wg_audit_tenant_id',
			'am_promocode_id' => 'wg_audit_adcode_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'am_promocode_name' => 'name'
	];
	public $options_active = [
		'am_promocode_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}