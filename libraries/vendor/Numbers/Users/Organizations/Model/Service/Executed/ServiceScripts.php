<?php

namespace Numbers\Users\Organizations\Model\Service\Executed;
class ServiceScripts extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Executed Service Scripts';
	public $schema;
	public $name = 'on_executed_service_scripts';
	public $pk = ['on_execsscript_tenant_id', 'on_execsscript_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_execsscript_';
	public $columns = [
		'on_execsscript_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_execsscript_id' => ['name' => 'Executed #', 'domain' => 'executed_service_script_id_sequence'],
		'on_execsscript_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id'],
		'on_execsscript_service_script_name' => ['name' => 'Service Script Name', 'domain' => 'name'],
		'on_execsscript_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_execsscript_location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'null' => true],
		'on_execsscript_region_id' => ['name' => 'Region #', 'domain' => 'region_id', 'null' => true],
		'on_execsscript_channel_code' => ['name' => 'Channel Code', 'domain' => 'group_code', 'null' => true],
		// linked columns
		'on_execsscript_linked_type_code' => ['name' => 'Linked Type', 'domain' => 'group_code', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Linked\Types'],
		'on_execsscript_linked_module_id' => ['name' => 'Linked Module #', 'domain' => 'module_id'],
		'on_execsscript_linked_id' => ['name' => 'Linked #', 'domain' => 'big_id'], // we do not have fk for this field
		// values
		'on_execsscript_values' => ['name' => 'Values', 'type' => 'json'],
		// inactive
		'on_execsscript_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_executed_service_scripts_pk' => ['type' => 'pk', 'columns' => ['on_execsscript_tenant_id', 'on_execsscript_id']],
		'on_execsscript_service_script_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execsscript_tenant_id', 'on_execsscript_service_script_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts',
			'foreign_columns' => ['on_servscript_tenant_id', 'on_servscript_id']
		],
		'on_execsscript_linked_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execsscript_tenant_id', 'on_execsscript_linked_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}