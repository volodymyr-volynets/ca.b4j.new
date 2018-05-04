<?php

namespace Numbers\Users\TimeTracking\Controller;
class Projects extends \Object\Controller\Authorized {
	public function actionIndex() {
		$form = new \Numbers\Users\TimeTracking\Form\List2\Projects([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\TimeTracking\Form\Projects([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\TimeTracking\Form\Projects',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}