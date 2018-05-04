<?php

namespace Numbers\Users\Users\Model\Message;
class RecipientTypes extends \Object\Data {
	public $column_key = 'um_mesrctype_id';
	public $column_prefix = 'um_mesrctype_';
	public $orderby;
	public $columns = [
		'um_mesrctype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_mesrctype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_mesrctype_name' => 'To'],
		20 => ['um_mesrctype_name' => 'CC'],
		30 => ['um_mesrctype_name' => 'BCC']
	];
}