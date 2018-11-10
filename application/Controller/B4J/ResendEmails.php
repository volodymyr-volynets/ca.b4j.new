<?php

namespace Controller\B4J;
class ResendEmails extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Form\ResendEmails([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}