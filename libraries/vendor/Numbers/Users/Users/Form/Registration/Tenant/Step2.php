<?php

namespace Numbers\Users\Users\Form\Registration\Tenant;
class Step2 {

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$input = \Request::input();
		$options = [
			'type' => 'success',
			'options' => [
				i18n(null, 'Please check [email] and click the link provided to confirm your registration.', [
					'replace' => [
						'[email]' => $input['email'] ?? i18n(null, 'your email')
					]
				]),
				i18n(null, 'If you did not receive the email, please check your junk/spam mailbox.')
			]
		];
		return \HTML::message($options);
	}
}