<?php

namespace Numbers\Users\Organizations\Controller\Task\Workflow;
class Alarms extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\Task\Workflow\Alarms([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}