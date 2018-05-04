<?php

namespace Numbers\Users\Users\Controller\Account;
class Profile extends \Object\Controller\Authorized {
	public function actionIndex() {
		$edit_profile = \HTML::segment([
			'type' => 'primary',
			'value' => \HTML::a(['value' => \HTML::icon(['type' => 'fas fa-users']) . ' ' . i18n(null, 'Update Profile'), 'href' => '/Numbers/Users/Users/Controller/Account/Profile/_EditProfile'])
		]);
		$change_password = \HTML::segment([
			'type' => 'primary',
			'value' => \HTML::a(['value' => \HTML::icon(['type' => 'fas fa-asterisk']) . ' ' . i18n(null, 'Change Password'), 'href' => '/Numbers/Users/Users/Controller/Account/Profile/_ChangePassword'])
		]);
		$grid = [
			'options' => [
				0 => [
					'Row1' => [
						'EditProfile' => [
							'value' => $edit_profile,
							'options' => [
								'percent' => 30,
							]
						],
						'ChangePassword' => [
							'value' => $change_password,
							'options' => [
								'percent' => 30,
							]
						]
					]
				]
			]
		];
		echo \HTML::grid($grid);
	}
	public function actionEditProfile() {
		$form = new \Numbers\Users\Users\Form\Account\Profile([
			'input' => \Request::input(),
			'no_ajax_form_reload' => true,
			'skip_acl' => true
		]);
		echo $form->render();
	}
	public function actionChangePassword() {
		$form = new \Numbers\Users\Users\Form\Account\ChangePassword([
			'input' => \Request::input(),
			'no_ajax_form_reload' => true
		]);
		echo $form->render();
	}
}