<?php

namespace Numbers\Tenants\Tenants\Controller\Activation;
class ResetModule extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Tenants\Form\Activation\ResetModule([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}