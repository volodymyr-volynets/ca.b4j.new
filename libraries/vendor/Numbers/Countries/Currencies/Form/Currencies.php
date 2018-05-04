<?php

namespace Numbers\Countries\Currencies\Form;
class Currencies extends \Object\Form\Wrapper\Base {
	public $form_link = 'cy_currencies';
	public $module_code = 'CY';
	public $title = 'C/Y Currencies Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'cm_country_code' => [
				'cy_currency_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Currency Code', 'domain' => 'currency_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'cy_currency_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cy_currency_name' => [
				'cy_currency_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'cy_currency_symbol' => [
				'cy_currency_symbol' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Symbol', 'domain' => 'name', 'required' => true],
				'cy_currency_fraction_digits' => ['order' => 2, 'label_name' => 'Fraction Digits', 'domain' => 'fraction_digits', 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Countries\Currencies\Model\Fractions'],
			],
			'organizations' => [
				'\Numbers\Countries\Currencies\Model\Currency\Organizations' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Organizations', 'domain' => 'organization_id', 'multiple_column' => 'cy_currorg_organization_id', 'percent' => 100, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Currencies',
		'model' => '\Numbers\Countries\Currencies\Model\Currencies',
		'details' => [
			'\Numbers\Countries\Currencies\Model\Currency\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['cy_currorg_tenant_id', 'cy_currorg_currency_code', 'cy_currorg_organization_id'],
				'type' => '1M',
				'map' => ['cy_currency_tenant_id' => 'cy_currorg_tenant_id', 'cy_currency_code' => 'cy_currorg_currency_code']
			]
		]
	];
}