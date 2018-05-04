<?php

namespace Numbers\Users\Users\Controller\System;
class Senders extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Users\Form\System\Senders([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}