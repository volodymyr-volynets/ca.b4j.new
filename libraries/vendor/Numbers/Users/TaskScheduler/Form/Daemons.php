<?php

namespace Numbers\Users\TaskScheduler\Form;
class Daemons extends \Object\Form\Wrapper\Base {
	public $form_link = 'ts_daemons';
	public $module_code = 'TS';
	public $title = 'T/S Daemons Form';
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
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'ts_daemon_code' => [
				'ts_daemon_code' => ['order' => 1, 'row_order' => 100, 'name' => 'Code', 'domain' => 'type_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'ts_daemon_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'ts_daemon_name' => [
				'ts_daemon_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'ts_daemon_token' => [
				'ts_daemon_token' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Token', 'domain' => 'token', 'percent' => 100, 'required' => true],
			],
			'curl' => [
				'curl' => ['order' => 1, 'row_order' => 500, 'label_name' => 'cURL Command', 'custom_renderer' => '\Numbers\Users\TaskScheduler\Form\Daemons::curlLink'],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'model' => '\Numbers\Users\TaskScheduler\Model\Daemons'
	];

	public function curlLink(& $form, & $options, & $value, & $neighbouring_values) {
		$str = '<br/>';
		if (!empty($form->values['ts_daemon_code'])) {
			$str.= '/usr/bin/curl -s --data "daemon_code=' . urlencode($form->values['ts_daemon_code']) . '&daemon_token=' . urlencode($form->values['ts_daemon_token']) . '&__submit_button=1" ' . \Request::tenantHost('system') . 'Numbers/Users/TaskScheduler/Controller/External/CronDaemon';
		}
		return $str;
	}
}