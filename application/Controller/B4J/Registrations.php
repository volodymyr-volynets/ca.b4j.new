<?php

namespace Controller\B4J;
class Registrations extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Form\List2\Registrations([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Form\Registrations([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Form\Registrations',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}