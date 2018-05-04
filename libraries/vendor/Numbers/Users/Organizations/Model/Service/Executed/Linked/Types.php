<?php

namespace Numbers\Users\Organizations\Model\Service\Executed\Linked;
class Types extends \Object\Data {
	public $column_key = 'on_execwflinktype_code';
	public $column_prefix = 'on_execwflinktype_';
	public $orderby = [
		'on_execwflinktype_name' => SORT_ASC
	];
	public $columns = [
		'on_execwflinktype_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_execwflinktype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_execwflinktype_module_code' => ['name' => 'Module', 'domain' => 'module_code'],
		'on_execwflinktype_url' => ['name' => 'Url', 'domain' => 'code']
	];
	public $data = [];
}