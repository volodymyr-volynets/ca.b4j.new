<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow;
class Types extends \Object\Data {
	public $column_key = 'on_worktype_id';
	public $column_prefix = 'on_worktype_';
	public $orderby = [
		'on_worktype_id' => SORT_ASC
	];
	public $columns = [
		'on_worktype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_worktype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_worktype_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $options_map = [
		'on_worktype_name' => 'name',
		'on_worktype_icon' => 'icon_class',
	];
	public $data = [
		10 => ['on_worktype_name' => 'Workflow', 'on_worktype_icon' => 'fas fa-tree'],
		// todo
		//20 => ['on_worktype_name' => 'Subflow', 'on_worktype_icon' => 'fab fa-pagelines'],
	];
}