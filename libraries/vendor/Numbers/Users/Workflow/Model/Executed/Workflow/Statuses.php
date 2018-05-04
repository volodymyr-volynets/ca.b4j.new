<?php

namespace Numbers\Users\Workflow\Model\Executed\Workflow;
class Statuses extends \Object\Data {
	public $column_key = 'ww_execwflwsts_id';
	public $column_prefix = 'ww_execwflwsts_';
	public $orderby;
	public $columns = [
		'ww_execwflwsts_id' => ['name' => 'Status #', 'domain' => 'type_id'],
		'ww_execwflwsts_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['ww_execwflwsts_name' => 'New'],
		20 => ['ww_execwflwsts_name' => 'In Progress'],
		30 => ['ww_execwflwsts_name' => 'Completed']
	];
}