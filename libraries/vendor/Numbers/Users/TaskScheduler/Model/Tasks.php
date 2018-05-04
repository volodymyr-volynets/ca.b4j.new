<?php

namespace Numbers\Users\TaskScheduler\Model;
class Tasks extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TS';
	public $title = 'T/S Tasks';
	public $name = 'ts_tasks';
	public $pk = ['ts_task_code'];
	public $tenant;
	public $orderby;
	public $limit;
	public $column_prefix = 'ts_task_';
	public $columns = [
		'ts_task_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'ts_task_name' => ['name' => 'Name', 'domain' => 'name'],
		'ts_task_model' => ['name' => 'Model', 'domain' => 'code'],
		'ts_task_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ts_tasks_pk' => ['type' => 'pk', 'columns' => ['ts_task_code']]
	];
	public $indexes = [
		'ts_tasks_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ts_task_code', 'ts_task_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'ts_task_name' => 'name'
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