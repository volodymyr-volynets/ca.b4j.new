<?php

namespace Numbers\Users\TimeTracking\Model;
class Projects extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TT';
	public $title = 'T/T Projects';
	public $schema;
	public $name = 'tt_projects';
	public $pk = ['tt_project_tenant_id', 'tt_project_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tt_project_';
	public $columns = [
		'tt_project_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tt_project_id' => ['name' => 'Project #', 'domain' => 'project_id_sequence'],
		'tt_project_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'tt_project_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\TimeTracking\Model\Project\Types'],
		'tt_project_parent_project_id' => ['name' => 'Parent Project #', 'domain' => 'project_id', 'null' => true],
		'tt_project_name' => ['name' => 'Name', 'domain' => 'name'],
		'tt_project_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
		'tt_project_team_id' => ['name' => 'Team #', 'domain' => 'team_id', 'null' => true],
		'tt_project_user_id' => ['name' => 'User #', 'domain' => 'user_id', 'null' => true],
		'tt_project_date_start' => ['name' => 'Date Start', 'type' => 'date', 'null' => true],
		'tt_project_date_finish' => ['name' => 'Date Finish', 'type' => 'date', 'null' => true],
		'tt_project_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tt_projects_pk' => ['type' => 'pk', 'columns' => ['tt_project_tenant_id', 'tt_project_id']],
		'tt_project_code_un' => ['type' => 'unique', 'columns' => ['tt_project_tenant_id', 'tt_project_code', 'tt_project_user_id']],
		'tt_project_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['tt_project_tenant_id', 'tt_project_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		]
	];
	public $indexes = [
		'tt_projects_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['tt_project_name', 'tt_project_description']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'tt_project_tenant_id' => 'wg_audit_tenant_id',
			'tt_project_id' => 'wg_audit_project_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'tt_project_name' => 'name'
	];
	public $options_active = [
		'tt_project_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}