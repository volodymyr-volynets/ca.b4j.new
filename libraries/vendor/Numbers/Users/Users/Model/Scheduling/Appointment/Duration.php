<?php

namespace Numbers\Users\Users\Model\Scheduling\Appointment;
class Duration extends \Object\Data {
	public $column_key = 'um_schedappdur_id';
	public $column_prefix = 'um_schedappdur_';
	public $orderby = [
		'um_schedappdur_id' => SORT_ASC
	];
	public $columns = [
		'um_schedappdur_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_schedappdur_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		 15 => ['um_schedappdur_name' => '00:15'],
		 30 => ['um_schedappdur_name' => '00:30'],
		 45 => ['um_schedappdur_name' => '00:45'],
		 60 => ['um_schedappdur_name' => '01:00'],
		 75 => ['um_schedappdur_name' => '01:15'],
		 90 => ['um_schedappdur_name' => '01:30'],
		105 => ['um_schedappdur_name' => '01:45'],
		120 => ['um_schedappdur_name' => '02:00'],
		135 => ['um_schedappdur_name' => '02:15'],
		150 => ['um_schedappdur_name' => '02:30'],
		165 => ['um_schedappdur_name' => '02:45'],
		180 => ['um_schedappdur_name' => '03:00'],
		195 => ['um_schedappdur_name' => '03:15'],
		210 => ['um_schedappdur_name' => '03:30'],
		225 => ['um_schedappdur_name' => '03:45'],
		240 => ['um_schedappdur_name' => '04:00'],
		255 => ['um_schedappdur_name' => '04:15'],
		270 => ['um_schedappdur_name' => '04:30'],
		285 => ['um_schedappdur_name' => '04:45'],
		300 => ['um_schedappdur_name' => '05:00'],
		315 => ['um_schedappdur_name' => '05:15'],
		330 => ['um_schedappdur_name' => '05:30'],
		345 => ['um_schedappdur_name' => '05:45'],
		360 => ['um_schedappdur_name' => '06:00'],
		375 => ['um_schedappdur_name' => '06:15'],
		390 => ['um_schedappdur_name' => '06:30'],
		405 => ['um_schedappdur_name' => '06:45'],
		420 => ['um_schedappdur_name' => '07:00'],
		435 => ['um_schedappdur_name' => '07:15'],
		450 => ['um_schedappdur_name' => '07:30'],
		465 => ['um_schedappdur_name' => '07:45'],
		480 => ['um_schedappdur_name' => '08:00'],
	];
}