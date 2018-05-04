<?php

namespace Numbers\Users\Organizations\Controller\Workflow;
class CreateVersion extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\Service\Workflow\CreateVersion([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}