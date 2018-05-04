<?php

namespace Numbers\Users\Users\Controller;
class Login extends \Object\Controller\Public2 {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Login([
			'input' => \Request::input(),
			'no_ajax_form_reload' => true
		]);
		echo $form->render();
	}
}