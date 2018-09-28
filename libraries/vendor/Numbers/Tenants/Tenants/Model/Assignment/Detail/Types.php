<?php

namespace Numbers\Tenants\Tenants\Model\Assignment\Detail;
class Types extends \Object\Data {
	public $column_key = 'tm_assigndtltype_id';
	public $column_prefix = 'tm_assigndtltype_';
	public $orderby;
	public $columns = [
		'tm_assigndtltype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'tm_assigndtltype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['tm_assigndtltype_name' => 'Primary'],
		20 => ['tm_assigndtltype_name' => 'Secondary']
	];
}