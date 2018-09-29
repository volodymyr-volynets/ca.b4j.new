<?php

namespace Numbers\Tenants\Tenants\DataSource;
class Registries extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Tenants\Tenants\Model\Registries';
	public $parameters = [];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'code' => 'a.tm_registry_code',
			'value' => 'a.tm_registry_value',
			'inactive' => 'a.tm_registry_inactive',
		]);
		// where
		$this->query->where('AND', ['a.tm_registry_inactive', '=', 0]);
	}
}