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
				\HTML::a(['href' => \Application::get('mvc.full') . '?__wizard_step=1', 'value' => i18n(null, 'Click here to register new child!')])
			]
		];
		return \HTML::message($options);
	}
}