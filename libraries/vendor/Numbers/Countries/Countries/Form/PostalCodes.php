<?php

namespace Numbers\Countries\Countries\Form;
class PostalCodes extends \Object\Form\Wrapper\Base {
	public $form_link = 'cm_postal_codes';
	public $module_code = 'CM';
	public $title = 'C/M Postal Codes Form';
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
			'cm_postal_country_code' => [
				'cm_postal_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country', 'domain' => 'country_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries', 'onchange' => 'this.form.submit();'],
				'cm_postal_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'percent' => 45, 'required' => true, 'navigation' => ['depends' => ['cm_postal_country_code']]],
				'cm_postal_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cm_postal_province_code' => [
				'cm_postal_province_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces', 'options_depends' => ['cm_province_country_code' => 'cm_postal_country_code']],
				'cm_postal_city' => ['order' => 2, 'label_name' => 'City', 'domain' => 'name', 'null' => true, 'percent' => 50],
			],
			'cm_postal_latitude' => [
				'cm_postal_latitude' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Latitude', 'domain' => 'geo_coordinate', 'null' => true, 'percent' => 50],
				'cm_postal_longitude' => ['order' => 2, 'label_name' => 'Longitude', 'domain' => 'geo_coordinate', 'null' => true, 'percent' => 50],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Postal Codes',
		'model' => '\Numbers\Countries\Countries\Model\PostalCodes'
	];
}