<?php

namespace Numbers\Users\News\Model;
class Categories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'NS';
	public $title = 'N/S Categories';
	public $schema;
	public $name = 'ns_categories';
	public $pk = ['ns_category_tenant_id', 'ns_category_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ns_category_';
	public $columns = [
		'ns_category_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ns_category_id' => ['name' => 'Category #', 'domain' => 'group_id_sequence'],
		'ns_category_name' => ['name' => 'Name', 'domain' => 'name'],
		'ns_category_order' => ['name' => 'Order', 'domain' => 'order'],
		'ns_category_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ns_categories_pk' => ['type' => 'pk', 'columns' => ['ns_category_tenant_id', 'ns_category_id']],
	];
	public $indexes = [
		'ns_categories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ns_category_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'ns_category_tenant_id' => 'wg_audit_tenant_id',
			'ns_category_id' => 'wg_audit_category_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'ns_category_name' => 'name'
	];
	public $options_active = [
		'ns_category_inactive' => 0
	];
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