<?php

namespace Model\Registration;
class Genders extends \Object\Data {
	public $column_key = 'no_data_reg_genders_id';
	public $column_prefix = 'no_data_reg_genders_';
	public $columns = [
		'no_data_reg_genders_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_reg_genders_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_reg_genders_name' => 'name'
	];
	public $orderby = [
		'no_data_reg_genders_id' => SORT_ASC
	];
	public $data = [
		10 => ['no_data_reg_genders_name' => 'Male'],
		20 => ['no_data_reg_genders_name' => 'Female'],
		//30 => ['no_data_reg_genders_name' => 'Other'],
	];
}