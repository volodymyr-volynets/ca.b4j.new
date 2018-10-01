<?php

namespace Model\Counselor;
class Responsibilities extends \Object\Data {
	public $column_key = 'no_data_responsibility_id';
	public $column_prefix = 'no_data_responsibility_';
	public $columns = [
		'no_data_responsibility_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_responsibility_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_responsibility_name' => 'name'
	];
	public $orderby = [
		'no_data_responsibility_id' => SORT_ASC
	];
	public $data = [
		1 => ['no_data_responsibility_name' => '1'],
		2 => ['no_data_responsibility_name' => '2'],
		3 => ['no_data_responsibility_name' => '3'],
		4 => ['no_data_responsibility_name' => '4'],
		5 => ['no_data_responsibility_name' => '5'],
		6 => ['no_data_responsibility_name' => '6'],
		7 => ['no_data_responsibility_name' => '7'],
	];
}