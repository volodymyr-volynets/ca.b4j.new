<?php

namespace Numbers\Users\Users\Controller\Registration;
class Tenant extends \Object\Controller {
	public function actionIndex() {
		if (!\Application::get('debug.toolbar')) {
			Throw new \Exception('You must enabled toolbar to view Dev. Portal.');
		}
		$form = new \Numbers\Users\Users\Form\Registration\Tenant\Collection([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}