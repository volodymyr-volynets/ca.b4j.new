<?php

namespace Numbers\Countries\Currencies\Task;
class OnlineRates extends \Numbers\Users\TaskScheduler\Abstract2\Task {

	public $task_code = 'CY_TASK_ONLINE_RATES';

	public function execute(array $parameters, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => [],
			'data' => []
		];
		// load provider
		$model = new \Numbers\Countries\Currencies\Model\Providers();
		$data = $model->get([
			'where' => [
				'cy_provider_code' => $parameters['provider_code']
			],
			'single_row' => true,
			'pk' => ['cy_provider_code']
		]);
		$method = \Factory::method($data['cy_provider_method'], null, true);
		$temp_result = call_user_func_array($method, [[
			'source_currency_code' => $parameters['source_currency_code'],
			'home_currency_code' => $parameters['home_currency_code']
		]]);
		if (!$temp_result['success']) {
			$result['error'][] = 'Could not load the rate!';
			return $result;
		}
		$import_data = [
			'cy_currrate_datetime' => \Format::now('datetime'),
			'cy_currrate_currency_type' => $parameters['currency_type'],
			'cy_currrate_source_currency_code' => $parameters['source_currency_code'],
			'cy_currrate_home_currency_code' => $parameters['home_currency_code'],
			'cy_currrate_rate' => $temp_result['rate'],
			'cy_currrate_provider_name' => $data['cy_provider_name'],
			'\Numbers\Countries\Currencies\Model\Rate\Organizations' => [
				$parameters['organization_1'] => $parameters['organization_1']
			]
		];
		if (!empty($parameters['organization_2'])) {
			$import_data['\Numbers\Countries\Currencies\Model\Rate\Organizations'][$parameters['organization_2']] = $parameters['organization_2'];
		}
		if (!empty($parameters['organization_3'])) {
			$import_data['\Numbers\Countries\Currencies\Model\Rate\Organizations'][$parameters['organization_3']] = $parameters['organization_3'];
		}
		$api = \Numbers\Countries\Currencies\Form\Rates::API();
		$form_result = $api->save($import_data);
		if (!$form_result['success']) {
			$result['error'] = array_merge($result['error'], $form_result['error']);
		} else {
			$result['success'] = true;
		}
		return $result;
	}
}