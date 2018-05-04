<?php

namespace Numbers\Countries\Currencies\Model\Type;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CY';
	public $title = 'C/Y Currency Type Organizations';
	public $name = 'cy_currency_type_organizations';
	public $pk = ['cy_curtypeorg_tenant_id', 'cy_curtypeorg_type_code', 'cy_curtypeorg_organization_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'cy_curtypeorg_';
	public $columns = [
		'cy_curtypeorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cy_curtypeorg_type_code' => ['name' => 'Type Code', 'domain' => 'currency_type', 'null' => false],
		'cy_curtypeorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id']
	];
	public $constraints = [
		'cy_currency_type_organizations_pk' => ['type' => 'pk', 'columns' => ['cy_curtypeorg_tenant_id', 'cy_curtypeorg_type_code', 'cy_curtypeorg_organization_id']],
		'cy_curtypeorg_type_code_fk' => [
			'type' => 'fk',
			'columns' => ['cy_curtypeorg_tenant_id', 'cy_curtypeorg_type_code'],
			'foreign_model' => '\Numbers\Countries\Currencies\Model\Types',
			'foreign_columns' => ['cy_currtype_tenant_id', 'cy_currtype_code']
		],
		'cy_curtypeorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['cy_curtypeorg_tenant_id', 'cy_curtypeorg_organization_id'],
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