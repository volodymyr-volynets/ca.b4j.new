<?php

namespace Numbers\Users\Users\Form\Scheduling\Appointment;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_scheduling_appointment_types';
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Appointment Types Form';
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
			'um_schedapptype_id' => [
				'um_schedapptype_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type #', 'domain' => 'type_id_sequence', 'percent' => 50, 'navigation' => true],
				'um_schedapptype_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'required' => true, 'percent' => 45, 'navigation' => true],
				'um_schedapptype_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_schedapptype_name' => [
				'um_schedapptype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Types',
		'model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types'
	];
}