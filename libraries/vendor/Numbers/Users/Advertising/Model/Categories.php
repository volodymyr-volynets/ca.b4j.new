<?php

namespace Numbers\Users\Advertising\Model;
class Categories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'AM';
	public $title = 'A/M Categories';
	public $schema;
	public $name = 'am_categories';
	public $pk = ['am_category_tenant_id', 'am_category_id'];
	public $tenant = true;
	public $orderby = [
		'am_category_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'am_category_';
	public $columns = [
		'am_category_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'am_category_id' => ['name' => 'Category #', 'domain' => 'group_id_sequence'],
		'am_category_name' => ['name' => 'Name', 'domain' => 'name'],
		'am_category_order' => ['name' => 'Order', 'domain' => 'order'],
		'am_category_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'am_categories_pk' => ['type' => 'pk', 'columns' => ['am_category_tenant_id', 'am_category_id']],
	];
	public $indexes = [
		'am_categories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['am_category_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'am_category_tenant_id' => 'wg_audit_tenant_id',
			'am_category_id' => 'wg_audit_category_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'am_category_name' => 'name'
	];
	public $options_active = [
		'am_category_inactive' => 0
	];
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