<?php

namespace Numbers\Countries\Currencies\DataSource;
class Currencies extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [
		'code' => 'name',
		'name' => 'name',
		'inactive' => 'inactive'
	];
	public $options_active = [];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Countries\Currencies\Model\Currencies';
	public $parameters = [];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'code' => 'a.cy_currency_code',
			'name' => 'a.cy_currency_name',
			'symbol' => 'a.cy_currency_symbol',
			'fraction_digits' => 'a.cy_currency_fraction_digits',
			'inactive' => 'a.cy_currency_inactive'
		]);
	}
}