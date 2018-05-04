<?php

namespace Numbers\Tenants\Tenants\Model;
class Modules extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Modules';
	public $name = 'tm_modules';
	public $pk = ['tm_module_tenant_id', 'tm_module_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_module_';
	public $columns = [
		'tm_module_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_module_id' => ['name' => 'Module #', 'domain' => 'module_id_sequence'],
		'tm_module_module_code' => ['name' => 'Module Code', 'domain' => 'module_code'],
		'tm_module_name' => ['name' => 'Name', 'domain' => 'name'],
		'tm_module_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_modules_pk' => ['type' => 'pk', 'columns' => ['tm_module_tenant_id', 'tm_module_id']],
		'tm_module_module_code_un' => ['type' => 'unique', 'columns' => ['tm_module_tenant_id', 'tm_module_id', 'tm_module_module_code']],
		'tm_module_name_un' => ['type' => 'unique', 'columns' => ['tm_module_tenant_id', 'tm_module_name']],
		'tm_module_tenant_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_module_tenant_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Tenants',
			'foreign_columns' => ['tm_tenant_id']
		],
		'tm_module_module_code_fk' => [
			'type' => 'fk',
			'columns' => ['tm_module_module_code'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Modules',
			'foreign_columns' => ['sm_module_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'tm_module_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}