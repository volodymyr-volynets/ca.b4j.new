<?php

namespace Numbers\Countries\Countries\Form;
class Countries extends \Object\Form\Wrapper\Base {
	public $form_link = 'cm_countries';
	public $module_code = 'CM';
	public $title = 'C/M Countries Form';
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
			'cm_country_code' => [
				'cm_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country Code', 'domain' => 'country_code', 'percent' => 50, 'required' => true, 'navigation' => true],
				'cm_country_code3' => ['order' => 2, 'label_name' => 'Country Code (3)', 'domain' => 'country_code3', 'percent' => 45, 'navigation' => true],
				'cm_country_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cm_country_name' => [
				'cm_country_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 75, 'required' => true],
				'cm_country_number' => ['order' => 2, 'label_name' => 'Country Number', 'domain' => 'country_number', 'percent' => 25],
			],
			'cm_country_region_id' => [
				'cm_country_region_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Region', 'domain' => 'country_number', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Regions'],
				'cm_country_sub_region_id' => ['order' => 2, 'label_name' => 'Sub Region', 'domain' => 'country_number', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Regions'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Countries',
		'model' => '\Numbers\Countries\Countries\Model\Countries'
	];
}