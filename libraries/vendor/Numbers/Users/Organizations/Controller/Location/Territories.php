<?php

namespace Numbers\Users\Organizations\Controller\Location;
class Territories extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Organizations\Form\List2\Location\Territories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\Location\Territories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Organizations\Form\Location\Territories',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}