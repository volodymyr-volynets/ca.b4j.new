<?php

namespace Numbers\Countries\Currencies\Model;
class Rates extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Rates';
	public $name = 'cy_currency_rates';
	public $pk = ['cy_currrate_tenant_id', 'cy_currrate_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cy_currrate_';
	public $columns = [
		'cy_currrate_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_currrate_id' => ['name' => 'Rate #', 'domain' => 'currency_rate_id_sequence'],
		'cy_currrate_datetime' => ['name' => 'Datetime', 'type' => 'datetime'],
		'cy_currrate_currency_type' => ['name' => 'Type', 'domain' => 'currency_type', 'null' => false],
		'cy_currrate_source_currency_code' => ['name' => 'Source Currency', 'domain' => 'currency_code'],
		'cy_currrate_home_currency_code' => ['name' => 'Home Currency', 'domain' => 'currency_code'],
		'cy_currrate_rate' => ['name' => 'Rate', 'domain' => 'currency_rate'],
		'cy_currrate_provider_name' => ['name' => 'Provider Name', 'domain' => 'name', 'null' => true],
		'cy_currrate_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cy_currency_rates_pk' => ['type' => 'pk', 'columns' => ['cy_currrate_tenant_id', 'cy_currrate_id']],
		'cy_currrate_currency_type_un' => ['type' => 'unique', 'columns' => ['cy_currrate_tenant_id', 'cy_currrate_currency_type', 'cy_currrate_source_currency_code', 'cy_currrate_home_currency_code', 'cy_currrate_datetime']],
		'cy_currrate_currency_type_fk' => [
			'type' => 'fk',
			'columns' => ['cy_currrate_tenant_id', 'cy_currrate_currency_type'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Types',
			'foreign_columns' => ['cy_currtype_tenant_id', 'cy_currtype_code']
		],
		'cy_currrate_source_currency_code_fk' => [
			'type' => 'fk',
			'columns' => ['cy_currrate_tenant_id', 'cy_currrate_source_currency_code'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Currencies',
			'foreign_columns' => ['cy_currency_tenant_id', 'cy_currency_code']
		],
		'cy_currrate_home_currency_code_fk' => [
			'type' => 'fk',
			'columns' => ['cy_currrate_tenant_id', 'cy_currrate_home_currency_code'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Currencies',
			'foreign_columns' => ['cy_currency_tenant_id', 'cy_currency_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $preset_map = [
		'cy_currrate_provider_name' => 'name'
	];
	public $preset_active = [];
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