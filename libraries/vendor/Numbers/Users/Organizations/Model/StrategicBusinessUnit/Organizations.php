<?php

namespace Numbers\Users\Organizations\Model\StrategicBusinessUnit;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Strategic Business Unit Organizations';
	public $name = 'on_sbu_organizations';
	public $pk = ['on_sborg_tenant_id', 'on_sborg_sbu_id', 'on_sborg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'on_sborg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_sborg_';
	public $columns = [
		'on_sborg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_sborg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_sborg_sbu_id' => ['name' => 'SBU #', 'domain' => 'sbu_id'],
		'on_sborg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_sborg_primary' => ['name' => 'Primary', 'type' => 'boolean'],
		'on_sborg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_sbu_organizations_pk' => ['type' => 'pk', 'columns' => ['on_sborg_tenant_id', 'on_sborg_sbu_id', 'on_sborg_organization_id']],
		'on_sborg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_sborg_tenant_id', 'on_sborg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_sborg_sbu_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_sborg_tenant_id', 'on_sborg_sbu_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\StrategicBusinessUnits',
			'foreign_columns' => ['on_sbu_tenant_id', 'on_sbu_id']
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