<?php

namespace Numbers\Tenants\Tenants\Controller\Policy;
class Folders extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Tenants\Tenants\Form\Policy\Folders([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}