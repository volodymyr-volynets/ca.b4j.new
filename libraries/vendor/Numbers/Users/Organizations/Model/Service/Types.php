<?php

namespace Numbers\Users\Organizations\Model\Service;
class Types extends \Object\Data {
	public $column_key = 'on_servtype_id';
	public $column_prefix = 'on_servtype_';
	public $columns = [
		'on_servtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_servtype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_servtype_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $options_map = [
		'on_servtype_name' => 'name',
		'on_servtype_icon' => 'icon_class',
	];
	public $data = [
		10 => ['on_servtype_name' => 'B2B', 'on_servtype_icon' => 'far fa-building'],
		20 => ['on_servtype_name' => 'B2C', 'on_servtype_icon' => 'fas fa-users'],
	];
}