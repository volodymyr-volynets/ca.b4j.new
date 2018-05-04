<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Step;
class Types extends \Object\Data {
	public $column_key = 'on_workstptype_id';
	public $column_prefix = 'on_workstptype_';
	public $orderby = [
		'on_workstptype_id' => SORT_ASC
	];
	public $columns = [
		'on_workstptype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_workstptype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_workstptype_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $options_map = [
		'on_workstptype_name' => 'name',
		'on_workstptype_icon' => 'icon_class',
	];
	public $data = [
		10 => ['on_workstptype_name' => 'Begin', 'on_workstptype_icon' => 'fas fa-hourglass-start'],
		20 => ['on_workstptype_name' => 'Intermediate', 'on_workstptype_icon' => 'fas fa-hourglass-half'],
		30 => ['on_workstptype_name' => 'End', 'on_workstptype_icon' => 'fas fa-hourglass-end']
	];
}