<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Dashboard;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Dashboard Organizations';
	public $name = 'on_workflow_dashboard_organizations';
	public $pk = ['on_workdashorg_tenant_id', 'on_workdashorg_dashboard_id', 'on_workdashorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'on_workdashorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workdashorg_';
	public $columns = [
		'on_workdashorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workdashorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_workdashorg_dashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id'],
		'on_workdashorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_workdashorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_dashboard_organizations_pk' => ['type' => 'pk', 'columns' => ['on_workdashorg_tenant_id', 'on_workdashorg_dashboard_id', 'on_workdashorg_organization_id']],
		'on_workdashorg_dashboard_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workdashorg_tenant_id', 'on_workdashorg_dashboard_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboards',
			'foreign_columns' => ['on_workdashboard_tenant_id', 'on_workdashboard_id']
		],
		'on_workdashorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workdashorg_tenant_id', 'on_workdashorg_organization_id'],
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