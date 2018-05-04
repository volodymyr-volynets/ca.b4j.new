<?php

namespace Numbers\Countries\Currencies\DataSource\Currency;
class Rates extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [];
	public $options_active = [];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Countries\Currencies\Model\Rates';
	public $parameters = [
		'organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'required' => true],
		'document_date' => ['name' => 'Document Date', 'type' => 'date', 'required' => true],
		'currency_type' => ['name' => 'Currency Type', 'domain' => 'currency_type', 'required' => true],
		'source_currency_code' => ['name' => 'Source Currency', 'domain' => 'currency_code', 'required' => true],
		'home_currency_code' => ['name' => 'Home Currency', 'domain' => 'currency_code', 'required' => true],
		'limit' => ['name' => 'Limit', 'type' => 'integer'],
		'rate_id' => ['name' => 'Rate #', 'domain' => 'currency_rate_id'],
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'id' => 'a.cy_currrate_id',
			'datetime' => 'cy_currrate_datetime',
			'currency_type' => 'cy_currrate_currency_type',
			'source_currency_code' => 'cy_currrate_source_currency_code',
			'home_currency_code' => 'cy_currrate_home_currency_code',
			'rate' => 'a.cy_currrate_rate',
			'provider' => 'a.cy_currrate_provider_name',
			'inactive' => 'a.cy_currrate_inactive'
		]);
		// joins
		$this->query->join('LEFT', new \Numbers\Countries\Currencies\Model\Rate\Organizations(), 'b', 'ON', [
			['AND', ['a.cy_currrate_id', '=', 'b.cy_curateorg_rate_id', true], false],
			['AND', ['b.cy_curateorg_organization_id', '=', $parameters['organization_id'], false], false]
		]);
		// where
		if (!empty($parameters['rate_id'])) {
			$this->query->where('AND', ['a.cy_currrate_id', '=', $parameters['rate_id']]);
			$parameters['limit'] = 1;
		} else {
			$this->query->where('AND', function (& $query) use ($parameters) {
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.cy_currrate_id', '=', $parameters['existing_values']]);
				}
				$query->where('OR', function (& $query) use ($parameters) {
					$query->where('AND', ['b.cy_curateorg_organization_id', 'IS NOT', null]);
					$query->where('AND', ['a.cy_currrate_currency_type', '=', $parameters['currency_type']]);
					$query->where('AND', ['a.cy_currrate_source_currency_code', '=', $parameters['source_currency_code']]);
					$query->where('AND', ['a.cy_currrate_home_currency_code', '=', $parameters['home_currency_code']]);
					$query->where('AND', ['a.cy_currrate_datetime::date', '<=', $parameters['document_date']]);
				});
			});
		}
		if (empty($parameters['limit'])) $parameters['limit'] = 12;
		$this->query->limit($parameters['limit']);
		$this->query->orderby(['cy_currrate_datetime' => SORT_DESC]);
	}

	/**
	 * @see $this->get();
	 */
	public function options($options = []) {
		$data = $this->get($options);
		$result = [];
		foreach ($data as $k => $v) {
			$date = \Format::date($v['datetime']);
			$result[$k]['parent'] = $date;
			if (!isset($result[$date])) {
				$result[$date] = ['name' => $date, 'parent' => null, 'disabled' => true];
			}
			$result[$k]['name'] = '#' . $v['id'] . ' - ' . \Format::currencyRate($v['rate']);
			$result[$k]['title'] = \Format::datetime($v['datetime']) . ' - ' . i18n(null, $v['provider']);
			$result[$k]['rate'] = \Format::currencyRate($v['rate'], ['currency_code' => $v['home_currency_code']]);
		}
		if (!empty($result)) {
			$converted = \Helper\Tree::convertByParent($result, 'parent');
			$result = [];
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name', 'i18n' => 'skip_sorting'], $result);
		}
		return $result;
	}
}