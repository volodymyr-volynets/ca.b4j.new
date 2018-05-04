<?php

namespace Numbers\Users\Users\Helper\User;
class Notifications {

	/**
	 * Send password change email
	 *
	 * @param int $user_id
	 */
	public static function sendPasswordChangeEmail(int $user_id) {
		return \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('UM::EMAIL_PASSWORD_CHANGED', $user_id, '', [
			'replace' => [
				'body' => [
					'[Name]' => null,
					'[Email]' => null,
					'[Password_Reset_Url]' => \Request::host() . 'Numbers/Users/Users/Controller/Password/Reset'
				]
			]
		]);
	}

	/**
	 * Send password reset email
	 *
	 * @param int $user_id
	 */
	public static function sendPasswordResetEmail(int $user_id) {
		$crypt = new \Crypt();
		return \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('UM::EMAIL_RESET_PASSWORD', $user_id, '', [
			'replace' => [
				'body' => [
					'[Name]' => null,
					'[URL]' => \Request::host() . 'Numbers/Users/Users/Controller/Password/Reset/_SetPassword?token=' . $crypt->tokenCreate($user_id, 'password.reset'),
					'[Token_Valid_Hours]' => $crypt->object->valid_hours
				]
			]
		]);
	}
}