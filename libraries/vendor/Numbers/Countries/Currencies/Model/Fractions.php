<?php

namespace Numbers\Countries\Currencies\Model;
class Fractions extends \Object\Data {
	public $column_key = 'cs_fraction_id';
	public $column_prefix = 'cs_fraction_';
	public $orderby = ['cs_fraction_name' => SORT_ASC];
	public $columns = [
		'cs_fraction_id' => ['name' => 'Digits', 'domain' => 'fraction_digits'],
		'cs_fraction_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		0 => ['cs_fraction_name' => '0 digits'],
		1 => ['cs_fraction_name' => '1 digit'],
		2 => ['cs_fraction_name' => '2 digits'],
	];
}