<?php

namespace Numbers\Users\TaskScheduler\Controller;
class Daemons extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\TaskScheduler\Form\List2\Daemons([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\TaskScheduler\Form\Daemons([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}