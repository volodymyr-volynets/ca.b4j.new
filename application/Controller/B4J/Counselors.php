<?php

namespace Controller\B4J;
class Counselors extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Form\List2\Counselors([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Form\Counselors([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Form\Counselors',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}