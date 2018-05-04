<?php

namespace Numbers\Users\TaskScheduler\Form\External;
class CronDaemon extends \Object\Form\Wrapper\Base {
	public $form_link = 'ts_cron_daemon';
	public $module_code = 'TS';
	public $title = 'T/S External Cron Daemon Form';
	public $options = [
		'segment' => self::SEGMENT_TASK,
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
			'daemon_code' => [
				'daemon_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Daemon', 'domain' => 'type_code', 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\TaskScheduler\Model\Daemons'],
			],
			'tenant_id' => [
				'tenant_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Tenant', 'domain' => 'tenant_id', 'null' => true, 'percent' => 100, 'required' => false, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\Model\Tenants'],
			],
			'datetime' => [
				'datetime' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Datetime', 'type' => 'datetime', 'null' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right']
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];
	public $collection = [];
}