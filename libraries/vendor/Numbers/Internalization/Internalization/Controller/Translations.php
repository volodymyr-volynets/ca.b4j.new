<?php

namespace Numbers\Internalization\Internalization\Controller;
class Translations extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Internalization\Internalization\Form\List2\Translations([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Internalization\Internalization\Form\Translations([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Internalization\Internalization\Form\Translations',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}