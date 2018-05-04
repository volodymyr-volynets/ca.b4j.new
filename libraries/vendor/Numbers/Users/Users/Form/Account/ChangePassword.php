<?php

namespace Numbers\Users\Users\Form\Account;
class ChangePassword extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_change_password';
	public $module_code = 'UM';
	public $title = 'U/M Account Change Password Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'fas fa-asterisk'],
				'title' => 'Change Password:'
			]
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'login' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'login' => [
			'old_password' => [
				'old_password' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Old Password', 'type' => 'text', 'percent' => 50, 'method' => 'password', 'required' => true, 'autofocus' => true]
			],
			'new_password' => [
				'new_password' => ['order' => 1, 'row_order' => 200, 'label_name' => 'New Password', 'domain' => 'password', 'percent' => 50, 'method' => 'password', 'required' => true]
			],
			'new_password2' => [
				'new_password2' => ['order' => 1, 'row_order' => 300, 'label_name' => 'New Password (Repeat)', 'domain' => 'password', 'percent' => 50, 'method' => 'password', 'required' => true]
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function validate(& $form) {
		if (!$form->hasErrors()) {
			if ($form->values['new_password'] != $form->values['new_password2']) {
				$form->error(DANGER, 'Passwords do not match!', 'new_password');
				$form->error(DANGER, 'Passwords do not match!', 'new_password2');
			}
			// validate old password
			$datasource = new \Numbers\Users\Users\DataSource\User\Password();
			$user = $datasource->get(['where' => ['user_id' => \User::id()]]);
			if (empty($user)) {
				$form->error(DANGER, 'Invalid user!', 'old_password');
			} else {
				// validate password
				$crypt = new \Crypt();
				if (!$crypt->passwordVerify($form->values['old_password'], $user['um_user_login_password'])) {
					$form->error(DANGER, 'Invalid password!', 'old_password');
				}
			}
		}
	}
	public function save(& $form) {
		$crypt = new \Crypt();
		$result = \Numbers\Users\Users\Model\Users::collectionStatic()->merge([
			'um_user_id' => \User::id(),
			'um_user_login_password' => $crypt->passwordHash($form->values['new_password']),
			'um_user_login_last_set' => \Format::now('date')
		],
		[
			'skip_optimistic_lock' => true
		]);
		if ($result['success']) {
			// send email notification
			\Numbers\Users\Users\Helper\User\Notifications::sendPasswordChangeEmail(\User::id());
			// blank fields
			$form->values['new_password'] = '';
			$form->values['new_password2'] = '';
			$form->values['old_password'] = '';
			$form->error(SUCCESS, 'Password changed!');
			// update sessions
			if (!empty($_SESSION['numbers']['force']['password_reset'])) {
				unset($_SESSION['numbers']['force']['password_reset']);
			}
		} else {
			$form->error(DANGER, 'Could not update password!');
		}
		return true;
	}
}