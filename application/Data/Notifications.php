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

Thank you for registering your child/ren for Break 4 Jesus March Break Camp.

Your child [Child] has been ACCEPTED to camp!

Cheques need to be made out to be Break for Jesus. PLEASE NO POST-DATED CHEQUES.

Please mail your cheques to
	Break for Jesus
	c/o 6 Upminister Cres
	Toronto, On M9B 5W2

If you have any concerns or challenges please contact [Support Name] at [Support Phone] by November 25.

If ALL the necessary forms and payment is NOT completed - the spot will be given to another camper.

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
				[
					'sm_notification_code' => 'B4::EMAIL_ON_WAITING_LIST',
					'sm_notification_name' => 'B/J Email On Waiting List',
					'sm_notification_subject' => 'Break For Jesus: Your Child Is On Waiting List',
					'sm_notification_body' => 'Dear [Name],

At this time the camp is FULL, unfortunately [Child] NOT been selected for camp.

We have placed your child’s name on a WAITLIST. If you would like your child to remain on the wait list, please fill out the following online MEDICAL FORM and T-shirt order. If a spot becomes available, you will be contacted.

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