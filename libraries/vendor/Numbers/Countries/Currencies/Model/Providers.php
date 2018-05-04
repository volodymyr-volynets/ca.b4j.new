<?php

namespace Numbers\Countries\Currencies\Model;
class Providers extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Providers';
	public $name = 'cy_providers';
	public $pk = ['cy_provider_tenant_id', 'cy_provider_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cy_provider_';
	public $columns = [
		'cy_provider_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_provider_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'cy_provider_name' => ['name' => 'Name', 'domain' => 'name'],
		'cy_provider_method' => ['name' => 'Method', 'type' => 'text'],
		'cy_provider_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cy_providers_pk' => ['type' => 'pk', 'columns' => ['cy_provider_tenant_id', 'cy_provider_code']]
	];
	public $indexes = [
		'cy_providers_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['cy_provider_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'cy_provider_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $data_asset = [
		'classification' => 'public',
		'protection' => 0,
		'scope' => 'global'
	];
}