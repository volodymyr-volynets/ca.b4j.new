<?php

namespace Numbers\Users\APIs\Controller;
class Roles extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\APIs\Form\List2\Roles([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\APIs\Form\Roles([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\APIs\Form\Roles',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}