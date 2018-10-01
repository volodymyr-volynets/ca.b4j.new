<?php

namespace Numbers\Tenants\Tenants\Controller\Activation;
class ResetFeature extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Tenants\Tenants\Form\Activation\ResetFeature([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}