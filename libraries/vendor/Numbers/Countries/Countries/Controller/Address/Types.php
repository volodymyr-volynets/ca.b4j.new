<?php

namespace Numbers\Countries\Countries\Controller\Address;
class Types extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Countries\Countries\Form\List2\Address\Types([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Countries\Countries\Form\Address\Types([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Countries\Countries\Form\Address\Types',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}