<?php

namespace Numbers\Users\Users\Form\Owner;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'um_owner_executing_collection';
	public $data = [];

	public function __construct($options = []) {
		$linked_type_code = $options['input']['__linked_type_code'];
		$linked_module_id = (int) $options['input']['__linked_module_id'];
		$linked_id = (int) $options['input']['__linked_id'];
		// render form if we have records
		if (!empty($linked_id)) {
			$this->data = [
				self::MAIN_SCREEN => [
					'options' => [
						'type' => 'forms',
					],
					'order' => 1000,
					self::ROWS => []
				]
			];
			$this->data[self::MAIN_SCREEN][self::ROWS]['row1'] = [
				'order' => 1000,
				'options' => [
					'type' => 'tabs',
					'segment' => [
						'type' => 'info',
						'header' => [
							'icon' => ['type' => 'far fa-user'],
							'title' => 'Owners / Appointments'
						]
					],
					'its_own_segment' => true
				]
			];
			// owners
			$input = $options['input'];
			$input['um_owneruser_linked_type_code'] = $linked_type_code;
			$input['um_owneruser_linked_module_id'] = $linked_module_id;
			$input['um_owneruser_linked_id'] = $linked_id;
			$input['__anchor'] = 'form_um_owners_form_id_form_anchor';
			$this->data[self::MAIN_SCREEN][self::ROWS]['row1'][self::FORMS]['um_owners_form_id'] = [
				'model' => '\Numbers\Users\Users\Form\Owner\ExistingOwners',
				'options' => [
					'label_name' => 'Owners',
					'form_link' => 'um_owners_form_id',
					'percent' => 100,
					'input' => $input,
					'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
				],
				'order' => 1
			];
			// appointments
			$input = $options['input'];
			$input['um_schedinterval_linked_type_code'] = $linked_type_code;
			$input['um_schedinterval_linked_module_id'] = $linked_module_id;
			$input['um_schedinterval_linked_id'] = $linked_id;
			$input['__anchor'] = 'form_um_appointments_form_id_form_anchor';
			$this->data[self::MAIN_SCREEN][self::ROWS]['row1'][self::FORMS]['um_appointments_form_id'] = [
				'model' => '\Numbers\Users\Users\Form\Owner\ExistingAppointments',
				'options' => [
					'label_name' => 'Appointments',
					'form_link' => 'um_appointments_form_id',
					'percent' => 100,
					'input' => $input,
					'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
				],
				'order' => 2
			];
		}
		// change owners only if you permitted
		/*
		if (\Application::$controller->can('Record_Execute_Owners', 'Edit')) {
			$input['__anchor'] = 'form_um_new_owners_form_id_form_anchor';
			$this->data[self::MAIN_SCREEN][self::ROWS]['row1'][self::FORMS]['um_new_owners_form_id'] = [
				'model' => '\Numbers\Users\Users\Form\Owner\NewOwners',
				'options' => [
					'label_name' => 'New Owners',
					'form_link' => 'um_new_owners_form_id',
					'percent' => 100,
					'input' => $input,
					'bypass_hidden_from_input' => ($options['__parent_options']['bypass_input'] ?? []),
				],
				'order' => 2
			];
		}
		*/
		// call parent constructor
		parent::__construct($options);
	}

	public function distribute() {

	}
}