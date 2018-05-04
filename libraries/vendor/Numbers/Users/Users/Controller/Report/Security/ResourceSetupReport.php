<?php

namespace Numbers\Users\Users\Controller\Report\Security;
class ResourceSetupReport extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Report\Security\ResourceSetupReport([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}