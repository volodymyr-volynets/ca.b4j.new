<?php

namespace Numbers\Users\TaskScheduler\Model\Collection;
class Tasks extends \Object\Collection {
	public $data = [
		'model' => '\Numbers\Users\TaskScheduler\Model\Tasks',
		'pk' => ['ts_task_code'],
		'details' => [
			'\Numbers\Users\TaskScheduler\Model\TaskParameters' => [
				'pk' => ['ts_tskparam_task_code', 'ts_tskparam_name'],
				'type' => '1M',
				'map' => ['ts_task_code' => 'ts_tskparam_task_code']
			]
		]
	];
}