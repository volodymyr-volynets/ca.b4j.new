<?php

namespace Numbers\Users\Users\Model\User\Linked;
class Types extends \Object\Data {
	public $column_key = 'um_usrlinktype_code';
	public $column_prefix = 'um_usrlinktype_';
	public $orderby = [
		'um_usrlinktype_name' => SORT_ASC
	];
	public $columns = [
		'um_usrlinktype_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'um_usrlinktype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		'AR_CUSTOMERS' => ['um_usrlinktype_name' => 'A/R Customers'],
		'AP_VENDORS' => ['um_usrlinktype_name' => 'A/P Vendors'],
		// todo: move it to proper modules
	];
}