<?php

namespace Numbers\Users\Monitoring\Controller\Report;
class ActivityLog extends \Object\Controller\Permission {
	public function actionIndex() {
		$form = new \Numbers\Users\Monitoring\Form\Report\ActivityLog([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}