<?php

namespace Controller\B4J;
class Periods extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Form\List2\Periods([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Form\Periods([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Form\Periods',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}