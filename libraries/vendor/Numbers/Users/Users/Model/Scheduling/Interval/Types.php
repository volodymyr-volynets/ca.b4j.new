<?php

namespace Numbers\Users\Users\Model\Scheduling\Interval;
class Types extends \Object\Data {
	public $column_key = 'um_schedinttype_id';
	public $column_prefix = 'um_schedinttype_';
	public $orderby = [
		'um_schedinttype_id' => SORT_ASC
	];
	public $columns = [
		'um_schedinttype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_schedinttype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		1000 => ['um_schedinttype_name' => 'Working Hours'],
		2000 => ['um_schedinttype_name' => 'Time Tracking'],
		3000 => ['um_schedinttype_name' => 'Appointment (Availability)'],
		3100 => ['um_schedinttype_name' => 'Appointment (Booked)'],
		4000 => ['um_schedinttype_name' => 'Not Available'], // sick days, other reasones
		5000 => ['um_schedinttype_name' => 'Vacation'],
	];
}