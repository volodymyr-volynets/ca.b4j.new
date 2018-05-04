<?php

namespace Numbers\Users\Workflow\Model\Workflow\Step;
class Types extends \Object\Data {
	public $column_key = 'ww_wrkstptype_id';
	public $column_prefix = 'ww_wrkstptype_';
	public $orderby = [
		'ww_wrkstptype_id' => SORT_ASC
	];
	public $columns = [
		'ww_wrkstptype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'ww_wrkstptype_name' => ['name' => 'Name', 'type' => 'text'],
		'ww_wrkstptype_icon' => ['name' => 'Icon', 'type' => 'text'],
	];
	public $options_map = [
		'ww_wrkstptype_name' => 'name',
		'ww_wrkstptype_icon' => 'icon_class',
	];
	public $data = [
		10 => ['ww_wrkstptype_name' => 'Begin', 'ww_wrkstptype_icon' => 'fas fa-hourglass-start'],
		20 => ['ww_wrkstptype_name' => 'Intermediate', 'ww_wrkstptype_icon' => 'fas fa-hourglass-half'],
		30 => ['ww_wrkstptype_name' => 'End', 'ww_wrkstptype_icon' => 'fas fa-hourglass-end']
	];
}