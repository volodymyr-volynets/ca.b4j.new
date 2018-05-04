<?php

namespace Numbers\Countries\Currencies\Controller;
class Types extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Countries\Currencies\Form\List2\Types([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Countries\Currencies\Form\Types([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Countries\Currencies\Form\Types',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}