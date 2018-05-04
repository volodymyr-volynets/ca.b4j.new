<?php

namespace Numbers\Users\Organizations\Form;
class Jurisdictions extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_jurisdictions';
	public $module_code = 'ON';
	public $title = 'O/N Jurisdictions Form';
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
		'countries_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Jurisdiction\Countries',
			'details_pk' => ['on_juriscntr_country_code'],
			'order' => 35000
		],
		'provinces_container' => [
			'type' => 'subdetails',
			'label_name' => 'Provinces',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Jurisdiction\Countries',
			'details_key' => '\Numbers\Users\Organizations\Model\Jurisdiction\Country\Provinces',
			'details_pk' => ['on_jurisprov_province_code'],
			'order' => 1000,
			'required' => false
		],
	];
	public $rows = [
		'top' => [
			'on_organization_id' => ['order' => 100],
			'on_organization_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'countries' => ['order' => 200, 'label_name' => 'Countries']
		]
	];
	public $elements = [
		'top' => [
			'on_jurisdiction_id' => [
				'on_jurisdiction_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Jurisdiction #', 'domain' => 'jurisdiction_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_jurisdiction_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_jurisdiction_name' => [
				'on_jurisdiction_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'countries' => [
				'countries' => ['container' => 'countries_container', 'order' => 100]
			]
		],
		'general_container' => [
			'um_user_type_id' => [
				'on_jurisdiction_type' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Types', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Jurisdiction\Types'],
				'on_organization_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
		],
		'countries_container' => [
			'row1' => [
				'on_juriscntr_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country', 'domain' => 'country_code', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_juriscntr_all_provinces' => ['order' => 1, 'label_name' => 'All Provinces', 'type' => 'boolean', 'percent' => 15],
				'on_juriscntr_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'provinces_container' => [
			'row1' => [
				'on_jurisprov_province_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Province', 'domain' => 'province_code', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'detail::on_juriscntr_country_code'], 'onchange' => 'this.form.submit();'],
				'on_jurisprov_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Jurisdictions',
		'model' => '\Numbers\Users\Organizations\Model\Jurisdictions',
		'details' => [
			'\Numbers\Users\Organizations\Model\Jurisdiction\Countries' => [
				'name' => 'Countries',
				'pk' => ['on_juriscntr_tenant_id', 'on_juriscntr_jurisdiction_id', 'on_juriscntr_country_code'],
				'type' => '1M',
				'map' => ['on_jurisdiction_tenant_id' => 'on_juriscntr_tenant_id', 'on_jurisdiction_id' => 'on_juriscntr_jurisdiction_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Jurisdiction\Country\Provinces' => [
						'name' => 'Provinces',
						'pk' => ['on_jurisprov_tenant_id', 'on_jurisprov_jurisdiction_id', 'on_jurisprov_country_code', 'on_jurisprov_province_code'],
						'type' => '1M',
						'map' => ['on_juriscntr_tenant_id' => 'on_jurisprov_tenant_id', 'on_juriscntr_jurisdiction_id' => 'on_jurisprov_jurisdiction_id', 'on_juriscntr_country_code' => 'on_jurisprov_country_code'],
					]
				]
			]
		]
	];
}