<?php

namespace Numbers\Users\Documents\Base\Override\ACL;
class Resources {
	public $data = [
		'generate_photo' => [
			'generate_url' => [
				'method' => '\Numbers\Users\Documents\Base\Base::generateURL'
			],
			'generate_icon' => [
				'method' => '\Numbers\Users\Documents\Base\Base::generateIconURL'
			]
		],
	];
}