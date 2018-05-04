<?php

namespace Numbers\Users\News\Override\ACL;
class Resources {
	public $data = [
		'postlogin_dashboard' => [
			'numbers_news' => [
				'name' => 'News',
				'icon' => 'fas fa-newspaper',
				'model' => '\Numbers\Users\News\Helper\Dashboard',
				'order' => -32000,
				'double' => true
			]
		]
	];
}