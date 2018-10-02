<?php

namespace Controller\B4J;
class CounselorsRegister extends \Object\Controller {
	public function actionIndex() {
		$form = new \Form\CounselorsRegister([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionSuccess() {
		$options = [
			'type' => 'success',
			'options' => [
				i18n(null, 'Congratulations! You have successfully completed counselors registration.'),
				i18n(null, 'Registration(s) #: [id]', ['replace' => ['[id]' => \Session::get('b4j.last_b4_counselor_id')]]),
				i18n(null, "Any questions? [phone] or <a href=\"mailto:[email]\">[email]</a>", ['replace' => ['[phone]' => registry('b4j.contact.phone'), '[email]' => registry('b4j.contact.email')]])
			]
		];
		echo \HTML::message($options);
	}
}