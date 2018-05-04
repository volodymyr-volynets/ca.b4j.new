<?php

namespace Numbers\Countries\Currencies\Form;
class Online extends \Object\Form\Wrapper\Base {
	public $form_link = 'cy_online_rates';
	public $module_code = 'CY';
	public $title = 'C/Y Online Rates Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			//'back' => true,
			//'new' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'rate' => ['default_row_type' => 'grid', 'order' => 1000],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'cy_currrate_provider_name' => [
				'cy_currrate_provider_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Provider', 'domain' => 'group_code', 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Providers', 'onchange' => 'this.form.submit();'],
			],
			'cy_currrate_source_currency_code' => [
				'cy_currrate_source_currency_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Source Currency', 'domain' => 'currency_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Currencies', 'onchange' => 'this.form.submit();'],
				'cy_currrate_home_currency_code' => ['order' => 2, 'label_name' => 'Home Currency', 'domain' => 'currency_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Currencies', 'onchange' => 'this.form.submit();'],
			],
		],
		'rate' => [
			'rate' => [
				'rate' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Rate', 'custom_renderer' => '\Numbers\Countries\Currencies\Form\Online::renderRate'],
			]
		]
	];

	public function renderRate(& $form, & $options, & $value, & $neighbouring_values) {
		if (!empty($form->values['cy_currrate_provider_name']) && !empty($form->values['cy_currrate_source_currency_code']) && !empty($form->values['cy_currrate_home_currency_code'])) {
			$model = new \Numbers\Countries\Currencies\Model\Providers();
			$data = $model->get([
				'where' => [
					'cy_provider_code' => $form->values['cy_currrate_provider_name']
				],
				'single_row' => true,
				'pk' => ['cy_provider_code']
			]);
			$method = \Factory::method($data['cy_provider_method'], null, true);
			$result = call_user_func_array($method, [[
				'source_currency_code' => $form->values['cy_currrate_source_currency_code'],
				'home_currency_code' => $form->values['cy_currrate_home_currency_code']
			]]);
			if ($result['success']) {
				$params = [
					'cy_currrate_datetime' => \Format::now('datetime'),
					'cy_currrate_source_currency_code' => $form->values['cy_currrate_source_currency_code'],
					'cy_currrate_home_currency_code' => $form->values['cy_currrate_home_currency_code'],
					'cy_currrate_rate' => $result['rate'],
					'cy_currrate_provider_name' => $data['cy_provider_name'],
				];
				return '<a class="form-control form-control-no-border" href="/Numbers/Countries/Currencies/Controller/Rates/_Edit?' . http_build_query2($params) . '">' . \Format::currencyRate($result['rate']) . '</a>';
			} else {
				$form->error(DANGER, 'Rate not found!');
			}
		}
		return '';
	}
}