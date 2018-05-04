<?php

namespace Numbers\Users\Users\Form\Scheduling;
class Holidays extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_scheduling_holidays';
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Holidays Form';
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
			'um_schedholi_id' => [
				'um_schedholi_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Holiday #', 'domain' => 'holiday_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_schedholi_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_schedholi_name' => [
				'um_schedholi_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 75, 'required' => true],
				'um_schedholi_date' => ['order' => 1, 'label_name' => 'Date', 'type' => 'date', 'required' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'um_schedholi_organization_id' => [
				'um_schedholi_organization_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
				'um_schedholi_location_id' => ['order' => 2, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive'],
			],
			'um_schedholi_country_code' => [
				'um_schedholi_country_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries', 'onchange' => 'this.form.submit();'],
				'um_schedholi_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces', 'options_depends' => ['cm_province_country_code' => 'um_schedholi_country_code']],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Holidays',
		'model' => '\Numbers\Users\Users\Model\Scheduling\Holidays'
	];
}