<?php

namespace Numbers\Countries\Countries\Form;
class Regions extends \Object\Form\Wrapper\Base {
	public $form_link = 'cm_regions';
	public $module_code = 'CM';
	public $title = 'C/M Regions Form';
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
			'cm_region_id' => [
				'cm_region_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Region #', 'domain' => 'country_number', 'percent' => 95, 'required' => true, 'navigation' => true],
				'cm_region_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cm_region_name' => [
				'cm_region_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Regions',
		'model' => '\Numbers\Countries\Countries\Model\Regions'
	];
}