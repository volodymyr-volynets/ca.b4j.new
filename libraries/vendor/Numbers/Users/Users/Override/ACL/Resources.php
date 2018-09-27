<?php

namespace Numbers\Users\Users\Override\ACL;
class Resources {
	public $data = [
		'application_structure' => [
			'tenant' => [
				'tenant_datasource' => '\Numbers\Tenants\Tenants\DataSource\Tenants',
				'column_prefix' => 'tm_tenant_'
			]
		],
		'authorization' => [
			'login' => [
				'url' => '/Numbers/Users/Users/Controller/Login'
			],
			'logout' => [
				'url' => '/Numbers/Users/Users/Controller/Logout/Quick'
			]
		],
		'controllers' => [
			'primary' => [
				'datasource' => '\Numbers\Users\Users\DataSource\ACL\Controllers'
			]
		],
		'roles' => [
			'primary' => [
				'datasource' => '\Numbers\Users\Users\DataSource\ACL\Roles'
			]
		],
		'menu' => [
			'primary' => [
				'datasource' => '\Numbers\Users\Users\DataSource\ACL\Menu\Permissions'
			],
			'usage' => [
				'datasource' => '\Numbers\Users\Users\DataSource\ACL\Menu'
			]
		],
		'user_roles' => [
			'anonymous' => [
				'data' => 'SYSTEM_ANONYMOUS'
			],
			'authorized' => [
				'data' => 'SYSTEM_AUTHORIZED'
			]
		],
		'destroy' => [
			'log_notifications' => [
				'method' => '\Numbers\Users\Users\Helper\Notification\Sender::destroy'
			]
		],
		'postlogin_dashboard' => [
			'numbers_users' => [
				'name' => 'User Management',
				'icon' => 'far fa-user',
				'model' => '\Numbers\Users\Users\Helper\Dashboard\Dashboard',
				'order' => 32000
			]
		],
		'postlogin_brand_url' => [
			'url' => [
				'url' => '/Numbers/Users/Users/Controller/Helper/Dashboard'
			]
		],
		'form_overrides' => [
			'primary' => [
				'model' => '\Numbers\Users\Users\DataSource\ACL\Form\Overrides'
			]
		],
	];
}