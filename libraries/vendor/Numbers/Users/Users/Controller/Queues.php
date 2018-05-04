<?php

namespace Numbers\Users\Users\Controller;
class Queues extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\List2\Queues([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}