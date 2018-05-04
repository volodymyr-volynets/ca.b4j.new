<?php

namespace Numbers\Users\Organizations\Model\Division;
class Types extends \Object\Data {
	public $column_key = 'on_divtype_id';
	public $column_prefix = 'on_divtype_';
	public $orderby = ['on_divtype_id' => SORT_ASC];
	public $columns = [
		'on_divtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_divtype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['on_divtype_name' => 'Division'],
		20 => ['on_divtype_name' => 'Subdivision'],
	];
}