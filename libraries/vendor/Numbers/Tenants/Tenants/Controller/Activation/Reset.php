<?php

namespace Numbers\Tenants\Tenants\Controller\Activation;
class Reset extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Tenants\Form\Activation\Reset([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}