<?php

namespace Numbers\Users\Users\Controller;
class Logout extends \Object\Controller\Authorized {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Logout([
			'input' => \Request::input(),
			'no_ajax_form_reload' => true
		]);
		echo $form->render();
	}
}