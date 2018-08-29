<?php

namespace Form\Register;
class Step5 {

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$input = \Request::input();
		$result = '';
		$error = false;
		if (!empty($input['token'])) {
			$crypt = new \Crypt();
			$token_data = $crypt->tokenValidate($input['token']);
			if ($token_data === false || $token_data['token'] != 'registration.b4j') {
				$error = \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED;
			}
		} else {
			$error = \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED;
		}
		// if no errors we register
		if (empty($error)) {
			$complete = \Helper\Register\Finish::complete($token_data['id']);
			if (!$complete['success']) {
				$error = $complete['error'];
			}
		}
		if (!empty($error)) {
			$result.= \HTML::message([
				'type' => DANGER,
				'options' => [
					i18n(null, $error),
				]
			]);
		} else {
			$options = [
				'type' => 'success',
				'options' => [
					i18n(null, 'Congratulations! You have successfully completed registration.'),
					i18n(null, 'Registration(s) #: [id]', ['replace' => ['[id]' => \Format::id($complete['registration_id'])]]),
					i18n(null, "MAKE CHEQUE PAYABLE TO: Break for Jesus, c/o 6 Upminster Cres., Toronto ON, M9B 5W2"),
					i18n(null, "Any questions?  416-695-2076 or <a href=\"mailto:b4j@gmx.com\">b4j@gmx.com</a>")
				]
			];
			$result.= \HTML::message($options);
		}
		return $result;
	}
}