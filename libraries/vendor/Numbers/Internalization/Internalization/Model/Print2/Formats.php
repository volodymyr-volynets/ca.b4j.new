<?php

namespace Numbers\Internalization\Internalization\Model\Print2;
class Formats extends \Object\Data {
	public $column_key = 'in_print_format_code';
	public $column_prefix = 'in_print_format_';
	public $orderby;
	public $columns = [
		'in_print_format_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'in_print_format_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		'A4' => ['in_print_format_name' => 'A4'],
		'LETTER' => ['in_print_format_name' => 'Letter'],
		'LEGAL' => ['in_print_format_name' => 'Legal']
	];
}