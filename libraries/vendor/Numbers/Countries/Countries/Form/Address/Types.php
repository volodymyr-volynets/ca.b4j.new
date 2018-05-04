<?php

namespace Numbers\Countries\Countries\Form\Address;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'cm_address_types';
	public $module_code = 'CM';
	public $title = 'C/M Address Types Form';
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
			'cm_addrtype_code' => [
				'cm_addrtype_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'type_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'cm_addrtype_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'cm_addrtype_name' => [
				'cm_addrtype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'cm_addrtype_global' => ['order' => 2, 'label_name' => 'Global', 'type' => 'boolean', 'percent' => 5]
			],
			'organizations' => [
				'\Numbers\Countries\Countries\Model\Address\Type\Organizations' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Organizations', 'domain' => 'organization_id', 'multiple_column' => 'cm_addrtporg_organization_id', 'percent' => 100, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Address Types',
		'model' => '\Numbers\Countries\Countries\Model\Address\Types',
		'details' => [
			'\Numbers\Countries\Countries\Model\Address\Type\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['cm_addrtporg_tenant_id', 'cm_addrtporg_type_code', 'cm_addrtporg_organization_id'],
				'type' => '1M',
				'map' => ['cm_addrtype_tenant_id' => 'cm_addrtporg_tenant_id', 'cm_addrtype_code' => 'cm_addrtporg_type_code']
			]
		]
	];
}