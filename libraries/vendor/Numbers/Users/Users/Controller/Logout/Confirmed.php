<?php

namespace Numbers\Users\Users\Controller\Logout;
class Confirmed extends \Object\Controller {
	public $title = 'Sign Out';
	public $icon = 'fas fa-sign-out-alt';
	public function actionIndex() {
		$options = [
			'options' => [
				i18n(null, 'Congratulations! You have successfully signed out.'),
				i18n(null, 'You can now sign in into your account. [signin].', [
					'replace' => [
						'[signin]' => \HTML::a(['href' => \Request::host(['mvc' => '/Numbers/Users/Users/Controller/Login']), 'value' => i18n(null, 'Sign In')])
					]
				])
			]
		];
		return \HTML::segment([
			'type' => 'success',
			'header' => [
				'icon' => ['type' => 'sign-out'],
				'title' => 'Sign Out:'
			],
			'value' => \HTML::ul($options)
		]);
	}
}