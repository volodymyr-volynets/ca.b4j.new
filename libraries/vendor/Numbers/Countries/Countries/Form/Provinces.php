<?php

namespace Numbers\Countries\Countries\Form;
class Provinces extends \Object\Form\Wrapper\Base {
	public $form_link = 'cm_provinces';
	public $module_code = 'CM';
	public $title = 'C/M Provinces Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'cm_province_country_code' => [
				'cm_province_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country', 'domain' => 'country_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries'],
				'cm_province_province_code' => ['order' => 2, 'label_name' => 'Province Code', 'domain' => 'province_code', 'percent' => 50, 'required' => true, 'navigation' => ['depends' => ['cm_province_country_code']]],
			],
			'cm_province_name' => [
				'cm_province_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'cm_province_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Provinces',
		'model' => '\Numbers\Countries\Countries\Model\Provinces'
	];
}