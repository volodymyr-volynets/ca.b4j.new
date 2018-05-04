<?php

namespace Numbers\Countries\Currencies\Controller\Task;
class OnlineRates extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Countries\Currencies\Form\Task\OnlineRates([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}