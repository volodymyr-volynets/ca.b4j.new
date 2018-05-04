<?php

namespace Numbers\Users\Organizations\Model\Jurisdiction;
class Types extends \Object\Data {
	public $column_key = 'on_juristype_id';
	public $column_prefix = 'on_juristype_';
	public $columns = [
		'on_juristype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_juristype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['on_juristype_name' => 'Identifying'],
		20 => ['on_juristype_name' => 'Income Tax'],
		30 => ['on_juristype_name' => 'Transaction Tax'],
	];
}