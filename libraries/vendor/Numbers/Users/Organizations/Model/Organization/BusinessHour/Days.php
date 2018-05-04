<?php

namespace Numbers\Users\Organizations\Model\Organization\BusinessHour;
class Days extends \Object\Data {
	public $column_key = 'on_orgbissday_id';
	public $column_prefix = 'on_orgbissday_';
	public $orderby = [
		'on_orgbissday_id' => SORT_ASC
	];
	public $columns = [
		'on_orgbissday_id' => ['name' => 'Type #', 'domain' => 'day_id'],
		'on_orgbissday_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'on_orgbissday_name' => 'name',
	];
	public $data = [
		1 => ['on_orgbissday_name' => 'Monday'],
		2 => ['on_orgbissday_name' => 'Tuesday'],
		3 => ['on_orgbissday_name' => 'Wednesday'],
		4 => ['on_orgbissday_name' => 'Thursday'],
		5 => ['on_orgbissday_name' => 'Friday'],
		6 => ['on_orgbissday_name' => 'Saturday'],
		7 => ['on_orgbissday_name' => 'Sunday'],
	];
}