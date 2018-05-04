<?php

namespace Numbers\Tenants\Widgets\Attributes\Controller;
class Attributes extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Widgets\Attributes\Form\List2\Attributes([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Tenants\Widgets\Attributes\Form\Attributes([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}