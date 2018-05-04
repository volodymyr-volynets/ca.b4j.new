<?php

namespace Numbers\Users\Documents\Base\Controller;
class Catalogs extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Documents\Base\Form\List2\Catalogs([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Documents\Base\Form\Catalogs([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Documents\Base\Form\Catalogs',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}