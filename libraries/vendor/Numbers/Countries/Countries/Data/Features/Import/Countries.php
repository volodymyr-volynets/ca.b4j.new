<?php

namespace Numbers\Countries\Countries\Data\Features\Import;
class Countries extends \Object\Import {
	public $data = [
		'regions' => [
			'options' => [
				'pk' => ['cm_region_tenant_id', 'cm_region_id'],
				'model' => '\Numbers\Countries\Countries\Model\Regions',
				'method' => 'save_insert_new'
			],
			'data' => []
		],
		'countries' => [
			'options' => [
				'pk' => ['cm_country_tenant_id', 'cm_country_code'],
				'model' => '\Numbers\Countries\Countries\Model\Countries',
				'method' => 'save_insert_new'
			],
			'data' => []
		],
		'provinces' => [
			'options' => [
				'pk' => ['cm_province_tenant_id', 'cm_province_country_code', 'cm_province_province_code'],
				'model' => '\Numbers\Countries\Countries\Model\Provinces',
				'method' => 'save_insert_new'
			],
			'data' => []
		]
	];

	/**
	 * Load data from CSV file
	 */
	public function overrides() {
		// step 1: countries and regions
		$countries = [];
		$regions = [];
		$data = \Numbers\Backend\IO\CSV\Imports::read(__DIR__ . '/countries.csv');
		unset($data['data']['Main Sheet'][0]);
		foreach ($data['data']['Main Sheet'] as $k => $v) {
			// if we need to import only specific countries
			if (!empty($this->options['cm_country_code']) && $this->options['cm_country_code'] != $v[1]) continue;
			$countries[$v[1]] = [
				'cm_country_code' => $v[1],
				'cm_country_name' => $v[0],
				'cm_country_code3' => $v[2],
				'cm_country_number' => (int) $v[3],
				'cm_country_region_id' => !empty($v[7]) ? (int) $v[7] : null,
				'cm_country_sub_region_id' => !empty($v[8]) ? (int) $v[8] : null,
				'cm_country_inactive' => 0
			];
			if (!empty($v[7])) {
				$regions[(int) $v[7]] = [
					'cm_region_id' => (int) $v[7],
					'cm_region_name' => $v[5],
					'cm_region_inactive' => 0
				];
			}
			if (!empty($v[8])) {
				$regions[(int) $v[8]] = [
					'cm_region_id' => (int) $v[8],
					'cm_region_name' => $v[6],
					'cm_region_inactive' => 0
				];
			}
		}
		$this->data['regions']['data'] = $regions;
		$this->data['countries']['data'] = $countries;
		// step 2: provinces
		$provinces = [];
		$data = \Numbers\Backend\IO\CSV\Imports::read(__DIR__ . '/provinces.csv');
		unset($data['data']['Main Sheet'][0]);
		foreach ($data['data']['Main Sheet'] as $k => $v) {
			// if we need to import only specific countries
			if (!empty($this->options['cm_country_code']) && $this->options['cm_country_code'] != $v[2]) continue;
			$provinces[] = [
				'cm_province_country_code' => $v[2],
				'cm_province_province_code' => $v[1],
				'cm_province_name' => $v[0],
				'cm_province_inactive' => 0
			];
		}
		$this->data['provinces']['data'] = $provinces;
		unset($countries, $regions, $provinces);
	}
}