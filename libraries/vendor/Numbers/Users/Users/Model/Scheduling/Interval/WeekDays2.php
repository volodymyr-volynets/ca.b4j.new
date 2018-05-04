<?php

namespace Numbers\Users\Users\Model\Scheduling\Interval;
class WeekDays2 extends \Object\Data {
	public $column_key = 'um_schedweekday_id';
	public $column_prefix = 'um_schedweekday_';
	public $orderby = [
		'um_schedweekday_id' => SORT_ASC
	];
	public $columns = [
		'um_schedweekday_id' => ['name' => 'Week Day #', 'domain' => 'type_id'],
		'um_schedweekday_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		0 => ['um_schedweekday_name' => 'Sunday'],
		1 => ['um_schedweekday_name' => 'Monday'],
		2 => ['um_schedweekday_name' => 'Tuesday'],
		3 => ['um_schedweekday_name' => 'Wednesday'],
		4 => ['um_schedweekday_name' => 'Thursday'],
		5 => ['um_schedweekday_name' => 'Friday'],
		6 => ['um_schedweekday_name' => 'Saturday']
	];
}