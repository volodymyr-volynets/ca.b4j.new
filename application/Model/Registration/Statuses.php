<?php

namespace Model\Registration;
class Statuses extends \Object\Data {
	public $column_key = 'no_data_reg_statuses_id';
	public $column_prefix = 'no_data_reg_statuses_';
	public $columns = [
		'no_data_reg_statuses_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_reg_statuses_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_reg_statuses_name' => 'name'
	];
	public $orderby = [
		'no_data_reg_statuses_id' => SORT_ASC
	];
	public $data = [
		10 => ['no_data_reg_statuses_name' => 'New'],
		20 => ['no_data_reg_statuses_name' => 'Confirmed'],
		30 => ['no_data_reg_statuses_name' => 'Need Medical'],
		40 => ['no_data_reg_statuses_name' => 'Medical Provided'],
		250 => ['no_data_reg_statuses_name' => 'Complete'],
	];
}