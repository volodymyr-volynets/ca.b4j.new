<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow;
class Fields extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Workflow Fields';
	public $schema;
	public $name = 'on_workflow_fields';
	public $pk = ['on_workfield_tenant_id', 'on_workfield_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workfield_';
	public $columns = [
		'on_workfield_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workfield_id' => ['name' => 'Field #', 'domain' => 'field_id_sequence'],
		'on_workfield_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_workfield_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_workfield_method' => ['name' => 'Method', 'domain' => 'code', 'options_model' => '\Numbers\Tenants\Widgets\Attributes\Model\Methods'],
		'on_workfield_model_id' => ['name' => 'Model', 'domain' => 'group_id', 'null' => true],
		'on_workfield_domain' => ['name' => 'Domain', 'domain' => 'code', 'null' => true],
		'on_workfield_type' => ['name' => 'Type', 'domain' => 'code'],
		'on_workfield_php_type' => ['name' => 'PHP Type', 'domain' => 'code'],
		'on_workfield_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_workfield_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_fields_pk' => ['type' => 'pk', 'columns' => ['on_workfield_tenant_id', 'on_workfield_id']],
		'on_workfield_code_un' => ['type' => 'unique', 'columns' => ['on_workfield_tenant_id', 'on_workfield_code']],
	];
	public $indexes = [
		'on_workflow_fields_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_workfield_name', 'on_workfield_code']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'on_workfield_name' => 'name'
	];
	public $options_active = [
		'on_workfield_inactive' => 0
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