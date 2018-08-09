<?php

namespace Numbers\Users\APIs\Helper;
class Authorize {

	/**
	 * Authorize with username/password
	 *
	 * @param string $username
	 * @param string $password
	 * @param array $options
	 *		bool skip_password_validation
	 * @return array
	 */
	public static function authorizeWithCredentials($username, $password, $options = []) : array {
		$result = [
			'success' => false,
			'error' => [],
			'session' => null,
			'auth_tkt' => null
		];
		do {
			$username = strtolower($username);
			$model = new \Numbers\Users\APIs\Model\Users();
			$api_user = $model->get([
				'where' => [
					'ua_apiusr_login_username' => $username,
					'ua_apiusr_inactive' => 0,
					'ua_apiusr_hold' => 0
				],
				'pk' => null
			]);
			if (empty($api_user)) {
				$result['error'][] = 'API user not found!';
				break;
			}
			// validate password
			$crypt = new \Crypt();
			if (empty($options['skip_password_validation'])) {
				if (!$crypt->passwordVerify($password, $api_user[0]['ua_apiusr_login_password'])) {
					$result['error'][] = 'Invalid credentials!';
					break;
				}
			}
			// fetch permisions
			$permissions = \Numbers\Users\APIs\Model\User\Permissions::getStatic([
				'columns' => ['ua_apiusrperm_module_id', 'ua_apiusrperm_resource_id', 'ua_apiusrperm_inactive'],
				'where' => [
					'ua_apiusrperm_user_id' => $api_user[0]['ua_apiusr_id']
				],
				'pk' => null
			]);
			$api_permissions = [];
			foreach ($permissions as $k => $v) {
				$api_permissions[$v['ua_apiusrperm_module_id']][$v['ua_apiusrperm_resource_id']] = $v['ua_apiusrperm_inactive'];
			}
			// fetch user
			$datasource = new \Numbers\Users\Users\DataSource\Login();
			$user = $datasource->get(['where' => ['user_id' => $api_user[0]['ua_apiusr_user_id']]]);
			// authorize entity if we got here
			unset($user['login_password'], $api_user[0]['ua_apiusr_login_password']);
			$user['api_user'] = $api_user[0];
			$user['api_permissions'] = $api_permissions;
			// create new session
			session_regenerate_id();
			\User::userAuthorize($user);
			// success
			$result['success'] = true;
			$result['session'] = session_id();
			$result['auth_tkt'] = $crypt->tokenCreate($api_user[0]['ua_apiusr_user_id'], $api_user[0]['ua_apiusr_id']);
		} while(0);
		return $result;
	}

	/**
	 * Sign out
	 *
	 * @param string $session_id
	 * @return array
	 */
	public static function signOut($session_id) {
		// todo
		\User::userSignOut();
		\Session::destroy();
		return [
			'success' => true,
			'error' => []
		];
	}
}