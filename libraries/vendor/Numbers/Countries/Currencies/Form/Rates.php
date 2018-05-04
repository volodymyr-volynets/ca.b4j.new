<?php

namespace Numbers\Countries\Currencies\Form;
class Rates extends \Object\Form\Wrapper\Base {
	public $form_link = 'cy_currency_rates';
	public $module_code = 'CY';
	public $title = 'C/Y Currency Rates Form';
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
			'cy_currrate_id' => [
				'cy_currrate_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Rate #', 'domain' => 'currency_rate_id_sequence', 'percent' => 95, 'navigation' => true],
				'cy_currrate_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cy_currrate_datetime' => [
				'cy_currrate_datetime' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Datetime', 'type' => 'datetime', 'percent' => 33, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'cy_currrate_currency_type' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'currency_type', 'required' => true, 'percent' => 33, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Types'],
				'cy_currrate_provider_name' => ['order' => 3, 'label_name' => 'Provider Name', 'domain' => 'name', 'null' => true, 'percent' => 34],
			],
			'cy_currrate_source_currency_code' => [
				'cy_currrate_source_currency_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Source Currency', 'domain' => 'currency_code', 'percent' => 33, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Currencies'],
				'cy_currrate_home_currency_code' => ['order' => 2, 'label_name' => 'Home Currency', 'domain' => 'currency_code', 'percent' => 33, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Currencies\Model\Currencies'],
				'cy_currrate_rate' => ['order' => 3, 'label_name' => 'Rate', 'domain' => 'currency_rate', 'percent' => 34, 'required' => true],
			],
			'organizations' => [
				'\Numbers\Countries\Currencies\Model\Rate\Organizations' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Organizations', 'domain' => 'organization_id', 'multiple_column' => 'cy_curateorg_organization_id', 'percent' => 100, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Currency Rates',
		'model' => '\Numbers\Countries\Currencies\Model\Rates',
		'details' => [
			'\Numbers\Countries\Currencies\Model\Rate\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['cy_curateorg_tenant_id', 'cy_curateorg_rate_id', 'cy_curateorg_organization_id'],
				'type' => '1M',
				'map' => ['cy_currrate_tenant_id' => 'cy_curateorg_tenant_id', 'cy_currrate_id' => 'cy_curateorg_rate_id']
			]
		]
	];

	public function validate (& $form) {
		if (!empty($form->values['cy_currrate_source_currency_code']) && !empty($form->values['cy_currrate_home_currency_code']) && $form->values['cy_currrate_source_currency_code'] == $form->values['cy_currrate_home_currency_code']) {
			$form->error('danger', 'Home Currency and Source Currency cannot be the same!', 'cy_currrate_source_currency_code');
			$form->error('danger', 'Home Currency and Source Currency cannot be the same!', 'cy_currrate_home_currency_code');
		}
	}
}