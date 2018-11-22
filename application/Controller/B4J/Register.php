<?php

namespace Controller\B4J;
class Register extends \Object\Controller {
	public function actionIndex() {
//		$form = new \Form\Register\Collection([
//			'input' => \Request::input()
//		]);
//		echo $form->render();
	}
	public function actionMedical() {
		$input = \Request::input();
		$crypt = new \Crypt();
		$crypt->object->valid_hours = registry('b4j.need_medical_token_valid') ?? 48;
		$token_data = $crypt->tokenVerify($input['token'] ?? '', ['medical.b4j']);
		$input['b4_registration_id'] = $token_data['id'];
		// render collection
		$form = new \Form\Medical\Collection([
			'input' => $input
		]);
		echo $form->render();
	}
}