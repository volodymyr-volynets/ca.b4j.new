<?php

namespace Controller\B4J;
class CounselorsRegister extends \Object\Controller {
	public function actionIndex() {
		$form = new \Form\CounselorsRegister([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}