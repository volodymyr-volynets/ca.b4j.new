<?php

namespace Numbers\Users\Users\Controller\Report\Security;
class RoleAssignmentReport extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Report\Security\RoleAssignmentReport([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}