<?php

namespace Numbers\Tenants\Tenants\Model;
class Registries extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Registries';
	public $name = 'tm_registries';
	public $pk = ['tm_registry_tenant_id', 'tm_registry_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_registry_';
	public $columns = [
		'tm_registry_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_registry_code' => ['name' => 'Registry Code', 'domain' => 'code'],
		'tm_registry_value' => ['name' => 'Value', 'type' => 'text'],
		'tm_registry_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_registries_pk' => ['type' => 'pk', 'columns' => ['tm_registry_tenant_id', 'tm_registry_code']]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}