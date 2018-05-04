<?php

namespace Numbers\Countries\Currencies\Data\Features\Import;
class Providers extends \Object\Import {
	public $data = [
		'providers' => [
			'options' => [
				'pk' => ['cy_provider_code'],
				'model' => '\Numbers\Countries\Currencies\Model\Providers',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'cy_provider_code' => 'GOOGLE_FINANCE',
					'cy_provider_name' => 'Google Finance',
					'cy_provider_method' => '\Numbers\Countries\Currencies\Model\Providers\GoogleFinance::get',
					'cy_provider_inactive' => 0
				],
				[
					'cy_provider_code' => 'YAHOO_FINANCE',
					'cy_provider_name' => 'Yahoo Finance',
					'cy_provider_method' => '\Numbers\Countries\Currencies\Model\Providers\YahooFinance::get',
					'cy_provider_inactive' => 0
				]
			]
		]
	];
}