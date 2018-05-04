<?php

namespace Numbers\Users\TimeTracking\Model\Project;
class Types extends \Object\Data {
	public $column_key = 'tt_projtype_id';
	public $column_prefix = 'tt_projtype_';
	public $orderby = [
		'tt_projtype_id' => SORT_ASC
	];
	public $columns = [
		'tt_projtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'tt_projtype_name' => ['name' => 'Name', 'type' => 'text'],
		'tt_projtype_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $data = [
		10 => ['tt_projtype_name' => 'Project', 'tt_projtype_icon' => 'fas fa-cogs'],
		20 => ['tt_projtype_name' => 'Task', 'tt_projtype_icon' => 'fas fa-cog'],
	];
	public $options_map = [
		'tt_projtype_name' => 'name',
		'tt_projtype_icon' => 'icon_class'
	];
}