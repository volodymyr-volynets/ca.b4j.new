<?php

namespace Numbers\Users\Users\Helper;
class LoginWithToken {

	/**
	 * URL
	 *
	 * @param int $user_id
	 */
	public static function URL(int $user_id) : string {
		$crypt = new \Crypt();
		return \Request::host() . 'Numbers/Users/Users/Controller/Login/WithToken/_Index?token=' . $crypt->tokenCreate($user_id, 'login.user');
	}
}