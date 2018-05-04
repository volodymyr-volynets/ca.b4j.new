<?php

namespace Numbers\Users\TaskScheduler\Form;
class Jobs extends \Object\Form\Wrapper\Base {
	public $form_link = 'ts_jobs';
	public $module_code = 'TS';
	public $title = 'T/S Jobs Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'parameters_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\TaskScheduler\Model\JobParameters',
			'details_pk' => ['ts_jbparam_name'],
			'order' => 800
		],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'ts_job_id' => [
				'ts_job_id' => ['order' => 1, 'row_order' => 100, 'name' => 'Job #', 'domain' => 'group_id_sequence', 'percent' => 95, 'navigation' => true],
				'ts_job_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'ts_job_name' => [
				'ts_job_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'ts_job_daemon_code' => [
				'ts_job_daemon_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Daemon', 'domain' => 'type_code', 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\TaskScheduler\Model\Daemons'],
			],
			'ts_job_task_code' => [
				'ts_job_task_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Task', 'domain' => 'group_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\TaskScheduler\Model\Tasks', 'onchange' => 'this.form.submit();'],
				'ts_job_user_id' => ['order' => 2, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Users'],
			],
			'cron' => [
				'ts_job_cron_minute' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Minutes', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
				'ts_job_cron_hour' => ['order' => 2, 'label_name' => 'Hours', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
				'ts_job_cron_day_of_month' => ['order' => 3, 'label_name' => 'Day of Month', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
				'ts_job_cron_month' => ['order' => 4, 'label_name' => 'Month', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
				'ts_job_cron_day_of_week' => ['order' => 5, 'label_name' => 'Day of Week', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
				'ts_job_cron_year' => ['order' => 6, 'label_name' => 'Years', 'domain' => 'code', 'default' => '*', 'required' => true, 'percent' => 15],
			],
			'timezone' => [
				'ts_job_timezone_code' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Timezone', 'domain' => 'timezone_code', 'percent' => 50, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Timezones'],
			]
		],
		'parameters_container' => [
			'row1' => [
				'ts_jbparam_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Parameter', 'domain' => 'name', 'required' => true, 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '', 'onchange' => 'this.form.submit();'],
				'ts_jbparam_value' => ['order' => 2, 'label_name' => 'Value', 'type' => 'text', 'null' => true, 'percent' => 50]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'model' => '\Numbers\Users\TaskScheduler\Model\Jobs',
		'details' => [
			'\Numbers\Users\TaskScheduler\Model\JobParameters' => [
				'name' => 'Parameters',
				'pk' => ['ts_jbparam_tenant_id', 'ts_jbparam_job_id', 'ts_jbparam_name'],
				'type' => '1M',
				'map' => ['ts_job_tenant_id' => 'ts_jbparam_tenant_id', 'ts_job_id' => 'ts_jbparam_job_id']
			],
		]
	];

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'ts_jbparam_name') {
			if (!empty($form->values['ts_job_task_code'])) {
				$model = new \Numbers\Users\TaskScheduler\Model\TaskParameters();
				$options['options']['options'] = $model->options(['where' => [
					'ts_tskparam_task_code' => $form->values['ts_job_task_code']
				]]);
			}
		}
	}

	public function validate(& $form) {
		// validate cron expresions
		$expression_model = new \Numbers\Users\TaskScheduler\Helper\Expression();
		if (!empty($form->values['ts_job_cron_minute']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_minute'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_minute');
		if (!empty($form->values['ts_job_cron_hour']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_hour'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_hour');
		if (!empty($form->values['ts_job_cron_day_of_month']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_day_of_month'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_day_of_month');
		if (!empty($form->values['ts_job_cron_month']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_month'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_month');
		if (!empty($form->values['ts_job_cron_day_of_week']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_day_of_week'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_day_of_week');
		if (!empty($form->values['ts_job_cron_year']) && !$expression_model->isValidOneExpression($form->values['ts_job_cron_year'])) $form->error(DANGER, \Object\Content\Messages::INVALID_VALUES, 'ts_job_cron_year');
		// validate mandatory values
		$model = new \Numbers\Users\TaskScheduler\Model\TaskParameters();
		$mandatory_options = $model->options(['where' => [
			'ts_tskparam_task_code' => $form->values['ts_job_task_code'],
			'ts_tskparam_mandatory' => 1
		]]);
		foreach ($form->values['\Numbers\Users\TaskScheduler\Model\JobParameters'] as $k => $v) {
			if (!empty($mandatory_options[$v['ts_jbparam_name']])) {
				if (empty($v['ts_jbparam_value'])) {
					$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\TaskScheduler\Model\JobParameters[$k][ts_jbparam_value]");
				}
				unset($mandatory_options[$v['ts_jbparam_name']]);
			}
		}
		if (!empty($mandatory_options)) {
			foreach ($mandatory_options as $k => $v) {
				$form->error(DANGER, 'Missing required parameter [Parameter]!', null, [
					'replace' => [
						'[Parameter]' => $v['name']
					]
				]);
			}
		}
	}
}