<?php

namespace Numbers\Internalization\Internalization\Form;
class Timezones extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_timezones';
	public $module_code = 'IN';
	public $title = 'I/N Timezones Form';
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
			'in_timezone_code' => [
				'in_timezone_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'timezone_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'in_timezone_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'in_timezone_name' => [
				'in_timezone_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Timezones',
		'model' => '\Numbers\Internalization\Internalization\Model\Timezones'
	];

	public function validate(& $form) {
		if (!empty($form->values['in_timezone_code'])) {
			$current_timezone = date_default_timezone_get();
			if (!date_default_timezone_set($form->values['in_timezone_code'])) {
				$form->error('danger', 'Provided timezone is not valid!', 'in_timezone_code');
			}
			date_default_timezone_set($current_timezone);
		}
	}
}