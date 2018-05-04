<?php

namespace Numbers\Users\Workflow\Model\Assignment;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Assignment Organizations';
	public $name = 'ww_assignment_organizations';
	public $pk = ['ww_assignorg_tenant_id', 'ww_assignorg_assignment_id', 'ww_assignorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'ww_assignorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ww_assignorg_';
	public $columns = [
		'ww_assignorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_assignorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'ww_assignorg_assignment_id' => ['name' => 'Assignment #', 'domain' => 'service_id'],
		'ww_assignorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'ww_assignorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_assignment_organizations_pk' => ['type' => 'pk', 'columns' => ['ww_assignorg_tenant_id', 'ww_assignorg_assignment_id', 'ww_assignorg_organization_id']],
		'ww_assignorg_assignment_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_assignorg_tenant_id', 'ww_assignorg_assignment_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Assignments',
			'foreign_columns' => ['ww_assignment_tenant_id', 'ww_assignment_id']
		],
		'ww_assignorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_assignorg_tenant_id', 'ww_assignorg_organization_id'],
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