<?php

namespace Numbers\Users\TaskScheduler\Model;
class TaskParameters extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TS';
	public $title = 'T/S Task Parameters';
	public $name = 'ts_task_parameters';
	public $pk = ['ts_tskparam_task_code', 'ts_tskparam_name'];
	public $tenant;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'ts_tskparam_';
	public $columns = [
		'ts_tskparam_task_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'ts_tskparam_name' => ['name' => 'Name', 'domain' => 'name'],
		'ts_tskparam_description' => ['name' => 'Description', 'type' => 'text'],
		'ts_tskparam_default' => ['name' => 'Default', 'type' => 'text', 'null' => true],
		'ts_tskparam_mandatory' => ['name' => 'Mandatory', 'type' => 'boolean']
	];
	public $constraints = [
		'ts_task_parameters_pk' => ['type' => 'pk', 'columns' => ['ts_tskparam_task_code', 'ts_tskparam_name']],
		'ts_tskparam_task_code_fk' => [
			'type' => 'fk',
			'columns' => ['ts_tskparam_task_code'],
			'foreign_model' => '\Numbers\Users\TaskScheduler\Model\Tasks',
			'foreign_columns' => ['ts_task_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'ts_tskparam_description' => 'name',
		'ts_tskparam_mandatory' => 'mandatory'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}