<?php

namespace Numbers\Users\Users\Controller\Login;
class WithToken extends \Object\Controller {
	public $title = 'Single Sign On';
	public $icon = 'fas fa-sign-in-alt';
	public function actionIndex() {
		$crypt = new \Crypt();
		$token = \Request::input('token');
		$token_data = $crypt->tokenValidate($token);
		if ($token_data === false || $token_data['token'] != 'login.user') {
			\Layout::addMessage('Login token is not valid or expired!', DANGER);
		}
		// we logout if authorized
		if (\User::authorized()) {
			\Numbers\Users\Users\Model\User\Authorize::signOut();
		}
		\Request::redirect(\Request::host() . 'Numbers/Users/Users/Controller/Login/WithToken/_Login?token=' . $token);
	}
	public function actionLogin() {
		if (\User::authorized()) {
			\Layout::addMessage('You must logout first!', DANGER);
		} else {
			$crypt = new \Crypt();
			$token = \Request::input('token');
			$token_data = $crypt->tokenValidate($token);
			if ($token_data === false || $token_data['token'] != 'login.user') {
				\Layout::addMessage('Login token is not valid or expired!', DANGER);
			} else {
				$user_id = (int) $token_data['id'];
				// we sign in
				$authorize = \Numbers\Users\Users\Model\User\Authorize::authorizeWithUserId($user_id);
				if ($authorize['success']) {
					// if we need to redirect to post login page
					$url = \Application::get('flag.global.default_postlogin_page');
					if (!empty($url)) {
						\Request::redirect($url);
					}
					\Layout::addMessage('You have successfully signed in!', SUCCESS);
				}
			}
		}
	}
}