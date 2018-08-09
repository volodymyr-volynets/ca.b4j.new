<?php

namespace Numbers\Users\APIs\Controller;
class API extends \Object\Controller {

	/**
	 * API model
	 *
	 * @var string
	 */
	public $api_model;

	/**
	 * API object
	 *
	 * @var string
	 */
	public $api_object;

	/**
	 * API format
	 *
	 * @var string
	 */
	public $api_format;

	/**
	 * Input
	 *
	 * @var array
	 */
	public $input = [];

	/**
	 * Content type
	 *
	 * @var array
	 */
	public static $content_types = [
		'json' => 'application/json',
		'xml' => 'application/xml'
	];

	/**
	 * REST methods
	 *
	 * @var array
	 */
	public static $rest_methods = [
		'get' => 'read',
		'put' => 'update',
		'post' => 'create',
		'delete' => 'delete'
	];

	/**
	 * Constructor
	 *
	 * @throws \Exception
	 */
	public function __construct() {
		$mvc = \Application::get('mvc');
		$this->api_format = strtolower($mvc['post_action'][1] ?? 'json');
		if (empty(self::$content_types[$this->api_format])) {
			$this->api_format = 'json';
		}
		$this->api_model = $mvc['post_action'][0] ?? null;
		if (empty($this->api_model)) {
			\Layout::renderAs([
				'success' => false,
				'error' => ['You must specify API model!']
			], self::$content_types[$this->api_format]);
		}
		$temp = str_replace('APIs', 'Apis', $this->api_model);
		$model = split_on_uppercase($temp);
		foreach ($model as $k => $v) {
			if ($v == 'Apis') $model[$k] = 'APIs';
		}
		if (!\Can::fileExistsInPath(implode('/', $model) . '.php')) {
			\Layout::renderAs([
				'success' => false,
				'error' => ['You must specify correct API model!']
			], self::$content_types[$this->api_format]);
		}
		$this->api_format = strtolower($this->api_format);
		// process input
		$this->input = \Request::input(null, true);
		$input2 = file_get_contents('php://input');
		if (!empty($input2)) {
			if (is_json($input2)) {
				$input2 = json_decode($input2, true);
			} else if (is_xml($input2)) {
				$xml = simplexml_load_string($input2);
				$input2 = xml2array($xml);
			} else {
				parse_str($input2, $output);
				$input2 = $output;
			}
			$this->input = array_merge($this->input, $input2 ?? []);
		}
		$this->api_object = \Factory::model('\\' . implode('\\', $model), false, [$this->input]);
		// acl
		if (!$this->api_object->authorized) {
			\Layout::renderAs([
				'success' => false,
				'error' => ['You do not have permission to call this API!']
			], self::$content_types[$this->api_format]);
		}
	}

	/**
	 * Rest
	 */
	public function actionRest() {
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		$method_name = 'action' . ucfirst(self::$rest_methods[$method]);
		if (!method_exists($this->api_object, $method_name)) {
			\Layout::renderAs([
				'success' => false,
				'error' => ['Method does not exists!']
			], self::$content_types[$this->api_format]);
		}
		$result = $this->api_object->{$method_name}($this->input);
		\Layout::renderAs($result, self::$content_types[$this->api_format]);
	}

	/**
	 * Restful
	 */
	public function actionRestful() {
		$method = strtolower($this->input['__method'] ?? '');
		$method_name = 'action' . ucfirst(self::$rest_methods[$method]);
		if (!method_exists($this->api_object, $method_name)) {
			\Layout::renderAs([
				'success' => false,
				'error' => ['Method does not exists!']
			], self::$content_types[$this->api_format]);
		}
		$result = $this->api_object->{$method_name}($this->input);
		\Layout::renderAs($result, self::$content_types[$this->api_format]);
	}
}