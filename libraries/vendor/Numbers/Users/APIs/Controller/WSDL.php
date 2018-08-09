<?php

namespace Numbers\Users\APIs\Controller;
class WSDL extends \Object\Controller {
	public function actionIndex() {
		$input = \Request::input();
		if (array_key_exists('wsdl', $input)) {
			$good = false;
			if (!empty($input['token_id'])) {
				$crypt = new \Crypt();
				$result = $crypt->tokenValidate($input['token_id']);
				if (!empty($result['id'])) {
					$result = \Numbers\Users\APIs\Helper\Authorize::authorizeWithCredentials($result['id'], '', ['skip_password_validation' => true]);
					if ($result['success']) {
						$good = true;
					}
				}
			}
			if (isset($_SERVER['PHP_AUTH_USER']) && !$good) {
				$result = \Numbers\Users\APIs\Helper\Authorize::authorizeWithCredentials($_SERVER['PHP_AUTH_USER'] ?? '', $_SERVER['PHP_AUTH_PW'] ?? '');
				if ($result['success']) {
					$good = true;
				}
			}
			if (!$good) {
				header('WWW-Authenticate: Basic realm="Webservices"');
				header('HTTP/1.0 401 Unauthorized');
				echo 'Webservices are located here';
				exit;
			}
			$endpoint = \Application::get('mvc.full_with_host');
			$wsdl = \Numbers\Users\APIs\Helper\WSDL::generate($endpoint);
			\Layout::renderAs($wsdl, 'application/xml');
		} else {
			$good = false;
			if (isset($_SERVER['PHP_AUTH_USER'])) {
				$result = \Numbers\Users\APIs\Helper\Authorize::authorizeWithCredentials($_SERVER['PHP_AUTH_USER'] ?? '', $_SERVER['PHP_AUTH_PW'] ?? '');
				if ($result['success']) {
					$good = true;
				}
			}
			if (!$good) {
				header('WWW-Authenticate: Basic realm="Webservices"');
				header('HTTP/1.0 401 Unauthorized');
				echo 'Webservices are located here';
				exit;
			}
			// diable caching
			ini_set('soap.wsdl_cache_enabled', 0);
			$wsdl = \Numbers\Users\APIs\Helper\SoapServerHendler::renewWSDL(\Application::get('mvc.full_with_host') . '?wsdl', $_SERVER['PHP_AUTH_USER']);
			$soap_server = new \SoapServer($wsdl);
			$soap_server->setClass('\Numbers\Users\APIs\Helper\SoapServerHendler');
			$soap_server->handle();
			exit;
		}
	}
}