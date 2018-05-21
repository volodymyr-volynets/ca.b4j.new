<?php

namespace Controller\B4J;
class Register extends \Object\Controller {
	public function actionIndex() {
		$form = new \Form\Register\Collection([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}