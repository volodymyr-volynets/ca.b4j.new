<?php

namespace Numbers\Users\Organizations\Model\Service;
class Workflows extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflows';
	public $schema;
	public $name = 'on_workflows';
	public $pk = ['on_workflow_tenant_id', 'on_workflow_id'];
	public $tenant = true;
	public $orderby = [
		'on_workflow_id' => SORT_DESC
	];
	public $limit;
	public $column_prefix = 'on_workflow_';
	public $columns = [
		'on_workflow_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id_sequence'],
		'on_workflow_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'on_workflow_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_workflow_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Types'],
		'on_workflow_parent_workflow_id' => ['name' => 'Parent Workflow #', 'domain' => 'workflow_id', 'null' => true],
		'on_workflow_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_workflow_canvas_width' => ['name' => 'Canvas Width', 'domain' => 'dimension'],
		'on_workflow_canvas_height' => ['name' => 'Canvas Height', 'domain' => 'dimension'],
		// version
		'on_workflow_versioned' => ['name' => 'Versioned', 'type' => 'boolean'],
		'on_workflow_version_workflow_id' => ['name' => 'Version Workflow #', 'domain' => 'workflow_id', 'null' => true],
		'on_workflow_version_code' => ['name' => 'Version Code', 'domain' => 'version_code', 'null' => true],
		'on_workflow_version_name' => ['name' => 'Version Name', 'domain' => 'name', 'null' => true],
		// inactive
		'on_workflow_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflows_pk' => ['type' => 'pk', 'columns' => ['on_workflow_tenant_id', 'on_workflow_id']],
		'on_workflow_code_un' => ['type' => 'unique', 'columns' => ['on_workflow_tenant_id', 'on_workflow_code']],
		'on_workflow_version_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workflow_tenant_id', 'on_workflow_version_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		],
		'on_workflow_parent_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workflow_tenant_id', 'on_workflow_parent_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		]
	];
	public $indexes = [
		'on_workflows_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_workflow_code', 'on_workflow_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_workflow_tenant_id' => 'wg_audit_tenant_id',
			'on_workflow_id' => 'wg_audit_workflow_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_workflow_name' => 'name',
		'on_workflow_version_name' => 'name',
		'on_workflow_icon' => 'icon_class',
		'on_workflow_inactive' => 'inactive'
	];
	public $options_active = [
		'on_workflow_inactive' => 0
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