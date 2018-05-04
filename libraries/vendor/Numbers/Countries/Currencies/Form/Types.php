<?php

namespace Numbers\Countries\Currencies\Form;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'cy_currency_types';
	public $module_code = 'CY';
	public $title = 'C/Y Currency Types Form';
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
			'cy_currtype_code' => [
				'cy_currtype_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'currency_type', 'percent' => 95, 'required' => true, 'navigation' => true],
				'cy_currtype_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cy_currtype_name' => [
				'cy_currtype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'organizations' => [
				'\Numbers\Countries\Currencies\Model\Type\Organizations' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Organizations', 'domain' => 'organization_id', 'multiple_column' => 'cy_curtypeorg_organization_id', 'percent' => 100, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Currency Types',
		'model' => '\Numbers\Countries\Currencies\Model\Types',
		'details' => [
			'\Numbers\Countries\Currencies\Model\Type\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['cy_curtypeorg_tenant_id', 'cy_curtypeorg_type_code', 'cy_curtypeorg_organization_id'],
				'type' => '1M',
				'map' => ['cy_currtype_tenant_id' => 'cy_curtypeorg_tenant_id', 'cy_currtype_code' => 'cy_curtypeorg_type_code']
			]
		]
	];
}