<?php

namespace Numbers\Internalization\Internalization\Controller;
class Missing extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Internalization\Internalization\Form\List2\Missing([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Internalization\Internalization\Form\Missing([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}