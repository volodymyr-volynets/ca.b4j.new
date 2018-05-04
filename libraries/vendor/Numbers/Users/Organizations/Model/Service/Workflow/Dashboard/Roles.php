<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Dashboard;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Dashboard Rolea';
	public $name = 'on_workflow_dashboard_roles';
	public $pk = ['on_workdashrol_tenant_id', 'on_workdashrol_dashboard_id', 'on_workdashrol_role_id'];
	public $tenant = true;
	public $orderby = [
		'on_workdashrol_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_workdashrol_';
	public $columns = [
		'on_workdashrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workdashrol_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_workdashrol_dashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id'],
		'on_workdashrol_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'on_workdashrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_dashboard_roles_pk' => ['type' => 'pk', 'columns' => ['on_workdashrol_tenant_id', 'on_workdashrol_dashboard_id', 'on_workdashrol_role_id']],
		'on_workdashrol_dashboard_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workdashrol_tenant_id', 'on_workdashrol_dashboard_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboards',
			'foreign_columns' => ['on_workdashboard_tenant_id', 'on_workdashboard_id']
		],
		'on_workdashrol_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workdashrol_tenant_id', 'on_workdashrol_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
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