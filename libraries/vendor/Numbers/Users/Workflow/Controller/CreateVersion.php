<?php

namespace Numbers\Users\Workflow\Controller;
class CreateVersion extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Workflow\Form\CreateVersion([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}