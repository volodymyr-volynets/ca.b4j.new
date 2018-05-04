<?php

namespace Numbers\Users\Users\Model\Message;
class HeaderTypes extends \Object\Data {
	public $column_key = 'um_meshdrtype_id';
	public $column_prefix = 'um_meshdrtype_';
	public $orderby;
	public $columns = [
		'um_meshdrtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_meshdrtype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_meshdrtype_name' => 'Email Notification'],
		20 => ['um_meshdrtype_name' => 'Chat Message']
	];
}