<?php

namespace Numbers\Users\Organizations\Model;
class Trademarks extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Trademarks';
	public $schema;
	public $name = 'on_trademarks';
	public $pk = ['on_trademark_tenant_id', 'on_trademark_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_trademark_';
	public $columns = [
		'on_trademark_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_trademark_id' => ['name' => 'Trademark #', 'domain' => 'trademark_id_sequence'],
		'on_trademark_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_trademark_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_trademark_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_trademark_effective_from' => ['name' => 'Effective From', 'type' => 'date'],
		'on_trademark_effective_to' => ['name' => 'Effective To', 'type' => 'date', 'null' => true],
		'on_trademark_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_trademarks_pk' => ['type' => 'pk', 'columns' => ['on_trademark_tenant_id', 'on_trademark_id']],
		'on_trademark_code_un' => ['type' => 'unique', 'columns' => ['on_trademark_tenant_id', 'on_trademark_code']]
	];
	public $indexes = [
		'on_trademarks_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_trademark_code', 'on_trademark_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_trademark_tenant_id' => 'wg_audit_tenant_id',
			'on_trademark_id' => 'wg_audit_trademark_id'
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