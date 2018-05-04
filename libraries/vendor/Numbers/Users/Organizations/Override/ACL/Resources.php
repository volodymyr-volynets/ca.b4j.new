<?php

namespace Numbers\Users\Organizations\Override\ACL;
class Resources {
	public $data = [
		'layout' => [
			'logo' => [
				'method' => '\Numbers\Users\Organizations\Helper\Logo::getURL'
			]
		],
		'postlogin_dashboard' => [
			'numbers_organizations' => [
				'name' => 'Organization Management',
				'icon' => 'fas fa-building',
				'model' => '\Numbers\Users\Organizations\Helper\Dashboard',
				'order' => 33000
			]
		],
	];
}