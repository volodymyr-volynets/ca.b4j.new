<?php

namespace Numbers\Internalization\Internalization\Controller\Language;
class Codes extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Internalization\Internalization\Form\List2\Language\Codes([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Internalization\Internalization\Form\Language\Codes([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Internalization\Internalization\Form\Language\Codes',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}