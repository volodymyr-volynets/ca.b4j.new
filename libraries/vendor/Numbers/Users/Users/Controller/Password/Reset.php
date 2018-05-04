<?php

namespace Numbers\Users\Users\Controller\Password;
class Reset extends \Object\Controller {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Password\Reset([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionSetPassword() {
		$form = new \Numbers\Users\Users\Form\Password\Set([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}