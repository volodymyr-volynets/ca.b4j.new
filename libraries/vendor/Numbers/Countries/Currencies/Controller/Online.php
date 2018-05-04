<?php

namespace Numbers\Countries\Currencies\Controller;
class Online extends \Object\Controller\Permission {
	public function actionEdit() {
		$form = new \Numbers\Countries\Currencies\Form\Online([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
}