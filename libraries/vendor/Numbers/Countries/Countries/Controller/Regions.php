<?php

namespace Numbers\Countries\Countries\Controller;
class Regions extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Countries\Countries\Form\List2\Regions([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Countries\Countries\Form\Regions([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Countries\Countries\Form\Regions',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}