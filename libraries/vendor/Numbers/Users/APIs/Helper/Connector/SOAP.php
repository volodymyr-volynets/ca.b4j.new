<?php

namespace Numbers\Users\APIs\Helper\Connector;
class SOAP {

	/**
	 * Send
	 *
	 * @param string $method
	 * @param array $data
	 * @param array $options
	 * @return array
	 */
	public function send(string $method, array $data, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		$context = stream_context_create([
			'http' => [
				'header' => "User-Agent: PHP-SOAP/7.0.0\r\n"
			]
		]);
		// fix wsdl
		$options['wsdl'] = \Numbers\Users\APIs\Helper\SoapServerHendler::renewWSDL($options['wsdl'], $options['username']);
		// step 1 login
		ini_set('soap.wsdl_cache_enabled', 0);
		$client = new \SoapClient($options['wsdl'], [
			'trace' => 1,
			'exceptions' => 1,
			'stream_context' => $context,
			'login' => $options['username'],
			'password' => $options['password'],
			'authentication' => SOAP_AUTHENTICATION_BASIC
		]);
		try {
			$call_result = $client->__call('NumbersUsersUsersAPIsLogin_create', [
				'options' => [
					'username' => $options['username'],
					'password' => $options['password']
				]
			]);
		} catch (\Exception $exception) {
			$result['error'][] = $exception->getMessage();
			return $result;
		}
		if (empty($call_result['success'])) {
			return $call_result;
		}
		// step 2 call actual method
		try {
			$call_result = $client->__call($method, [
				'options' => $data
			]);
		} catch (\Exception $exception) {
			$result['error'][] = $exception->getMessage();
			return $result;
		}
		return $call_result;
	}
}