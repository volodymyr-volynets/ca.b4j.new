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
				[
					'sm_feature_module_code' => 'B4',
					'sm_feature_code' => 'B4::EMAIL_ON_WAITING_LIST',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'B/J Email On Waiting List',
					'sm_feature_icon' => 'far fa-envelope',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0
				],
				[
					'sm_feature_module_code' => 'B4',
					'sm_feature_code' => 'B4::EMAIL_COUNCELLOR_REGISTERED',
					'sm_feature_type' => 21,
					'sm_feature_name' => 'B/J Email Counsellor Registered',
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
					'sm_notification_subject' => 'Break For Jesus: Camp Registration Email Confirmation',
					'sm_notification_body' => 'Dear [Name],

Thank you for completing the registration.  Please confirm your email asap, if you DO NOT confirm your email address, the registration will NOT be submitted.
 
Once your child/ren have been selected, you will receive an email with additional information by [Additional_Information_Date].

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

Thank you for registering your child/ren for Break for Jesus March Break Camp.

[Child] has/ve been ACCEPTED to camp!

<a href="[URL]" target="_parent">Click here</a> to continue the registration process and provide Medical, Emergency Contact and T-shirt order and send in your payment by December 2nd, 2018. Cheques need to be made out to Break for Jesus. PLEASE NO POST-DATED CHEQUES.

Or paste this into a browser:

[URL]

Please note that this link is only active until November 25th.

Cost for 1 camper: $375
Cost for 2 campers: $645
Cost for 3 campers: $1,015

Please mail your cheques to
	Break for Jesus
	c/o 6 Upminister Cres
	Toronto, On M9B 5W2

If ALL the necessary forms and payment are NOT received by December 2nd, 2018 your registration will be withdrawn and the spot will be given to another camper on the waiting list.

If you have any concerns or challenges with the payment please contact [Support Name] at [Support Phone].

B4J Administration',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'B4::EMAIL_ON_WAITING_LIST',
					'sm_notification_name' => 'B/J Email On Waiting List',
					'sm_notification_subject' => 'Break For Jesus: Your Child Is On Waiting List',
					'sm_notification_body' => 'Dear [Name],

We have placed [Child] on a WAITLIST because we have reached maximum capacity for the camp.

If you would like your child to remain on the wait list, please fill out the following online <a href="[URL]" target="_parent">MEDICAL FORM and T-shirt order</a>.

If a spot becomes available, you will be contacted immediately.

B4J Administration',
					'sm_notification_inactive' => 0
				],
				[
					'sm_notification_code' => 'B4::EMAIL_COUNCELLOR_REGISTERED',
					'sm_notification_name' => 'B/J Email Counsellor Registered',
					'sm_notification_subject' => 'Break For Jesus: Your Counsellor Registration Has Been Received',
					'sm_notification_body' => 'Dear [Name],

We have received your counsellor registration, your registration number is [Registration_ID].

B4J Administration',
					'sm_notification_inactive' => 0
				],
			]
		],
	];
}