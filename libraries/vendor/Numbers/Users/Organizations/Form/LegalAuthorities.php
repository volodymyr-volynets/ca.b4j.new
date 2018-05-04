<?php

namespace Numbers\Users\Organizations\Form;
class LegalAuthorities extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_legal_authorities';
	public $module_code = 'ON';
	public $title = 'O/N Legal Authorities Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'jurisdictions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\LegalAuthority\Jurisdictions',
			'details_pk' => ['on_authjuris_jurisdiction_id'],
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'on_organization_id' => ['order' => 100],
			'on_organization_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'juristictions' => ['order' => 200, 'label_name' => 'Jurisdictions'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		]
	];
	public $elements = [
		'top' => [
			'on_authority_id' => [
				'on_authority_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Authority #', 'domain' => 'authority_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_authority_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_authority_name' => [
				'on_authority_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_authority_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'juristictions' => [
				'juristictions' => ['container' => 'jurisdictions_container', 'order' => 100]
			]
		],
		'general_container' => [
			'on_authority_effective_from' => [
				'on_authority_effective_from' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Effective From', 'type' => 'date', 'required' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'on_authority_effective_to' => ['order' => 2, 'label_name' => 'Effective To', 'type' => 'date', 'null' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
		],
		'jurisdictions_container' => [
			'row1' => [
				'on_authjuris_jurisdiction_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Jurisdiction', 'domain' => 'jurisdiction_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Jurisdictions::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_authjuris_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Legal Authorities',
		'model' => '\Numbers\Users\Organizations\Model\LegalAuthorities',
		'details' => [
			'\Numbers\Users\Organizations\Model\LegalAuthority\Jurisdictions' => [
				'name' => 'Jurisdictions',
				'pk' => ['on_authjuris_tenant_id', 'on_authjuris_authority_id', 'on_authjuris_jurisdiction_id'],
				'type' => '1M',
				'map' => ['on_authority_tenant_id' => 'on_authjuris_tenant_id', 'on_authority_id' => 'on_authjuris_authority_id'],
			]
		]
	];
}