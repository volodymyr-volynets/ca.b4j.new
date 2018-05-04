<?php

namespace Numbers\Countries\Currencies\Model;
class Currencies extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Currencies';
	public $name = 'cy_currency_codes';
	public $pk = ['cy_currency_tenant_id', 'cy_currency_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cy_currency_';
	public $columns = [
		'cy_currency_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_currency_code' => ['name' => 'Currency Code', 'domain' => 'currency_code'],
		'cy_currency_name' => ['name' => 'Name', 'domain' => 'name'],
		'cy_currency_symbol' => ['name' => 'Symbol', 'domain' => 'name'],
		'cy_currency_fraction_digits' => ['name' => 'Fraction Digits', 'domain' => 'fraction_digits', 'options_model' => '\Numbers\Countries\Currencies\Model\Fractions'],
		'cy_currency_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cy_currency_codes_pk' => ['type' => 'pk', 'columns' => ['cy_currency_tenant_id', 'cy_currency_code']]
	];
	public $indexes = [
		'cy_currency_codes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['cy_currency_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'cy_currency_code' => 'name',
		'cy_currency_name' => 'name',
		'cy_currency_fraction_digits' => 'cy_currency_fraction_digits'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	public $relation = [
		'field' => 'cy_currency_code',
	];

	/**
	 * Options for format
	 *
	 * @param array $options
	 * @return array
	 */
	public function optionsForFormat($options = []) {
		$options['options_map'] = [
			'cy_currency_name' => 'name',
			'cy_currency_fraction_digits' => 'fraction_digits',
			'cy_currency_symbol' => 'symbol',
			'cy_currency_locale' => 'locale'
		];
		return parent::options($options);
	}
}