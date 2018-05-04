<?php

namespace Numbers\Countries\Currencies\Controller;
class Currencies extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Countries\Currencies\Form\List2\Currencies([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Countries\Currencies\Form\Currencies([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Countries\Currencies\Form\Currencies',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}