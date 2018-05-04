<?php

namespace Numbers\Users\Organizations\Controller;
class LegalAuthorities extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Organizations\Form\List2\LegalAuthorities([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\LegalAuthorities([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Organizations\Form\LegalAuthorities',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}