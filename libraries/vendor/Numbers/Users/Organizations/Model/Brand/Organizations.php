<?php

namespace Numbers\Users\Organizations\Model\Brand;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Brand Organizations';
	public $name = 'on_brand_organizations';
	public $pk = ['on_brndorg_tenant_id', 'on_brndorg_brand_id', 'on_brndorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'on_brndorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_brndorg_';
	public $columns = [
		'on_brndorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_brndorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_brndorg_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'on_brndorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_brndorg_primary' => ['name' => 'Primary', 'type' => 'boolean'],
		'on_brndorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_brand_organizations_pk' => ['type' => 'pk', 'columns' => ['on_brndorg_tenant_id', 'on_brndorg_brand_id', 'on_brndorg_organization_id']],
		'on_brndorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_brndorg_tenant_id', 'on_brndorg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_brndorg_brand_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_brndorg_tenant_id', 'on_brndorg_brand_id'],
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