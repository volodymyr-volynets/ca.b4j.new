<?php

namespace Form\Register;
class Step6 {

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
				i18n(null, 'Congratulations! You have successfully completed registration.'),
				i18n(null, 'Registration #: [id]', ['replace' => ['[id]' => \Format::id($input['b4_registration_id'])]]),
				\HTML::a(['href' => \Application::get('mvc.full') . '?__wizard_step=1', 'value' => i18n(null, 'Click here to register new child!')]),
				i18n(null, "MAKE CHEQUE PAYABLE TO: Break for Jesus, c/o 6 Upminster Cres., Toronto ON, M9B 5W2"),
				i18n(null, "Any questions?  416-695-2076 or <a href=\"mailto:b4j@gmx.com\">b4j@gmx.com</a>")
			]
		];
		return \HTML::message($options);
	}
}