<?php

namespace Numbers\Users\Users\Form\Scheduling;
class Intervals extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_scheduling_intervals';
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Intervals Form';
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
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// children
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'description_container' => ['default_row_type' => 'grid', 'order' => 32001],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'description' => ['order' => 200, 'label_name' => 'Description'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
		],
	];
	public $elements = [
		'top' => [
			'um_schedinterval_id' => [
				'um_schedinterval_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Interval #', 'domain' => 'interval_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_schedinterval_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_schedinterval_name' => [
				'um_schedinterval_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'description' => [
				'description' => ['container' => 'description_container', 'order' => 100],
			]
		],
		'general_container' => [
			'um_schedinterval_type_id' => [
				'um_schedinterval_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Interval\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
				'um_schedinterval_status_id' => ['order' => 2, 'label_name' => 'Status', 'domain' => 'type_id', 'null' => true, 'required' => true, 'placeholder' => 'Status', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Interval\Statuses', 'options_options' => ['i18n' => 'skip_sorting']],
				'um_schedinterval_appointment_type_id' => ['order' => 3, 'label_name' => 'Appointment Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types'],
			],
			'um_schedinterval_shift_id' => [
				'um_schedinterval_shift_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Shift', 'domain' => 'shift_id', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Shifts::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			'um_schedinterval_work_starts' => [
				'um_schedinterval_work_starts' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Date Start', 'type' => 'datetime', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedinterval_work_ends' => ['order' => 2, 'label_name' => 'Date End', 'type' => 'datetime', 'percent' => 25, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedinterval_lunch_starts' => ['order' => 3, 'label_name' => 'Lunch Starts', 'type' => 'datetime', 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'um_schedinterval_lunch_ends' => ['order' => 4, 'label_name' => 'Lunch Ends', 'type' => 'datetime', 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'um_schedinterval_user_id' => [
				'um_schedinterval_user_id' => ['order' => 1, 'row_order' => 600, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Users::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_schedinterval_timezone_code' => ['order' => 2, 'label_name' => 'Timezone', 'domain' => 'timezone_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Timezones::optionsActive', 'readonly' => true],
			],
			'um_schedinterval_organization_id' => [
				'um_schedinterval_organization_id' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
				'um_schedinterval_location_id' => ['order' => 2, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive'],
			],
			'um_schedinterval_service_id' => [
				'um_schedinterval_service_id' => ['order' => 1, 'row_order' => 725, 'label_name' => 'Product / Service', 'domain' => 'service_id', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive'],
			],
			'um_schedinterval_location_name' => [
				'um_schedinterval_location_name' => ['order' => 1, 'row_order' => 750, 'label_name' => 'Location Name', 'domain' => 'name', 'null' => true, 'percent' => 100],
			],
			'um_schedinterval_country_code' => [
				'um_schedinterval_country_code' => ['order' => 1, 'row_order' => 800, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_schedinterval_province_code' => ['order' => 1, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'um_schedinterval_country_code']],
			],
		],
		'description_container' => [
			'um_schedinterval_description' => [
				'um_schedinterval_description' => ['order' => 1, 'row_order' => 900, 'label_name' => 'Description', 'domain' => 'description', 'null' => true, 'method' => 'wysiwyg'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Intervals',
		'model' => '\Numbers\Users\Users\Model\Scheduling\Intervals'
	];

	public function refresh(& $form) {
		// if we changed shift
		if (($form->misc_settings['__form_onchange_field_values_key'][0] ?? '') == 'um_schedinterval_shift_id' && !empty($form->values['um_schedinterval_shift_id'])) {
			$shift = \Numbers\Users\Users\Model\Scheduling\Shifts::loadById($form->values['um_schedinterval_shift_id']);
			$form->values['um_schedinterval_work_starts'] = $shift['um_schedshift_work_starts'];
			$form->values['um_schedinterval_work_ends'] = $shift['um_schedshift_work_ends'];
			$form->values['um_schedinterval_lunch_starts'] = $shift['um_schedshift_lunch_starts'];
			$form->values['um_schedinterval_lunch_ends'] = $shift['um_schedshift_lunch_ends'];
		}
		// if we changed shift
		if (($form->misc_settings['__form_onchange_field_values_key'][0] ?? '') == 'um_schedinterval_user_id' && !empty($form->values['um_schedinterval_user_id'])) {
			$user = \Numbers\Users\Users\Model\Users::loadById($form->values['um_schedinterval_user_id']);
			$form->values['um_schedinterval_country_code'] = $user['um_user_operating_country_code'];
			$form->values['um_schedinterval_province_code'] = $user['um_user_operating_province_code'];
		}
		// grab default timezone
		if (empty($form->values['um_schedinterval_timezone_code'])) {
			$form->values['um_schedinterval_timezone_code'] = \I18n::$options['timezone_code'];
		}
		// empty lunch intervals
		if ($form->values['um_schedinterval_type_id'] != 1000) {
			$form->values['um_schedinterval_lunch_starts'] = null;
			$form->values['um_schedinterval_lunch_ends'] = null;
		}
	}

	public function validate(& $form) {
		// todo: convert timezone
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'um_schedinterval_lunch_starts' || $options['options']['field_name'] == 'um_schedinterval_lunch_ends') {
			if ($neighbouring_values['um_schedinterval_type_id'] != 1000) {
				$options['options']['readonly'] = true;
			}
		}
	}
}