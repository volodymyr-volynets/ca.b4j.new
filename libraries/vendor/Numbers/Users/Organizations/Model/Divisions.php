<?php

namespace Numbers\Users\Organizations\Model;
class Divisions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Divisions';
	public $schema;
	public $name = 'on_divisions';
	public $pk = ['on_division_tenant_id', 'on_division_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_division_';
	public $columns = [
		'on_division_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_division_id' => ['name' => 'Division #', 'domain' => 'division_id_sequence'],
		'on_division_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_division_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Division\Types'],
		'on_division_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_division_parent_organization_id' => ['name' => 'Parent Organization #', 'domain' => 'organization_id', 'null' => true],
		'on_division_parent_division_id' => ['name' => 'Parent Division #', 'domain' => 'division_id', 'null' => true],
		'on_division_region_id' => ['name' => 'Region #', 'domain' => 'country_number', 'null' => true],
		'on_division_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_divisions_pk' => ['type' => 'pk', 'columns' => ['on_division_tenant_id', 'on_division_id']],
		'on_division_code_un' => ['type' => 'unique', 'columns' => ['on_division_tenant_id', 'on_division_code']],
		'on_division_parent_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_division_tenant_id', 'on_division_parent_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_division_parent_division_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_division_tenant_id', 'on_division_parent_division_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Divisions',
			'foreign_columns' => ['on_division_tenant_id', 'on_division_id']
		],
		'on_division_region_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_division_tenant_id', 'on_division_region_id'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Regions',
			'foreign_columns' => ['cm_region_tenant_id', 'cm_region_id']
		]
	];
	public $indexes = [
		'on_divisions_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_division_code', 'on_division_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_division_tenant_id' => 'wg_audit_tenant_id',
			'on_division_id' => 'wg_audit_trademark_id'
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}