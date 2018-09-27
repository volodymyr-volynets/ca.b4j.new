<?php

namespace Numbers\Users\Monitoring\Controller\Report\Account;
class ActivityLog extends \Object\Controller\Permission {
	public function actionIndex() {
		$input = \Request::input();
		$input['sm_monusage_user_id1'] = \User::id();
		$input['sm_monusage_user_id2'] = \User::id();
		$form = new \Numbers\Users\Monitoring\Form\Report\Account\ActivityLog([
			'input' => $input,
		]);
		echo $form->render();
	}
}