<?php

namespace Numbers\Users\Organizations\Model;
class Brands extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Brands';
	public $schema;
	public $name = 'on_brands';
	public $pk = ['on_brand_tenant_id', 'on_brand_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_brand_';
	public $columns = [
		'on_brand_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id_sequence'],
		'on_brand_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_brand_name' => ['name' => 'Name', 'domain' => 'name'],
		// logo
		'on_brand_logo_file_id' => ['name' => 'Logo File #', 'domain' => 'file_id', 'null' => true],
		// inactive
		'on_brand_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_brands_pk' => ['type' => 'pk', 'columns' => ['on_brand_tenant_id', 'on_brand_id']],
		'on_brand_code_un' => ['type' => 'unique', 'columns' => ['on_brand_tenant_id', 'on_brand_code']]
	];
	public $indexes = [
		'on_brands_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_brand_code', 'on_brand_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_brand_tenant_id' => 'wg_audit_tenant_id',
			'on_brand_id' => 'wg_audit_brand_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_brand_name' => 'name',
		'on_brand_logo_file_id' => 'photo_id'
	];
	public $options_active = [
		'on_brand_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'on_brand_id',
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}