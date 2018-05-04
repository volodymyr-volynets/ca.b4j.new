<?php

namespace Numbers\Users\Workflow\Model;
class Workflows extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflows';
	public $schema;
	public $name = 'ww_workflows';
	public $pk = ['ww_workflow_tenant_id', 'ww_workflow_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_workflow_';
	public $columns = [
		'ww_workflow_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id_sequence'],
		'ww_workflow_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'ww_workflow_name' => ['name' => 'Name', 'domain' => 'name'],
		'ww_workflow_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'ww_workflow_canvas_width' => ['name' => 'Canvas Width', 'domain' => 'dimension'],
		'ww_workflow_canvas_height' => ['name' => 'Canvas Height', 'domain' => 'dimension'],
		// version
		'ww_workflow_versioned' => ['name' => 'Versioned', 'type' => 'boolean'],
		'ww_workflow_version_workflow_id' => ['name' => 'Version Workflow #', 'domain' => 'workflow_id', 'null' => true],
		'ww_workflow_version_code' => ['name' => 'Version Code', 'domain' => 'version_code', 'null' => true],
		'ww_workflow_version_name' => ['name' => 'Version Name', 'domain' => 'name', 'null' => true],
		// inactive
		'ww_workflow_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_workflows_pk' => ['type' => 'pk', 'columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']],
		'ww_workflow_code_un' => ['type' => 'unique', 'columns' => ['ww_workflow_tenant_id', 'ww_workflow_code']],
		'ww_workflow_version_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_workflow_tenant_id', 'ww_workflow_version_workflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflows',
			'foreign_columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']
		],
	];
	public $indexes = [
		'ww_workflows_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ww_workflow_code', 'ww_workflow_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'ww_workflow_tenant_id' => 'wg_audit_tenant_id',
			'ww_workflow_id' => 'wg_audit_workflow_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'ww_workflow_name' => 'name',
		'ww_workflow_version_name' => 'name',
		'ww_workflow_icon' => 'icon_class'
	];
	public $options_active = [
		'ww_workflow_inactive' => 0
	];
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