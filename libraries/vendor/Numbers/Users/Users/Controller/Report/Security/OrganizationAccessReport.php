<?php

namespace Numbers\Users\Users\Controller\Report\Security;
class OrganizationAccessReport extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Report\Security\OrganizationAccessReport([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}