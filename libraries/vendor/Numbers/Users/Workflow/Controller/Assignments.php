<?php

namespace Numbers\Users\Workflow\Controller;
class Assignments extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Workflow\Form\List2\Assignments([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Workflow\Form\Assignments([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Workflow\Form\Assignments',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}