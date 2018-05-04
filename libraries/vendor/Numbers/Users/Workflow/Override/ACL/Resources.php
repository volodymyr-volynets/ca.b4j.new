<?php

namespace Numbers\Users\Workflow\Override\ACL;
class Resources {
	public $data = [
		'workflow' => [
			'renderer' => [
				'method' => '\Numbers\Users\Workflow\Helper\ToolbarRenderer::render'
			]
		],
	];
}