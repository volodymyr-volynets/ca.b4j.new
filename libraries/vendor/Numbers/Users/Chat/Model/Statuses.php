<?php

namespace Numbers\Users\Chat\Model;
class Statuses extends \Object\Data {
	public $column_key = 'ct_status_id';
	public $column_prefix = 'ct_status_';
	public $orderby = [
		'ct_status_id' => SORT_ASC
	];
	public $columns = [
		'ct_status_id' => ['name' => 'Status #', 'domain' => 'type_id'],
		'ct_status_name' => ['name' => 'Name', 'type' => 'text'],
		'ct_status_icon' => ['name' => 'Icon', 'type' => 'text']
	];
	public $data = [
		10 => ['ct_status_name' => 'Online', 'ct_status_icon' => 'fas fa-toggle-on'],
		20 => ['ct_status_name' => 'Away', 'ct_status_icon' => 'fas fa-toggle-off'],
		30 => ['ct_status_name' => 'Invisible', 'ct_status_icon' => 'fas fa-user-secret'],
	];
	public $options_map = [
		'ct_status_name' => 'name',
		'ct_status_icon' => 'icon_class'
	];
}