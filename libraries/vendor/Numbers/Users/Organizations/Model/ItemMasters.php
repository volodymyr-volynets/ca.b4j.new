<?php

namespace Numbers\Users\Organizations\Model;
class ItemMasters extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Item Master';
	public $schema;
	public $name = 'on_item_masters';
	public $pk = ['on_itemmaster_tenant_id', 'on_itemmaster_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_itemmaster_';
	public $columns = [
		'on_itemmaster_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_itemmaster_id' => ['name' => 'Item Master #', 'domain' => 'item_master_id_sequence'],
		'on_itemmaster_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_itemmaster_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_itemmaster_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_item_masters_pk' => ['type' => 'pk', 'columns' => ['on_itemmaster_tenant_id', 'on_itemmaster_id']],
		'on_itemmaster_code_un' => ['type' => 'unique', 'columns' => ['on_itemmaster_tenant_id', 'on_itemmaster_code']],
	];
	public $indexes = [
		'on_item_masters_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_itemmaster_code', 'on_itemmaster_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_itemmaster_tenant_id' => 'wg_audit_tenant_id',
			'on_itemmaster_id' => 'wg_audit_itemmaster_id'
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