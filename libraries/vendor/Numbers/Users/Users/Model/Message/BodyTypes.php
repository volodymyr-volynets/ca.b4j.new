<?php

namespace Numbers\Users\Users\Model\Message;
class BodyTypes extends \Object\Data {
	public $column_key = 'um_mesbdtype_id';
	public $column_prefix = 'um_mesbdtype_';
	public $orderby;
	public $columns = [
		'um_mesbdtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_mesbdtype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_mesbdtype_name' => 'Plain'],
		20 => ['um_mesbdtype_name' => 'HTML']
	];
}