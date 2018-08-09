<?php

namespace Numbers\Users\APIs\Helper;
class SoapServerHendler {

	/**
	 * Magic call method
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments) {
		$model_method = explode('_', $name);
		$temp = str_replace('APIs', 'Apis', $model_method[0]);
		$model = split_on_uppercase($temp);
		foreach ($model as $k => $v) {
			if ($v == 'Apis') $model[$k] = 'APIs';
		}
		$model = \Factory::model('\\' . implode('\\', $model));
		// transform alias
		if (!empty($model->aliases) && isset($model->aliases[$model_method[1]])) {
			$model_method[1] = $model->aliases[$model_method[1]];
		}
		return call_user_func_array([& $model, 'action' . ucfirst($model_method[1])], $arguments);
	}

	/**
	 * Renew WSDL
	 *
	 * @param string $wsdl
	 * @param string $username
	 * @return string
	 */
	public static function renewWSDL($wsdl, $username) {
		// fix wsdl
		if (strpos($wsdl, 'http') !== 0) {
			$wsdl = \Request::host() . ltrim($wsdl, '/');
		}
		// append token
		$crypt = new \Crypt();
		$wsdl.= '&token_id=' . $crypt->tokenCreate($username, '');
		return $wsdl;
	}
}