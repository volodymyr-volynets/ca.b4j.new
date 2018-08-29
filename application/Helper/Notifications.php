<?php

namespace Helper;
class Notifications {

	/**
	 * Send password change email
	 *
	 * @param int $user_id
	 */
	public static function sendConfirmEmailMessage(int $registration_id) {
		// load unconfirmed registrations
		$temp = \Model\Register::getStatic([
			'where' => [
				'b4_register_id' => $registration_id,
				'b4_register_status_id' => 10
			],
			'pk' => null
		]);
		if (empty($temp)) {
			return ['success' => false, 'error' => \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED];
		}
		// send email message
		$crypt = new \Crypt();
		return \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('B4::EMAIL_REG_CONFIRMATION', 0, $temp[0]['b4_register_parents_email'], [
			'replace' => [
				'body' => [
					'[Name]' => $temp[0]['b4_register_parents_name'],
					'[URL]' => \Application::get('mvc.full_with_host') . '?__wizard_step=5&token=' . $crypt->tokenCreate($registration_id, 'registration.b4j'),
					'[Token_Valid_Hours]' => $crypt->object->valid_hours
				]
			]
		]);
	}
}