<?php

namespace Numbers\Users\Users\Form\Password;
class Set extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_password_set';
	public $module_code = 'UM';
	public $title = 'U/M Password Set Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'fas fa-asterisk'],
				'title' => 'Set Password:'
			]
		]
	];
	public $containers = [
		'default' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'default' => [
			'password' => [
				'password' => ['order' => 1, 'row_order' => 100, 'label_name' => 'New Password', 'domain' => 'password', 'method' => 'password', 'percent' => 50, 'required' => true, 'autofocus' => true, 'empty_value' => true],
			],
			'password2' => [
				'password2' => ['order' => 1, 'row_order' => 200, 'label_name' => 'New Password (Repeat)', 'domain' => 'password', 'method' => 'password', 'percent' => 50, 'required' => true, 'empty_value' => true],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
				'login' => ['order' => 99, 'button_group' => 'left', 'href' => '/Numbers/Users/Users/Controller/Login', 'value' => 'Sign In', 'method' => 'a']
			],
			self::HIDDEN => [
				'token' => ['label_name' => 'Token', 'type' => 'text']
			]
		]
	];

	public $data_user_id;

	public function refresh(& $form) {
		$token = $form->options['input']['token'] ?? null;
		$token_error_message = 'Password reset token is not valid or expired!';
		if (empty($token)) {
			$form->error(DANGER, $token_error_message);
		} else {
			$crypt = new \Crypt();
			$token_data = $crypt->tokenValidate($token);
			if ($token_data === false || $token_data['token'] != 'password.reset') {
				$form->error(DANGER, $token_error_message);
			} else {
				$this->data_user_id = (int) $token_data['id'];
			}
		}
	}

	public function validate(& $form) {
		if ($form->values['password'] != $form->values['password2']) {
			$form->error('danger', 'Passwords do not match!', 'password');
			$form->error('danger', 'Passwords do not match!', 'password2');
		}
	}

	public function save(& $form) {
		$crypt = new \Crypt();
		$result = \Numbers\Users\Users\Model\Users::collectionStatic()->merge([
			'um_user_id' => $this->data_user_id,
			'um_user_login_password' => $crypt->passwordHash($form->values['password'])
		],
		[
			'skip_optimistic_lock' => true
		]);
		if ($result['success']) {
			// send email notification
			\Numbers\Users\Users\Helper\User\Notifications::sendPasswordChangeEmail($this->data_user_id);
			// blank fields
			$form->values['password'] = '';
			$form->values['password2'] = '';
			$form->values['token'] = '';
			$form->error(SUCCESS, 'Password changed!');
		} else {
			$form->error(DANGER, 'Could not update password!');
		}
		return true;
	}
}