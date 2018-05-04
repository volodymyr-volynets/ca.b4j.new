<?php

namespace Numbers\Users\TaskScheduler\Model\Executed;
class Statuses extends \Object\Data {
	public $column_key = 'ts_executedjobstatus_id';
	public $column_prefix = 'ts_executedjobstatus_';
	public $orderby;
	public $columns = [
		'ts_executedjobstatus_id' => ['name' => '#', 'domain' => 'type_id'],
		'ts_executedjobstatus_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['ts_executedjobstatus_name' => 'New'],
		20 => ['ts_executedjobstatus_name' => 'In Progress'],
		30 => ['ts_executedjobstatus_name' => 'Completed']
	];
}