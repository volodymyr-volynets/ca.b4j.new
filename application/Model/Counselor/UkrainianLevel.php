<?php

namespace Model\Counselor;
class UkrainianLevel extends \Object\Data {
	public $column_key = 'no_data_ulevel_statuses_id';
	public $column_prefix = 'no_data_ulevel_statuses_';
	public $columns = [
		'no_data_ulevel_statuses_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_ulevel_statuses_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_ulevel_statuses_name' => 'name'
	];
	public $orderby = [
		'no_data_ulevel_statuses_id' => SORT_ASC
	];
	public $data = [
		10 => ['no_data_ulevel_statuses_name' => 'None'],
		20 => ['no_data_ulevel_statuses_name' => 'Minimal'],
		30 => ['no_data_ulevel_statuses_name' => 'Medium'],
		40 => ['no_data_ulevel_statuses_name' => 'Strong']
	];
}