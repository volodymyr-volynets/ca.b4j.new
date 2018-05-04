<?php

namespace Numbers\Users\Organizations\Model\Organization;
class Children extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Organization Children';
	public $name = 'on_organization_children';
	public $pk = ['on_orgchl_tenant_id', 'on_orgchl_parent_organization_id', 'on_orgchl_child_organization_id'];
	public $tenant = true;
	public $orderby = [
		'on_orgchl_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_orgchl_';
	public $columns = [
		'on_orgchl_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_orgchl_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_orgchl_parent_organization_id' => ['name' => 'Parent Organization #', 'domain' => 'organization_id'],
		'on_orgchl_child_organization_id' => ['name' => 'Child Role #', 'domain' => 'organization_id'],
		'on_orgchl_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_organization_children_pk' => ['type' => 'pk', 'columns' => ['on_orgchl_tenant_id', 'on_orgchl_parent_organization_id', 'on_orgchl_child_organization_id']],
		'on_orgchl_parent_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgchl_tenant_id', 'on_orgchl_parent_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_orgchl_child_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgchl_tenant_id', 'on_orgchl_child_organization_id'],
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