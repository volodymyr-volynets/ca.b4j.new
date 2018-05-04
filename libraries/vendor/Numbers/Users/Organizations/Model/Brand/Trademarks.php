<?php

namespace Numbers\Users\Organizations\Model\Brand;
class Trademarks extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Brand Trademarks';
	public $name = 'on_brand_trademarks';
	public $pk = ['on_brndtrdmrk_tenant_id', 'on_brndtrdmrk_brand_id', 'on_brndtrdmrk_trademark_id'];
	public $tenant = true;
	public $orderby = [
		'on_brndtrdmrk_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_brndtrdmrk_';
	public $columns = [
		'on_brndtrdmrk_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_brndtrdmrk_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_brndtrdmrk_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'on_brndtrdmrk_trademark_id' => ['name' => 'Trademark #', 'domain' => 'trademark_id'],
		'on_brndtrdmrk_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_brand_trademarks_pk' => ['type' => 'pk', 'columns' => ['on_brndtrdmrk_tenant_id', 'on_brndtrdmrk_brand_id', 'on_brndtrdmrk_trademark_id']],
		'on_brndtrdmrk_trademark_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_brndtrdmrk_tenant_id', 'on_brndtrdmrk_trademark_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Trademarks',
			'foreign_columns' => ['on_trademark_tenant_id', 'on_trademark_id']
		],
		'on_brndtrdmrk_brand_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_brndtrdmrk_tenant_id', 'on_brndtrdmrk_brand_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Brands',
			'foreign_columns' => ['on_brand_tenant_id', 'on_brand_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
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