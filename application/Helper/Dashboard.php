<?php

namespace Helper;
class Dashboard extends \Numbers\Users\Users\Helper\Dashboard\Builder {

	/**
	 * Data
	 *
	 * @var array
	 */
	public $data = [
		1 => [
			1 => [
				'name' => 'Periods',
				'icon' => 'far fa-calendar',
				'acl' => [
					'resource_id' => '\Controller\B4J\Periods',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/B4J/Periods'
			],
			2 => [
				'name' => 'Camp Registrations',
				'icon' => 'fas fa-registered',
				'acl' => [
					'resource_id' => '\Controller\B4J\Registrations',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/B4J/Registrations'
			],
			3 => [
				'name' => 'New Camp Registration',
				'icon' => 'far fa-registered',
				'acl' => [
					'resource_id' => '\Controller\B4J\Register',
					'method_code' => 'Index',
					'action_id' => null
				],
				'url' => '/B4J/Register'
			],
			4 => [
				'name' => '&nbsp;'
			],
			5 => [
				'name' => '&nbsp;'
			],
			6 => [
				'name' => '&nbsp;'
			],
		],
		2 => [
			1 => [
				'name' => '&nbsp;'
			],
			2 => [
				'name' => 'Counselor Registrations',
				'icon' => 'fab fa-delicious',
				'acl' => [
					'resource_id' => '\Controller\B4J\Counselors',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/B4J/Counselors'
			],
			3 => [
				'name' => 'New Counselor Registration',
				'icon' => 'fab fa-delicious',
				'acl' => [
					'resource_id' => '\Controller\B4J\CounselorsRegister',
					'method_code' => 'Index',
					'action_id' => null
				],
				'url' => '/B4J/CounselorsRegister'
			],
			4 => [
				'name' => '&nbsp;'
			],
			5 => [
				'name' => '&nbsp;'
			],
			6 => [
				'name' => '&nbsp;'
			],
		],
		3 => [
			1 => [
				'name' => '&nbsp;'
			],
			2 => [
				'name' => '&nbsp;'
			],
			3 => [
				'name' => '&nbsp;'
			],
			4 => [
				'name' => '&nbsp;'
			],
			5 => [
				'name' => '&nbsp;'
			],
			6 => [
				'name' => '&nbsp;'
			],
		]
	];

	/**
	 * Constructor
	 */
	public function __construct() {}
}