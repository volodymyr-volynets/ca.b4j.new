<?php

namespace Numbers\Users\News\Controller;
class Categories extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\News\Form\List2\Categories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\News\Form\Categories([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\News\Form\Categories',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}