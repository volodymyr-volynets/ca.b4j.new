<?php

namespace Numbers\Countries\Countries\Data\Features\Import;
class PostalCodes extends \Object\Import {
	public $data = [
		'postal_codes' => [
			'options' => [
				'pk' => ['cm_postal_tenant_id', 'cm_postal_country_code', 'cm_postal_postal_code'],
				'model' => '\Numbers\Countries\Countries\Model\PostalCodes',
				'method' => 'save'
			],
			'data' => []
		]
	];

	/**
	 * Process
	 */
	public function process() {
		$result = [
			'success' => true,
			'error' => []
		];
		// load all existing postal codes for specified country
		//$this->options['cm_postal_country_code']
		$model = new \Numbers\Countries\Countries\Model\PostalCodes();
		$query = $model->queryBuilder()->select();
		$query->columns([
			'c' => 'a.cm_postal_postal_code'
		]);
		$query->where('AND', ['cm_postal_country_code', '=', $this->options['cm_postal_country_code']]);
		$existing_postal_codes = $query->query('c');
		// load data from csv file
		$data = \Numbers\Backend\IO\CSV\Imports::read(__DIR__ . '/postal_codes_' . strtolower($this->options['cm_postal_country_code']) . '.csv');
		unset($data['data']['Main Sheet'][0]);
		$rows = [];
		foreach ($data['data']['Main Sheet'] as $k => $v) {
			$postal_code = $v[2] . '';
			if ($this->options['cm_postal_country_code'] == 'US') {
				if (strlen($postal_code) < 5) $postal_code = str_pad($postal_code, 5, '0', STR_PAD_LEFT);
			}
			// we do not import existing postal codes
			if (isset($existing_postal_codes['rows'][$postal_code])) continue;
			$rows[$postal_code] = [
				'cm_postal_tenant_id' => \Tenant::id(),
				'cm_postal_country_code' => $v[0],
				'cm_postal_province_code' => $v[1],
				'cm_postal_postal_code' => $postal_code,
				'cm_postal_city' => $v[3],
				'cm_postal_latitude' => $v[4],
				'cm_postal_longitude' => $v[5],
				'cm_postal_inactive' => 0
			];
			unset($data['main'][$k]);
			if (count($rows) == 500) {
				$copy_result = $model->db_object->copy($model->full_table_name, $rows);
				if (!$copy_result['success']) {
					$result['error']+= $copy_result['error'];
					return $result;
				}
				$rows = [];
			}
		}
		if (!empty($rows)) {
			$copy_result = $model->db_object->copy($model->full_table_name, $rows);
			if (!$copy_result['success']) {
				$result['error']+= $copy_result['error'];
				return $result;
			}
		}
		$result['success'] = true;
		return $result;
	}
}