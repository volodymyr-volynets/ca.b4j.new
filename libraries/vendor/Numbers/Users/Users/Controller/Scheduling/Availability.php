<?php

namespace Numbers\Users\Users\Controller\Scheduling;
class Availability extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Users\Form\Scheduling\Availability([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}