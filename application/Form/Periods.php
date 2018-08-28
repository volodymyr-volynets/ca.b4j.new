<?php

namespace Form;
class Periods extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_periods';
	public $module_code = 'B4';
	public $title = 'B/J Periods Form';
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
			'b4_period_id' => [
				'b4_period_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Group #', 'domain' => 'group_id_sequence', 'percent' => 50, 'navigation' => true],
				'b4_period_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'code', 'required' => true, 'percent' => 45, 'validator_method' => '\Object\Validator\UpperCase::validate'],
				'b4_period_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'b4_period_name' => [
				'b4_period_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'b4_period_start_date' => [
				'b4_period_start_date' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Registration Start Date', 'type' => 'datetime', 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'b4_period_end_date' => ['order' => 2, 'label_name' => 'Registration End Date', 'type' => 'datetime', 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'b4_period_camp_start_date' => [
				'b4_period_camp_start_date' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Camp Start Date', 'type' => 'date', 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'b4_period_camp_end_date' => ['order' => 2, 'label_name' => 'Camp End Date', 'type' => 'date', 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'b4_period_max_registrations' => [
				'b4_period_max_registrations' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Max Registrations', 'domain' => 'counter', 'required' => true],
				'b4_period_new_registrations' => ['order' => 2, 'label_name' => 'New Registrations', 'domain' => 'counter', 'readonly' => true],
				'b4_period_confirmed_registrations' => ['order' => 3, 'label_name' => 'Confirmed Registrations', 'domain' => 'counter', 'readonly' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Periods',
		'model' => '\Model\Periods'
	];
}