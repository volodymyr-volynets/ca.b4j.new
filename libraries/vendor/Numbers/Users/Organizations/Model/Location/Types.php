<?php

namespace Numbers\Users\Organizations\Model\Location;
class Types extends \Object\Data {
	public $column_key = 'on_loctype_id';
	public $column_prefix = 'on_loctype_';
	public $columns = [
		'on_loctype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_loctype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['on_loctype_name' => 'Warehouse'],
		20 => ['on_loctype_name' => 'Distribution Center'],
		30 => ['on_loctype_name' => 'Store'],
	];
}