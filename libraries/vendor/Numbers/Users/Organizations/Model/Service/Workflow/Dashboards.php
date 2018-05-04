<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow;
class Dashboards extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Dashboards';
	public $schema;
	public $name = 'on_workflow_dashboards';
	public $pk = ['on_workdashboard_tenant_id', 'on_workdashboard_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workdashboard_';
	public $columns = [
		'on_workdashboard_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workdashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id_sequence'],
		'on_workdashboard_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_workdashboard_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_workdashboard_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_workdashboard_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_dashboards_pk' => ['type' => 'pk', 'columns' => ['on_workdashboard_tenant_id', 'on_workdashboard_id']],
		'on_workdashboard_code_un' => ['type' => 'unique', 'columns' => ['on_workdashboard_tenant_id', 'on_workdashboard_code']],
	];
	public $indexes = [
		'on_workflow_dashboards_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_workdashboard_name', 'on_workdashboard_code']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'on_workdashboard_name' => 'name',
		'on_workdashboard_icon' => 'icon_class'
	];
	public $options_active = [
		'on_workdashboard_inactive' => 0
	];
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