<?php

namespace Numbers\Countries\Currencies\Model\Currency;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Currency Organizations';
	public $name = 'cy_currency_organizations';
	public $pk = ['cy_currorg_tenant_id', 'cy_currorg_currency_code', 'cy_currorg_organization_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'cy_currorg_';
	public $columns = [
		'cy_currorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_currorg_currency_code' => ['name' => 'Currency Code', 'domain' => 'currency_code'],
		'cy_currorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id']
	];
	public $constraints = [
		'cy_currency_organizations_pk' => ['type' => 'pk', 'columns' => ['cy_currorg_tenant_id', 'cy_currorg_currency_code', 'cy_currorg_organization_id']],
		'cy_currorg_currency_code_fk' => [
			'type' => 'fk',
			'columns' => ['cy_currorg_tenant_id', 'cy_currorg_currency_code'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Currencies',
			'foreign_columns' => ['cy_currency_tenant_id', 'cy_currency_code']
		],
		'cy_currorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['cy_currorg_tenant_id', 'cy_currorg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
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