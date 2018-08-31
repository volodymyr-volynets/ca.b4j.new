<?php

namespace Helper;
class Notifications {

	/**
	 * Send confirm email
	 *
	 * @param int $register_id
	 */
	public static function sendConfirmEmailMessage(int $register_id) {
		// load unconfirmed registration
		$temp = \Model\Register::getStatic([
			'columns' => [
				'b4_register_parents_email',
				'b4_register_parents_name'
			],
			'where' => [
				'b4_register_id' => $register_id,
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
					'[URL]' => \Application::get('mvc.full_with_host') . '?__wizard_step=5&token=' . $crypt->tokenCreate($register_id, 'registration.b4j'),
					'[Token_Valid_Hours]' => $crypt->object->valid_hours
				]
			]
		]);
	}

	/**
	 * Child is accepted email
	 *
	 * @param int $registration_id
	 */
	public static function sendChildAccpetedMessage(int $registration_id) {
		// load registration
		$temp = \Model\Registrations::getStatic([
			'columns' => [
				'b4_registration_email',
				'b4_registration_parents_name',
				'b4_registration_child_name'
			],
			'where' => [
				'b4_registration_id' => $registration_id,
			],
			'pk' => null
		]);
		if (empty($temp)) {
			return ['success' => false, 'error' => \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED];
		}
		// send email message
		return \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('B4::EMAIL_REG_ACCEPTED', 0, $temp[0]['b4_registration_email'], [
			'replace' => [
				'body' => [
					'[Name]' => $temp[0]['b4_registration_parents_name'],
					'[Child]' => $temp[0]['b4_registration_child_name'],
				]
			]
		]);
	}

	/**
	 * Need medical
	 *
	 * @param int $registration_id
	 */
	public static function sendNeedMedicalMessage(int $registration_id) {
		// load registration
		$temp = \Model\Registrations::getStatic([
			'columns' => [
				'b4_registration_email',
				'b4_registration_parents_name',
				'b4_registration_child_name'
			],
			'where' => [
				'b4_registration_id' => $registration_id,
			],
			'pk' => null
		]);
		if (empty($temp)) {
			return ['success' => false, 'error' => \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED];
		}
		// send email message
		$crypt = new \Crypt();
		return \Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('B4::EMAIL_NEED_MEDICAL', 0, $temp[0]['b4_registration_email'], [
			'replace' => [
				'body' => [
					'[Name]' => $temp[0]['b4_registration_parents_name'],
					'[Child]' => $temp[0]['b4_registration_child_name'],
					'[URL]' => \Request::host() . 'B4J/Register/_Medical' . '?__wizard_step=1&token=' . $crypt->tokenCreate($registration_id, 'medical.b4j'),
					'[Token_Valid_Hours]' => \Application::get('application.b4j.need_medical_token_valid') ?? 48,
				]
			]
		]);
	}
}