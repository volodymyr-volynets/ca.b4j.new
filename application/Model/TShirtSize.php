<?php

namespace Model;
class TShirtSize extends \Object\Data {
	public $column_key = 'no_data_tshirt_size_id';
	public $column_prefix = 'no_data_tshirt_size_';
	public $columns = [
		'no_data_tshirt_size_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_tshirt_size_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_tshirt_size_name' => 'name'
	];
	public $orderby = [
		'no_data_tshirt_size_id' => SORT_ASC
	];
	public $data = [
		10 => ['no_data_tshirt_size_name' => 'Small'],
		20 => ['no_data_tshirt_size_name' => 'Medium'],
		30 => ['no_data_tshirt_size_name' => 'Large'],
		40 => ['no_data_tshirt_size_name' => 'X-Large'],
		50 => ['no_data_tshirt_size_name' => 'XX-Large'],
	];
}