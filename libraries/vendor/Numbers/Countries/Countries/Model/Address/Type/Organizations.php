<?php

namespace Numbers\Countries\Countries\Model\Address\Type;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CM';
	public $title = 'C/M Address Type Organizations';
	public $name = 'cm_address_type_organizations';
	public $pk = ['cm_addrtporg_tenant_id', 'cm_addrtporg_type_code', 'cm_addrtporg_organization_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'cm_addrtporg_';
	public $columns = [
		'cm_addrtporg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cm_addrtporg_type_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'cm_addrtporg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id']
	];
	public $constraints = [
		'cm_address_type_organizations_pk' => ['type' => 'pk', 'columns' => ['cm_addrtporg_tenant_id',  'cm_addrtporg_type_code', 'cm_addrtporg_organization_id']],
		'cm_addrtporg_type_code_fk' => [
			'type' => 'fk',
			'columns' => ['cm_addrtporg_tenant_id', 'cm_addrtporg_type_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Address\Types',
			'foreign_columns' => ['cm_addrtype_tenant_id', 'cm_addrtype_code']
		],
		'cm_addrtporg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['cm_addrtporg_tenant_id', 'cm_addrtporg_organization_id'],
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