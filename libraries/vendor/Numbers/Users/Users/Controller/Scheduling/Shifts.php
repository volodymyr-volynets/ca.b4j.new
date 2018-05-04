<?php

namespace Numbers\Users\Users\Controller\Scheduling;
class Shifts extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\List2\Scheduling\Shifts([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Users\Form\Scheduling\Shifts([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Users\Form\Scheduling\Shifts',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}