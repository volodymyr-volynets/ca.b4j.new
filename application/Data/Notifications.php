<?php

namespace Data;
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
					'sm_feature_module_code' => 'B4',
					'sm_feature_code' => 'B4::EMAIL_REG_CONFIRMATION',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'B/J Email Registration Confirmation',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'B4',
					'sm_feature_code' => 'B4::EMAIL_REG_ACCEPTED',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'B/J Email Registration Accepted',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'B4',
					'sm_feature_code' => 'B4::EMAIL_NEED_MEDICAL',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'B/J Email Need Medical',
					'sm_feature_icon' => 'far fa-envelope',
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
					'sm_notification_code' => 'B4::EMAIL_REG_CONFIRMATION',
					'sm_notification_name' => 'B/J Email Registration Confirmation',
					'sm_notification_subject' => 'Break For Jesus: Registration Email Confirmation',
					'sm_notification_body' => 'Dear [Name],

Thank you for registering at Break For Jesus,

<a href="[URL]" target="_parent">Click here</a> to continue the registration process.

Or paste this into a browser:

[URL]

Please note that this link is only active for [Token_Valid_Hours] hours after receipt. After this time limit has expired the token will not work and you will need to resubmit the registration request.

Thank you!',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'B4::EMAIL_REG_ACCEPTED',
					'sm_notification_name' => 'B/J Email Registration Accepted',
					'sm_notification_subject' => 'Break For Jesus: Child Is Accepted',
					'sm_notification_body' => 'Dear [Name],

Please note that [Child] is accepted to the camp, you would receive an email to provide medical and additional information shortly.

Thank you!',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'B4::EMAIL_NEED_MEDICAL',
					'sm_notification_name' => 'B/J Email Need Medical',
					'sm_notification_subject' => 'Break For Jesus: Need Medical And Additional Information',
					'sm_notification_body' => 'Dear [Name],

We are in the final step of registration process - we would like to collect medical and additional information about your child [Child].

<a href="[URL]" target="_parent">Click here</a> to continue the registration process.

Or paste this into a browser:

[URL]

Please note that this link is only active for [Token_Valid_Hours] hours after receipt. After this time limit has expired the token will not work and you will need to resubmit the registration request.

Thank you!',
					'sm_notification_inactive' => 0
				],
			]
		],
	];
}