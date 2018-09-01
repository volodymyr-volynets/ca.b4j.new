<?php

namespace Numbers\Users\Users\Form\Scheduling;
class Availability extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_scheduling_availability';
	public $module_code = 'UM';
	public $title = 'U/M Schedule Availability Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'organization' => [
				'organization_id' => ['order' => 1, 'row_order' => 50, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			'dates' => [
				'datetime_start' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Datetime Start', 'type' => 'datetime', 'percent' => 50, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'datetime_end' => ['order' => 2, 'label_name' => 'Datetime End', 'type' => 'datetime', 'percent' => 50, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'days' => [
				'days' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Days', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 100, 'multiple_column' => 1, 'placeholder' => 'Days', 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Interval\WeekDays', 'options_options' => ['i18n' => 'skip_sorting']],
			],
			'type_id' => [
				'appointment_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Appointment Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types'],
				'subtype_id' => ['order' => 2, 'label_name' => 'Sub Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\SubTypes', 'options_options' => ['i18n' => 'skip_sorting']],
			],
			'duration' => [
				'duration' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Duration', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 30, 'placeholder' => 'Duration (Minutes)', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Duration', 'options_options' => ['i18n' => 'skip_sorting']],
				'travel' => ['order' => 2, 'label_name' => 'Travel Time', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 30, 'placeholder' => 'Travel Time (Minutes)', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Duration', 'options_options' => ['i18n' => 'skip_sorting']],
				'override_existing' => ['order' => 3, 'label_name' => 'Override Existing', 'type' => 'boolean', 'percent' => 20],
				'allow_holidays' => ['order' => 4, 'label_name' => 'Allow Holidays', 'type' => 'boolean', 'percent' => 20],
			],
			'user_id' => [
				'user_id' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Users', 'domain' => 'user_id', 'null' => true, 'required' => true, 'percent' => 100, 'multiple_column' => 1, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Users\DataSource\Users', 'options_depends' => ['selected_organizations' => 'organization_id'], 'options_params' => ['include_himself' => true]],
			],
			'service_id' => [
				'service_id' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 100, 'multiple_column' => 1, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Organizations\DataSource\Services', 'options_depends' => ['selected_organizations' => 'organization_id'], 'onchange' => 'this.form.submit();'],
			],
			'location_id' => [
				'location_id' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 100, 'multiple_column' => 1, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Users\DataSource\Assignment\Locations', 'options_depends' => ['selected_organizations' => 'organization_id', 'service_id' => 'service_id'], 'options_params' => ['assignment_type_id' => 50]],
			],
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];

	public function save(& $form) {
		$intervals_model = new \Numbers\Users\Users\Model\Scheduling\Intervals();
		$intervals_model->db_object->begin();
		foreach ($form->values['user_id'] as $user_k => $user_v) {
			foreach ($form->values['service_id'] as $service_k => $service_v) {
				foreach ($form->values['location_id'] as $location_k => $location_v) {
					// delete existing appointments
					if (!empty($form->values['override_existing'])) {
						$query = $intervals_model->queryBuilder()->delete();
						$query->where('AND', ['um_schedinterval_type_id', '=', 3000]);
						$query->where('AND', ['um_schedinterval_appointment_type_id', '=', $form->values['appointment_type_id']]);
						$query->where('AND', ['um_schedinterval_organization_id', '=', $form->values['organization_id']]);
						$query->where('AND', ['um_schedinterval_service_id', '=', $service_k]);
						$query->where('AND', ['um_schedinterval_location_id', '=', $location_k]);
						$query->where('AND', ['um_schedinterval_user_id', '=', $user_k]);
						$query->where('AND', ['um_schedinterval_work_starts', '>=', $form->values['datetime_start']]);
						$query->where('AND', ['um_schedinterval_work_starts', '<=', $form->values['datetime_end']]);
						$result = $query->query();
						if (!$result['success']) {
							$intervals_model->db_object->rollback();
							$form->error(DANGER, $result['error']);
							return false;
						}
					}
					// load service and location
					$service_name = \Numbers\Users\Organizations\Model\Services::loadById($service_k, 'on_service_name');
					$location_name = \Numbers\Users\Organizations\Model\Locations::loadById($location_k, 'on_location_name');
					// single appointment
					if ($form->values['subtype_id'] == 10) {
						$result = $intervals_model->collection()->merge([
							'um_schedinterval_name' => 'Availability',
							'um_schedinterval_hash_name' => $service_name . '::' . $location_name . '::' . $user_k,
							'um_schedinterval_type_id' => 3000,
							'um_schedinterval_appointment_type_id' => $form->values['appointment_type_id'],
							'um_schedinterval_status_id' => 10,
							'um_schedinterval_work_starts' => $form->values['datetime_start'],
							'um_schedinterval_work_ends' => $form->values['datetime_end'],
							'um_schedinterval_user_id' => $user_k,
							'um_schedinterval_organization_id' => $form->values['organization_id'],
							'um_schedinterval_service_id' => $service_k,
							'um_schedinterval_location_id' => $location_k,
							'um_schedinterval_timezone_code' => \Format::$options['timezone_code'],
							'um_schedinterval_inactive' => 0
						]);
						if (!$result['success']) {
							$intervals_model->db_object->rollback();
							$form->error(DANGER, $result['error']);
							return false;
						}
					} else if ($form->values['subtype_id'] == 20) {
						$datetime_start = new \DateTime($form->values['datetime_start']);
						$datetime_end = new \DateTime($form->values['datetime_end']);
						$merge_data = [];
						for ($current_date = clone $datetime_start; ($current_date->diff($datetime_end)->days >= 0 && $current_date->diff($datetime_end)->invert == 0); $current_date->add(new \DateInterval('P1D'))) {
							// skip holidays
							// todo
							// skip week day
							$week_day = (int) $current_date->format('w');
							if ($week_day === 0) $week_day = 7;
							if (empty($form->values['days'][$week_day])) {
								continue;
							}
							// recalcualte time
							$current_date->setTime(0, 0, 0, 0);
							$current_date1 = clone $current_date;
							$current_date2 = clone $current_date;
							$start_time = $current_date1->add(new \DateInterval('PT' . \Helper\Date::extractMinutes($datetime_start) . 'M'));
							$end_time = $current_date2->add(new \DateInterval('PT' . (\Helper\Date::extractMinutes($datetime_end) - $form->values['duration']) . 'M'));
							// add appointments
							while ($start_time->diff($end_time)->i >= 0 && $start_time->diff($end_time)->invert == 0) {
								$start_time_cloned = clone $start_time;
								$start_time_cloned->add(new \DateInterval('PT'. $form->values['duration'] . 'M'));
								$merge_data[] = [
									'um_schedinterval_name' => 'Availability',
									'um_schedinterval_hash_name' => $service_name . '::' . $location_name . '::' . $user_k,
									'um_schedinterval_type_id' => 3000,
									'um_schedinterval_appointment_type_id' => $form->values['appointment_type_id'],
									'um_schedinterval_status_id' => 10,
									'um_schedinterval_work_starts' => $start_time->format(\DateTime::ATOM),
									'um_schedinterval_work_ends' => $start_time_cloned->format(\DateTime::ATOM),
									'um_schedinterval_user_id' => $user_k,
									'um_schedinterval_organization_id' => $form->values['organization_id'],
									'um_schedinterval_service_id' => $service_k,
									'um_schedinterval_location_id' => $location_k,
									'um_schedinterval_timezone_code' => \Format::$options['timezone_code'],
									'um_schedinterval_inactive' => 0
								];
								// add capacity here
								// todo
								// increment date
								$start_time->add(new \DateInterval('PT' . ($form->values['duration'] + $form->values['travel']) . 'M'));
							}
						}
						// insert appointments
						if (!empty($merge_data)) {
							$result = $intervals_model->collection()->mergeMultiple($merge_data);
							if (!$result['success']) {
								$intervals_model->db_object->rollback();
								$form->error(DANGER, $result['error']);
								return false;
							}
							$merge_data = [];
						}
					}
				}
			}
		}
		$intervals_model->db_object->commit();
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		return true;
	}
}