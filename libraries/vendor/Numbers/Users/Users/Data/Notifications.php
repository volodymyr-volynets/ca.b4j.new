<?php

namespace Numbers\Users\Users\Data;
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
					'sm_feature_module_code' => 'UM',
					'sm_feature_code' => 'UM::EMAIL_PASSWORD_CHANGED',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'U/M Email Password Changed',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'UM',
					'sm_feature_code' => 'UM::EMAIL_TENANT_CONFIRMATION',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'U/M Email Tenant Confirmation',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'UM',
					'sm_feature_code' => 'UM::EMAIL_RESET_PASSWORD',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'U/M Email Reset Password',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'UM',
					'sm_feature_code' => 'UM::EMAIL_USERS_CHANGED',
					'sm_feature_type' => 20,
					'sm_feature_name' => 'U/M Email Users Record Changed',
					'sm_feature_icon' => 'fas fa-users',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_common_notification_feature_code' => 'SM::EMAIL_COMMON_RECORD_CHANGE',
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'UM',
					'sm_feature_code' => 'UM::EMAIL_SEND_MESSAGE',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'U/M Email Send Message',
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
					'sm_notification_code' => 'UM::EMAIL_PASSWORD_CHANGED',
					'sm_notification_name' => 'U/M Email Password Changed',
					'sm_notification_subject' => 'Your Password Has Changed',
					'sm_notification_body' => 'Hello [Name],

We wanted to let you know that your password was changed.

If you did not perform this action, you can recover access by entering [Email] into the form at [Password_Reset_Url].

Please do not reply to this email.

Thank you!',
					'sm_notification_important' => 1,
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'UM::EMAIL_TENANT_CONFIRMATION',
					'sm_notification_name' => 'U/M Email Tenant Confirmation',
					'sm_notification_subject' => 'Tenant Registration Confirmation',
					'sm_notification_body' => 'Thank you for registering new tenant,

<a href="[URL]" target="_parent">Click here</a> to continue the registration process.

Or paste this into a browser:

[URL]

Please note that this link is only active for [Token_Valid_Hours] hours after receipt. After this time limit has expired the token will not work and you will need to resubmit the registration request.

Thank you!',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'UM::EMAIL_RESET_PASSWORD',
					'sm_notification_name' => 'U/M Email Reset Password',
					'sm_notification_subject' => 'Password Reset Request',
					'sm_notification_body' => 'Dear [Name],

Reset your password with this <a href="[URL]" target="_parent">temporary link</a>.

If the link does not work, you can paste this link into your browser:

[URL]

Please note that this link is only active for [Token_Valid_Hours] hours after receipt. After this time limit has expired the token will not work and you will need to resubmit the password reset request.

Thank you!',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'UM::EMAIL_SEND_MESSAGE',
					'sm_notification_name' => 'U/M Email Send Messsage',
					'sm_notification_subject' => '',
					'sm_notification_body' => '',
					'sm_notification_inactive' => 0
				]
			]
		],
	];
}