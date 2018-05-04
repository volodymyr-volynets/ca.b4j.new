<?php

namespace Numbers\Users\Chat\Data;
class Notifications extends \Object\Import {
	public $data = [
		'features' => [
			'options' => [
				'pk' => ['sm_feature_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Module\Features',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_feature_module_code' => 'CT',
					'sm_feature_code' => 'CT::CHAT_MESSAGE',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'C/T Chat Message',
					'sm_feature_icon' => 'far fa-comments',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
			]
		],
		'notifications' => [
			'options' => [
				'pk' => ['sm_notification_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Notifications',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_notification_code' => 'CT::CHAT_MESSAGE',
					'sm_notification_name' => 'C/T Chat Message',
					'sm_notification_subject' => '',
					'sm_notification_body' => '',
					'sm_notification_important' => 0,
					'sm_notification_inactive' => 0
				]
			]
		],
	];
}