<?php

namespace Numbers\Users\Users\APIs;
class Login extends \Numbers\Users\APIs\Abstract2\API {

	public $instructions = [
		'create' => [
			'input' => [
				'username' => ['name' => 'Username', 'domain' => 'login', 'required' => true],
				'password' => ['name' => 'Password', 'domain' => 'password', 'required' => true],
			],
			'output' => [
				'success' => ['name' => 'Success', 'type' => 'boolean'],
				'error' => ['name' => 'Error(s)', 'type' => 'array'],
				'session' => ['name' => 'Session', 'type' => 'varchar'],
				'auth_tkt' => ['name' => 'Auth Token', 'type' => 'varchar'],
			]
		],
		'delete' => [
			'input' => [
				'__session_id' => ['name' => 'Session #', 'domain' => 'code', 'required' => true],
			],
			'output' => [
				'success' => ['name' => 'Success', 'type' => 'boolean'],
				'error' => ['name' => 'Error(s)', 'type' => 'array'],
			]
		]
	];

	public function actionCreate($options) {
		return \Numbers\Users\APIs\Helper\Authorize::authorizeWithCredentials($options['username'], $options['password']);
	}
	public function actionDelete($options) {
		return \Numbers\Users\APIs\Helper\Authorize::signOut($options['__session_id']);
	}
}