<?php

namespace Numbers\Users\Organizations\Model\Location\Territory;
class NodeTypes extends \Object\Data {
	public $column_key = 'on_terrnodetype_id';
	public $column_prefix = 'on_terrnodetype_';
	public $columns = [
		'on_terrnodetype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_terrnodetype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_terrnodetype_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $orderby = [
		'on_terrnodetype_id' => SORT_ASC
	];
	public $options_map = [
		'on_terrnodetype_name' => 'name',
		'on_terrnodetype_icon' => 'icon_class',
	];
	public $data = [
		10 => ['on_terrnodetype_name' => 'Root', 'on_terrnodetype_icon' => 'fas fa-tree'],
		20 => ['on_terrnodetype_name' => 'Branch', 'on_terrnodetype_icon' => 'fab fa-pagelines'],
		30 => ['on_terrnodetype_name' => 'Leaf', 'on_terrnodetype_icon' => 'fas fa-leaf'],
	];
}