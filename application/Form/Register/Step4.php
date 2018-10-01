<?php

namespace Form\Register;
class Step4 {

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$input = \Request::input();
		$result = '';
		// resend email if user asks
		if (!empty($input['resend_email'])) {
			$temp = \Helper\Notifications::sendConfirmEmailMessage((int) $input['b4_register_id']);
			if ($temp['success']) {
				$result.= \HTML::message([
					'type' => SUCCESS,
					'options' => [
						i18n(null, \Object\Content\Messages::EMAIL_RESENT),
					]
				]);
			} else {
				$result.= \HTML::message([
					'type' => DANGER,
					'options' => [
						i18n(null, $temp['error']),
					]
				]);
			}
		}
		$options = [
			'type' => WARNING,
			'options' => [
				i18n(null, 'We sent a link to confirm your registration to email address you provided. Please click on the link in email.'),
				i18n(null, 'Please check Spam folder if you have not received the automated email.'),
				i18n(null, 'You can also resend the automated email by <a href="[url]">clicking here</a>.', ['replace' => ['[url]' => \Application::get('mvc.full') . '?__wizard_step=4&b4_register_id=' . $input['b4_register_id'] . '&resend_email=1']]),
			]
		];
		$result.= \HTML::message($options);
		return $result;
	}
}