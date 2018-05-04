<?php

namespace Numbers\Users\Users\Form\Registration\Tenant;
class Step1 extends \Object\Form\Wrapper\Base {
	public $form_link = 'tenant_registration_step1';
	public $module_code = 'UM';
	public $title = 'U/M Registration Tenant Step1 Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'pencil-square-o'],
				'title' => 'Register New Tenant:'
			]
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'default' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'default' => [
			'um_regten_tenant_name' => [
				'um_regten_tenant_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Tenant Name', 'domain' => 'name', 'percent' => 50, 'required' => true, 'autofocus' => true],
				'um_regten_tenant_code' => ['order' => 2, 'label_name' => 'Domain Name', 'domain' => 'domain_part', 'percent' => 50, 'required' => true, 'validator_method' => '\Object\Validator\UpperCase2::validate'],
			],
			'um_regten_tenant_email' => [
				'um_regten_tenant_email' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Email', 'domain' => 'email', 'percent' => 50, 'required' => true],
				'um_regten_tenant_phone' => ['order' => 2, 'label_name' => 'Phone', 'domain' => 'phone', 'percent' => 50]
			],
			'separator_1' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 300, 'label_name' => 'Organization', 'icon' => 'fas fa-sitemap', 'percent' => 100],
			],
			'on_organization_name' => [
				'um_regten_organization_name' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Organization Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'um_regten_organization_code' => ['order' => 2, 'label_name' => 'Organization Code', 'domain' => 'group_code', 'percent' => 50, 'required' => true],
			],
			'separator_2' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 500, 'label_name' => 'Administrator', 'icon' => 'fas fa-user', 'percent' => 100],
			],
			'um_regten_user_first_name' => [
				'um_regten_user_first_name' => ['order' => 1, 'row_order' => 600, 'label_name' => 'First Name', 'domain' => 'personal_name', 'percent' => 50, 'required' => true],
				'um_regten_user_last_name' => ['order' => 2, 'label_name' => 'Last Name', 'domain' => 'personal_name', 'percent' => 50, 'required' => true]
			],
			'um_regten_user_email' => [
				'um_regten_user_email' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Email', 'domain' => 'email', 'percent' => 50, 'required' => true],
				'um_regten_user_login_username' => ['order' => 2, 'label_name' => 'Username', 'domain' => 'login', 'percent' => 50, 'null' => true]
			],
			'um_regten_user_phone' => [
				'um_regten_user_phone' => ['order' => 1, 'row_order' => 800, 'label_name' => 'Phone', 'domain' => 'phone', 'percent' => 50],
				'um_regten_user_cell' => ['order' => 2, 'label_name' => 'Cell', 'domain' => 'phone', 'percent' => 50]
			],
			'captcha' => [
				'captcha' => ['order' => 1, 'row_order' => 900, 'label_name' => 'Security Question', 'type' => 'text', 'required' => true, 'percent' => 50, 'method' => 'captcha', 'empty_value' => true],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function validate(& $form) {
		if (!empty($form->values['um_regten_tenant_code'])) {
			$tenant_result = \Numbers\Tenants\Tenants\Model\Tenants::getStatic([
				'where' => [
					'tm_tenant_code' => $form->values['um_regten_tenant_code']
				],
				'single_row' => true,
				'no_cache' => true
			]);
			if (!empty($tenant_result)) {
				$form->error('danger', 'This domain name is already taken!', 'um_regten_tenant_code');
			}
		}
	}

	public function save(& $form) {
		// save the record
		$form->values['um_regten_inserted'] = \Format::now('timestamp');
		$result = \Numbers\Users\Users\Model\Registration\Tenants::collectionStatic()->merge($form->values);
		if (!$result['success']) {
			$form->error('danger', 'Registration error, please try again later!');
			return false;
		} else {
			// send email message
			$crypt = new \Crypt();
			$mail_result = \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('UM::EMAIL_TENANT_CONFIRMATION', 0, $form->values['um_regten_user_email'], [
				'replace' => [
					'body' => [
						'[URL]' => \Application::get('mvc.full_with_host') . '?__wizard_step=3&token=' . $crypt->tokenCreate($result['new_serials']['um_regten_id'], 'registration.tenant'),
						'[Token_Valid_Hours]' => $crypt->object->valid_hours
					]
				]
			]);
			if (!$mail_result['success']) {
				$form->error('danger', 'Registration error, please try again later!');
				return false;
			}
			$mask = new \Object\Mask\Email();
			\Request::redirect(\Application::get('mvc.full') . '?__wizard_step=2&email=' . $mask->mask($form->values['um_regten_user_email']));
		}
		return false;
	}
}