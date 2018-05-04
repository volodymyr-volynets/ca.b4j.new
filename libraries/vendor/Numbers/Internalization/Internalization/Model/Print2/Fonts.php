<?php

namespace Numbers\Internalization\Internalization\Model\Print2;
class Fonts extends \Object\Data {
	public $column_key = 'in_print_font_code';
	public $column_prefix = 'in_print_font_';
	public $orderby;
	public $columns = [
		'in_print_font_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'in_print_font_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		'courier' => ['in_print_font_name' => 'Courier'],
		'courierB' => ['in_print_font_name' => 'Courier (B)'],
		'courierI' => ['in_print_font_name' => 'Courier (I)'],
		'courierBI' => ['in_print_font_name' => 'Courier (BI)'],
		'helvetica' => ['in_print_font_name' => 'Helvetica'],
		'helveticaB' => ['in_print_font_name' => 'Helvetica (B)'],
		'helveticaI' => ['in_print_font_name' => 'Helvetica (I)'],
		'helveticaBI' => ['in_print_font_name' => 'Helvetica (BI)'],
		'times' => ['in_print_font_name' => 'Times'],
		'timesB' => ['in_print_font_name' => 'Times (B)'],
		'timesI' => ['in_print_font_name' => 'Times (I)'],
		'timesBI' => ['in_print_font_name' => 'Times (BI)'],
		'symbol' => ['in_print_font_name' => 'Symbol'],
		'zapfdingbats' => ['in_print_font_name' => 'Zapfdingbats']
	];
}