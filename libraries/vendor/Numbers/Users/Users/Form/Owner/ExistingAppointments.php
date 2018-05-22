<?php

namespace Numbers\Users\Users\Form\Owner;
class ExistingAppointments extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_appointments_form_id';
	public $module_code = 'UM';
	public $title = 'U/M Existing Appointments Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'appointments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_key' => '\Numbers\Users\Users\Model\Scheduling\Intervals',
			'details_pk' => ['um_owneruser_type_id', 'um_owneruser_user_id'],
			'details_cannot_delete' => true,
			'order' => 200
		],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'um_schedinterval_linked_type_code' => ['label_name' => 'Linked Type Code', 'domain' => 'group_code', 'method' => 'hidden'],
				'um_schedinterval_linked_module_id' => ['label_name' => 'Linked Module #', 'domain' => 'module_id', 'method' => 'hidden'],
				'um_schedinterval_linked_id' => ['label_name' => 'Linked #', 'domain' => 'big_id', 'method' => 'hidden'],
			]
		],
		'appointments_container' => [
			'row1' => [
				'um_schedinterval_user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Users', 'readonly' => true],
				'um_schedinterval_appointment_type_id' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types', 'readonly' => true],
			],
			'row2' => [
				'um_schedinterval_work_starts' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Appointment Start', 'type' => 'datetime', 'null' => true, 'percent' => 50, 'readonly' => true],
				'um_schedinterval_work_ends' => ['order' => 2, 'label_name' => 'Appointment End', 'type' => 'datetime', 'null' => true, 'percent' => 50, 'readonly' => true],
			]
		],
	];
	public $collection = [];

	public function refresh(& $form) {
		$model = new \Numbers\Users\Users\Model\Scheduling\Intervals();
		$data = $model->get([
			'where' => [
				'um_schedinterval_linked_type_code' => $form->values['um_schedinterval_linked_type_code'],
				'um_schedinterval_linked_module_id' => $form->values['um_schedinterval_linked_module_id'],
				'um_schedinterval_linked_id' => $form->values['um_schedinterval_linked_id']
			],
			'pk' => ['um_schedinterval_id'],
			'orderby' => [
				'um_schedinterval_work_starts' => SORT_ASC,
				'um_schedinterval_id' => SORT_ASC
			]
		]);
		if (!empty($data)) {
			foreach ($data as $k => $v) {
				$form->values['\Numbers\Users\Users\Model\Scheduling\Intervals'][$k] = [
					'um_schedinterval_user_id' => $v['um_schedinterval_user_id'],
					'um_schedinterval_work_starts' => $v['um_schedinterval_work_starts'],
					'um_schedinterval_work_ends' => $v['um_schedinterval_work_ends'],
					'um_schedinterval_appointment_type_id' => $v['um_schedinterval_appointment_type_id']
				];
			}
		}
	}

	public function success(& $form) {
		$form->redirectOnSuccess();
	}
}