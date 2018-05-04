<?php

namespace Numbers\Users\Users\Form\Scheduling;
class Shifts extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_scheduling_shifts';
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Shifts Form';
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
			'um_schedshift_id' => [
				'um_schedshift_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Shift #', 'domain' => 'shift_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_schedshift_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_schedshift_name' => [
				'um_schedshift_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'um_schedshift_organization_id' => [
				'um_schedshift_organization_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
				'um_schedshift_location_id' => ['order' => 2, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive'],
			],
			'um_schedshift_work_starts' => [
				'um_schedshift_work_starts' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Work Starts', 'type' => 'time', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedshift_work_ends' => ['order' => 2, 'label_name' => 'Work Ends', 'type' => 'time', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedshift_lunch_starts' => ['order' => 3, 'label_name' => 'Lunch Starts', 'type' => 'time', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedshift_lunch_ends' => ['order' => 4, 'label_name' => 'Lunch Ends', 'type' => 'time', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Shifts',
		'model' => '\Numbers\Users\Users\Model\Scheduling\Shifts'
	];
}