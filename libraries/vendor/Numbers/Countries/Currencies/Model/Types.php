<?php

namespace Numbers\Countries\Currencies\Model;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Currency Types';
	public $name = 'cy_currency_types';
	public $pk = ['cy_currtype_tenant_id', 'cy_currtype_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cy_currtype_';
	public $columns = [
		'cy_currtype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_currtype_code' => ['name' => 'Type Code', 'domain' => 'currency_type', 'null' => false],
		'cy_currtype_name' => ['name' => 'Name', 'domain' => 'name'],
		'cy_currtype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cy_currency_types_pk' => ['type' => 'pk', 'columns' => ['cy_currtype_tenant_id', 'cy_currtype_code']]
	];
	public $indexes = [
		'cy_currency_types_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['cy_currtype_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'cy_currtype_code' => 'name',
		'cy_currtype_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $relation = [
		'field' => 'cy_currtype_code',
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}