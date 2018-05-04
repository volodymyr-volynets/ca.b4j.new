<?php

namespace Numbers\Users\Organizations\Model\Organization\Type;
class Map extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Type Map';
	public $name = 'on_organization_type_map';
	public $pk = ['on_orgtpmap_tenant_id', 'on_orgtpmap_organization_id', 'on_orgtpmap_type_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_orgtpmap_';
	public $columns = [
		'on_orgtpmap_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_orgtpmap_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_orgtpmap_type_code' => ['name' => 'Type Code', 'domain' => 'type_code'],
	];
	public $constraints = [
		'on_organization_type_map_pk' => ['type' => 'pk', 'columns' => ['on_orgtpmap_tenant_id', 'on_orgtpmap_organization_id', 'on_orgtpmap_type_code']],
		'on_orgtpmap_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgtpmap_tenant_id', 'on_orgtpmap_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_orgtpmap_type_code_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgtpmap_tenant_id', 'on_orgtpmap_type_code'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organization\Types',
			'foreign_columns' => ['on_orgtype_tenant_id', 'on_orgtype_code']
		]
	];
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