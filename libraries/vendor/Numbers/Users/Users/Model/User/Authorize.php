<?php

namespace Numbers\Users\Users\Model\User;
class Authorize {

	/**
	 * Authorize with username/password
	 *
	 * @param string $username
	 * @param string $password
	 * @return array
	 */
	public static function authorizeWithCredentials($username, $password) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		do {
			$datasource = new \Numbers\Users\Users\DataSource\Login();
			$user = $datasource->get(['where' => ['username' => $username]]);
			if (empty($user)) break;
			// validate password
			$crypt = new \Crypt();
			if (!$crypt->passwordVerify($password, $user['login_password'])) break;
			// process password reset based on login_last_set date
			$login_last_set_date = New \DateTime($user['login_last_set']);
			$today = new \DateTime();
			$interval = $login_last_set_date->diff($today);
			$diff = (int) str_replace('+', '', $interval->format('%R%a'));
			$days = \Application::get('crypt.default.password_valid_days');
			if ($diff > (int) $days) {
				$_SESSION['numbers']['force']['password_reset'] = [
					'controller' => '/Numbers/Users/Users/Controller/Account/Profile/_ChangePassword',
					'message' => i18n(null, 'You must change your password every [number_of_days] days!', [
						'replace' => [
							'[number_of_days]' => \Format::id($days)
						]
					])
				];
			}
			// authorize entity if we got here
			unset($user['login_password']);
			\User::userAuthorize($user);
			// success
			$result['success'] = true;
		} while(0);
		return $result;
	}

	/**
	 * Authorize with user #
	 *
	 * @param int $user_id
	 * @return array
	 */
	public static function authorizeWithUserId(int $user_id) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		do {
			$datasource = new \Numbers\Users\Users\DataSource\Login();
			$user = $datasource->get(['where' => ['user_id' => $user_id]]);
			if (empty($user)) break;
			// authorize entity if we got here
			unset($user['login_password']);
			\User::userAuthorize($user);
			// success
			$result['success'] = true;
		} while(0);
		return $result;
	}

	/**
	 * Sign out
	 */
	public static function signOut() {
		\User::userSignOut();
		\Session::destroy();
	}
}