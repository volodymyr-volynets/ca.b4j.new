<?php

namespace Model;
class Register extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'B4';
	public $title = 'B/4 Register';
	public $schema;
	public $name = 'b4_register';
	public $pk = ['b4_register_tenant_id', 'b4_register_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'b4_register_';
	public $columns = [
		'b4_register_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'b4_register_id' => ['name' => 'Register #', 'domain' => 'big_id_sequence'],
		'b4_register_step_id' => ['name' => 'Step', 'domain' => 'type_id', 'default' => 1],
		'b4_register_step1' => ['name' => 'Step 1 Data', 'type' => 'json', 'null' => true],
		'b4_register_step2' => ['name' => 'Step 2 Data', 'type' => 'json', 'null' => true],
		'b4_register_step3' => ['name' => 'Step 3 Data', 'type' => 'json', 'null' => true],
		'b4_register_step4' => ['name' => 'Step 4 Data', 'type' => 'json', 'null' => true],
		'b4_register_step5' => ['name' => 'Step 5 Data', 'type' => 'json', 'null' => true],
		'b4_register_step6' => ['name' => 'Step 6 Data', 'type' => 'json', 'null' => true],
		'b4_register_step7' => ['name' => 'Step 7 Data', 'type' => 'json', 'null' => true],
		'b4_register_step8' => ['name' => 'Step 8 Data', 'type' => 'json', 'null' => true],
		'b4_register_step9' => ['name' => 'Step 9 Data', 'type' => 'json', 'null' => true],
		'b4_register_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'b4_register_pk' => ['type' => 'pk', 'columns' => ['b4_register_tenant_id', 'b4_register_id']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map;
	public $options_active;
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