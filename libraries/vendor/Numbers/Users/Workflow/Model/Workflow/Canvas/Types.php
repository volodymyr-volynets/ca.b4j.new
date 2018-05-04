<?php

namespace Numbers\Users\Workflow\Model\Workflow\Canvas;
class Types extends \Object\Data {
	public $column_key = 'ww_wrkcnvstype_id';
	public $column_prefix = 'ww_wrkcnvstype_';
	public $orderby;
	public $columns = [
		'ww_wrkcnvstype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'ww_wrkcnvstype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		1000 => ['ww_wrkcnvstype_name' => 'Rectangle'],
		1100 => ['ww_wrkcnvstype_name' => 'Rhombus'],
		2000 => ['ww_wrkcnvstype_name' => 'Line'],
		3000 => ['ww_wrkcnvstype_name' => 'Circle'],
		4000 => ['ww_wrkcnvstype_name' => 'Text'],
	];
}