<?php

namespace Numbers\Tenants\Tenants\Controller\Activation;
class Features extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Tenants\Form\Activation\List2\Features([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Tenants\Tenants\Form\Activation\Features([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}