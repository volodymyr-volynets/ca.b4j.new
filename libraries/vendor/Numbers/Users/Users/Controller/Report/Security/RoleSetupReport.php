<?php

namespace Numbers\Users\Users\Controller\Report\Security;
class RoleSetupReport extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Report\Security\RoleSetupReport([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}