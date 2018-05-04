<?php

namespace Numbers\Users\Users\Model\Role\Manage;
class ViewUsersTypes extends \Object\Data {
	public $column_key = 'um_rolviewusrtype_id';
	public $column_prefix = 'um_rolviewusrtype_';
	public $orderby;
	public $columns = [
		'um_rolviewusrtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_rolviewusrtype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_rolviewusrtype_name' => 'View Only'],
		20 => ['um_rolviewusrtype_name' => 'View & Become']
	];
}