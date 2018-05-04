<?php

namespace Numbers\Users\Organizations\Model\Division;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Division Organizations';
	public $name = 'on_division_organizations';
	public $pk = ['on_diviorg_tenant_id', 'on_diviorg_division_id', 'on_diviorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'on_diviorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_diviorg_';
	public $columns = [
		'on_diviorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_diviorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_diviorg_division_id' => ['name' => 'Brand #', 'domain' => 'division_id'],
		'on_diviorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_diviorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_division_organizations_pk' => ['type' => 'pk', 'columns' => ['on_diviorg_tenant_id', 'on_diviorg_division_id', 'on_diviorg_organization_id']],
		'on_diviorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_diviorg_tenant_id', 'on_diviorg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_diviorg_division_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_diviorg_tenant_id', 'on_diviorg_division_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Divisions',
			'foreign_columns' => ['on_division_tenant_id', 'on_division_id']
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