<?php

namespace Numbers\Tenants\Tenants\Controller;
class Assignments extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Tenants\Form\List2\Assingments([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Tenants\Tenants\Form\Assignments([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Tenants\Tenants\Form\Assignments',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}