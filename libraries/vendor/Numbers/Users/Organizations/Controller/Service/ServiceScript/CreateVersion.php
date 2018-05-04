<?php

namespace Numbers\Users\Organizations\Controller\Service\ServiceScript;
class CreateVersion extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\Service\ServiceScript\CreateVersion([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}