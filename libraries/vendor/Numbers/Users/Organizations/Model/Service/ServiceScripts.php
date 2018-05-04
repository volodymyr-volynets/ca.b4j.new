<?php

namespace Numbers\Users\Organizations\Model\Service;
class ServiceScripts extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Scripts';
	public $schema;
	public $name = 'on_service_scripts';
	public $pk = ['on_servscript_tenant_id', 'on_servscript_id'];
	public $tenant = true;
	public $orderby = [
		'on_servscript_id' => SORT_DESC
	];
	public $limit;
	public $column_prefix = 'on_servscript_';
	public $columns = [
		'on_servscript_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servscript_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id_sequence'],
		'on_servscript_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'on_servscript_name' => ['name' => 'Name', 'domain' => 'name'],
		// version
		'on_servscript_versioned' => ['name' => 'Versioned', 'type' => 'boolean'],
		'on_servscript_version_service_script_id' => ['name' => 'Version Service Script #', 'domain' => 'service_script_id', 'null' => true],
		'on_servscript_version_code' => ['name' => 'Version Code', 'domain' => 'version_code', 'null' => true],
		'on_servscript_version_name' => ['name' => 'Version Name', 'domain' => 'name', 'null' => true],
		// inactive
		'on_servscript_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_scripts_pk' => ['type' => 'pk', 'columns' => ['on_servscript_tenant_id', 'on_servscript_id']],
		'on_servscript_code_un' => ['type' => 'unique', 'columns' => ['on_servscript_tenant_id', 'on_servscript_code']],
		'on_servscript_version_service_script_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servscript_tenant_id', 'on_servscript_version_service_script_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts',
			'foreign_columns' => ['on_servscript_tenant_id', 'on_servscript_id']
		],
	];
	public $indexes = [
		'on_service_scripts_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_servscript_code', 'on_servscript_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_servscript_tenant_id' => 'wg_audit_tenant_id',
			'on_servscript_id' => 'wg_audit_service_script_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_servscript_name' => 'name',
		'on_servscript_version_name' => 'name',
		'on_servscript_inactive' => 'inactive'
	];
	public $options_active = [
		'on_servscript_inactive' => 0
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