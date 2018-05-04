<?php

namespace Numbers\Users\Organizations\Model;
class Regions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Regions';
	public $schema;
	public $name = 'on_regions';
	public $pk = ['on_region_tenant_id', 'on_region_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_region_';
	public $columns = [
		'on_region_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_region_id' => ['name' => 'Region #', 'domain' => 'region_id_sequence'],
		'on_region_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_region_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_region_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_region_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_regions_pk' => ['type' => 'pk', 'columns' => ['on_region_tenant_id', 'on_region_id']],
		'on_region_code_un' => ['type' => 'unique', 'columns' => ['on_region_tenant_id', 'on_region_code']],
		'on_region_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_region_tenant_id', 'on_region_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [
		'on_regions_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_region_code', 'on_region_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_region_tenant_id' => 'wg_audit_tenant_id',
			'on_region_id' => 'wg_audit_region_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'on_region_id',
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}