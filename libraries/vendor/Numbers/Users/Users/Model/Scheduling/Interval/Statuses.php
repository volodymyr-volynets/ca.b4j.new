<?php

namespace Numbers\Users\Users\Model\Scheduling\Interval;
class Statuses extends \Object\Data {
	public $column_key = 'um_schedintstatus_id';
	public $column_prefix = 'um_schedintstatus_';
	public $orderby = [
		'um_schedintstatus_id' => SORT_ASC
	];
	public $columns = [
		'um_schedintstatus_id' => ['name' => 'Status #', 'domain' => 'type_id'],
		'um_schedintstatus_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_schedintstatus_name' => 'New'], // newly created
		20 => ['um_schedintstatus_name' => 'Confirmed'], // confirmed by owner
		30 => ['um_schedintstatus_name' => 'Approved'], // approved by manager
		40 => ['um_schedintstatus_name' => 'Canceled'], // canceled
	];
}