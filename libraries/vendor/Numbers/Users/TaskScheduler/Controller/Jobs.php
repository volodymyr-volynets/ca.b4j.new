<?php

namespace Numbers\Users\TaskScheduler\Controller;
class Jobs extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\TaskScheduler\Form\List2\Jobs([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\TaskScheduler\Form\Jobs([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}