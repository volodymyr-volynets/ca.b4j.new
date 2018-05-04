<?php

namespace Numbers\Users\Users\Model\Scheduling\Appointment;
class SubTypes extends \Object\Data {
	public $column_key = 'um_schedapptype_id';
	public $column_prefix = 'um_schedapptype_';
	public $orderby = [
		'um_schedapptype_id' => SORT_ASC
	];
	public $columns = [
		'um_schedapptype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_schedapptype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_schedapptype_name' => 'One Appointment'],
		20 => ['um_schedapptype_name' => 'Multiple Appointments'],
	];
}