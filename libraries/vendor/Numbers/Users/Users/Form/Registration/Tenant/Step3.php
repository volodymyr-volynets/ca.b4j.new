<?php

namespace Numbers\Users\Users\Form\Registration\Tenant;
class Step3 extends \Object\Form\Wrapper\Base {
	public $form_link = 'tenant_registration_step3';
	public $module_code = 'UM';
	public $title = 'U/M Registration Tenant Step3 Form';
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
			'separator_2' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 50, 'label_name' => 'Set Administrator\'s Password', 'icon' => 'fas fa-user', 'percent' => 100],
			],
			'um_user_login_password' => [
				'um_user_login_password' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Password', 'domain' => 'password', 'method' => 'password', 'percent' => 50, 'required' => true, 'autofocus' => true, 'empty_value' => true],
			],
			'um_user_login_password2' => [
				'um_user_login_password2' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Password (Repeat)', 'domain' => 'password', 'method' => 'password', 'percent' => 50, 'required' => true, 'empty_value' => true],
			],
			'captcha' => [
				'captcha' => ['order' => 1, 'row_order' => 900, 'label_name' => 'Security Question', 'type' => 'text', 'required' => true, 'percent' => 50, 'method' => 'captcha', 'empty_value' => true],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public $tenant_registration_data;

	public function refresh(& $form) {
		$token = $form->options['input']['token'] ?? null;
		$token_error_message = 'Registration token is not valid or expired!';
		if (empty($token)) {
			$form->error('danger', $token_error_message);
		} else {
			$crypt = new \Crypt();
			$token_data = $crypt->tokenValidate($token);
			if ($token_data === false || $token_data['token'] != 'registration.tenant') {
				$form->error('danger', $token_error_message);
			} else {
				$tenant_registration_model = new \Numbers\Users\Users\Model\Registration\Tenants();
				$tenant_registration_data = $tenant_registration_model->get([
					'where' => [
						'um_regten_id' => (int) $token_data['id'],
						'um_regten_status' => 0
					],
					'single_row' => true
				]);
				if (empty($tenant_registration_data)) {
					$form->error('danger', $token_error_message);
				} else {
					$this->tenant_registration_data = $tenant_registration_data;
				}
			}
		}
	}

	public function validate(& $form) {
		if ($form->values['um_user_login_password'] != $form->values['um_user_login_password2']) {
			$form->error('danger', 'Passwords do not match!', 'um_user_login_password');
			$form->error('danger', 'Passwords do not match!', 'um_user_login_password2');
		}
	}

	public function save(& $form) {
		$error_message = 'Registration error, please try again later!';
		do {
			$tenant_model = new \Numbers\Tenants\Tenants\Model\Tenants();
			$tenant_model->db_object->begin();
			// step 1 create a tenant
			$tenant_result = $tenant_model->collection()->merge([
				'tm_tenant_code' => $this->tenant_registration_data['um_regten_tenant_code'],
				'tm_tenant_name' => $this->tenant_registration_data['um_regten_tenant_name'],
				'tm_tenant_email' => $this->tenant_registration_data['um_regten_tenant_email'],
				'tm_tenant_phone' => $this->tenant_registration_data['um_regten_tenant_phone'],
			]);
			if (!$tenant_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			// use new tenant
			$tenant_id = $tenant_result['new_serials']['tm_tenant_id'];
			\Tenant::setOverrideTenantId($tenant_id);
			// step 2 create organization
			$organization_result = \Numbers\Users\Organizations\Model\Organizations::collectionStatic()->merge([
				'on_organization_code' => $this->tenant_registration_data['um_regten_organization_code'],
				'on_organization_name' => $this->tenant_registration_data['um_regten_organization_name'],
			]);
			if (!$organization_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			$organization_id = $organization_result['new_serials']['on_organization_id'];
			// step 3 import tenant related settings
			$activation_model = new \Numbers\Users\Users\Data\Activation\Tenant();
			$activation_result = $activation_model->process();
			if (!$activation_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			// step 4 create a user
			$crypt = new \Crypt();
			$user_result = \Numbers\Users\Users\Model\Users::collectionStatic()->merge([
				'um_user_code' => null,
				'um_user_type_id' => 10,
				'um_user_name' => $this->tenant_registration_data['um_regten_user_first_name'] . ' ' . $this->tenant_registration_data['um_regten_user_last_name'],
				'um_user_first_name' => $this->tenant_registration_data['um_regten_user_first_name'],
				'um_user_last_name' => $this->tenant_registration_data['um_regten_user_last_name'],
				'um_user_email' => $this->tenant_registration_data['um_regten_user_email'],
				'um_user_phone' => $this->tenant_registration_data['um_regten_user_phone'],
				'um_user_cell' => $this->tenant_registration_data['um_regten_user_cell'],
				'um_user_login_enabled' => 1,
				'um_user_login_username' => $this->tenant_registration_data['um_regten_user_login_username'],
				'um_user_login_password' => $crypt->passwordHash($form->values['um_user_login_password']),
				'um_user_login_date_password_last_set' => \Format::now('date'),
			]);
			if (!$user_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			$user_id = $user_result['new_serials']['um_user_id'];
			// step 5 assign user to organization
			$assignment_result = \Numbers\Users\Users\Model\User\Organizations::collectionStatic()->merge([
				'um_usrorg_user_id' => $user_id,
				'um_usrorg_organization_id' => $organization_id,
				'um_usrorg_primary' => 1
			]);
			if (!$assignment_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			// step 6 provision role to user
			$assignment_result = \Numbers\Users\Users\Model\User\Roles::collectionStatic()->merge([
				'um_usrrol_user_id' => $user_id,
				'um_usrrol_role_id' => \Numbers\Users\Users\Model\Roles::getByColumnStatic('um_role_code', 'SA', 'um_role_id')
			]);
			if (!$assignment_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			// step 7 update registration status
			$registration_result = \Numbers\Users\Users\Model\Registration\Tenants::collectionStatic()->merge([
				'um_regten_id' => $this->tenant_registration_data['um_regten_id'],
				'um_regten_status' => 1
			]);
			if (!$registration_result['success']) {
				$form->error('danger', $error_message);
				break;
			}
			// step 8 activate tenants, organizations, users modules and other modules
			foreach (['SM', 'AN', 'TM', 'ON', 'CM', 'IN', 'UM'] as $v) {
				$module_activation_result = \Numbers\Tenants\Tenants\Model\Activation::activateModule($v, null);
				if (!$module_activation_result['success']) {
					$form->error('danger', $error_message);
					goto error;
				}
			}
			// use old tenant
			\Tenant::setOverrideTenantId(null);
			$tenant_model->db_object->commit();
			// regirect to success step
			$domain_level = (int) \Application::get('application.structure.tenant_domain_level');
			if ($domain_level) {
				$host_parts = \Request::hostParts();
				$host_parts[$domain_level] = $this->tenant_registration_data['um_regten_tenant_code'];
				krsort($host_parts);
				$url = \Request::host(['host_parts' => $host_parts]) . 'Numbers/Users/Users/Controller/Login';
			} else {
				$url = '/Numbers/Users/Users/Controller/Login';
			}
			\Request::redirect(\Application::get('mvc.full') . '?__wizard_step=4&url=' . $url);
		} while(0);
error:
		return false;
	}
}