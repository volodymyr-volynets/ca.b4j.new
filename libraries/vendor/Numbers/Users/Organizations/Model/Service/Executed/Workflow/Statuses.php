<?php

namespace Numbers\Users\Organizations\Model\Service\Executed\Workflow;
class Statuses extends \Object\Data {
	public $column_key = 'on_execwflwsts_id';
	public $column_prefix = 'on_execwflwsts_';
	public $orderby;
	public $columns = [
		'on_execwflwsts_id' => ['name' => 'Status #', 'domain' => 'type_id'],
		'on_execwflwsts_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['on_execwflwsts_name' => 'New'],
		20 => ['on_execwflwsts_name' => 'In Progress'],
		30 => ['on_execwflwsts_name' => 'Completed']
	];
}