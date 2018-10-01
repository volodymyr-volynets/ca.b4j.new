<?php

namespace Model\Register\Counselor;
class Statuses extends \Object\Data {
	public $column_key = 'no_data_conreg_statuses_id';
	public $column_prefix = 'no_data_conreg_statuses_';
	public $columns = [
		'no_data_conreg_statuses_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_conreg_statuses_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_conreg_statuses_name' => 'name'
	];
	public $orderby = [
		'no_data_conreg_statuses_id' => SORT_ASC
	];
	public $data = [
		10 => ['no_data_conreg_statuses_name' => 'New'],
		250 => ['no_data_conreg_statuses_name' => 'Confirmed'],
		300 => ['no_data_conreg_statuses_name' => 'Waiting List']
	];
}