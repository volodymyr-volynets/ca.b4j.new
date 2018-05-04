<?php

namespace Numbers\Users\Organizations\Controller\Workflow;
class Dashboards extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Organizations\Form\List2\Service\Workflow\Dashboards([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Organizations\Form\Service\Workflow\Dashboards([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionImport() {
		$form = new \Object\Form\Wrapper\Import([
			'model' => '\Numbers\Users\Organizations\Form\Service\Workflow\Dashboards',
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}