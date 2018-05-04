<?php

namespace Numbers\Users\Monitoring\Override\ACL;
class Resources {
	public $data = [
		'initialize' => [
			'monitoring' => [
				'method' => '\Numbers\Users\Monitoring\Helper\Monitor::initialize'
			]
		],
		'monitoring' => [
			'action_method' => [
				'method' => '\Numbers\Users\Monitoring\Helper\Monitor::action'
			]
		],
		'destroy' => [
			'monitoring' => [
				'method' => '\Numbers\Users\Monitoring\Helper\Monitor::destroy'
			]
		]
	];
}