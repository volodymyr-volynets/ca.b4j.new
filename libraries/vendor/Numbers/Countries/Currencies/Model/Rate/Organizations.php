<?php

namespace Numbers\Countries\Currencies\Model\Rate;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Currency Rate Organizations';
	public $name = 'cy_currency_rate_organizations';
	public $pk = ['cy_curateorg_tenant_id', 'cy_curateorg_rate_id', 'cy_curateorg_organization_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'cy_curateorg_';
	public $columns = [
		'cy_curateorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_curateorg_rate_id' => ['name' => 'Rate #', 'domain' => 'currency_rate_id'],
		'cy_curateorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id']
	];
	public $constraints = [
		'cy_currency_rate_organizations_pk' => ['type' => 'pk', 'columns' => ['cy_curateorg_tenant_id', 'cy_curateorg_rate_id', 'cy_curateorg_organization_id']],
		'cy_curateorg_rate_id_fk' => [
			'type' => 'fk',
			'columns' => ['cy_curateorg_tenant_id', 'cy_curateorg_rate_id'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Rates',
			'foreign_columns' => ['cy_currrate_tenant_id', 'cy_currrate_id']
		],
		'cy_curateorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['cy_curateorg_tenant_id', 'cy_curateorg_organization_id'],
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