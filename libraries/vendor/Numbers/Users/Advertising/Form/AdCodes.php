<?php

namespace Numbers\Users\Advertising\Form;
class AdCodes extends \Object\Form\Wrapper\Base {
	public $form_link = 'am_adcodes';
	public $module_code = 'AM';
	public $title = 'A/M Ad Codes Form';
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
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// children
		'general_container' => ['default_row_type' => 'grid', 'order' => 32200],
		'all_locations_container' => ['default_row_type' => 'grid', 'order' => 32200],
		'locations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Advertising\Model\AdCode\Locations',
			'details_pk' => ['am_adcodloc_location_id'],
			'order' => 35000
		],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'locations' => ['order' => 200, 'label_name' => 'Locations']
		]
	];
	public $elements = [
		'top' => [
			'am_adcode_id' => [
				'am_adcode_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Ad Code #', 'domain' => 'adcode_id_sequence', 'percent' => 50, 'navigation' => true],
				'am_adcode_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 45, 'required' => true, 'navigation' => true],
				'am_adcode_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'am_adcode_name' => [
				'am_adcode_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'locations' => [
				'all_locations' => ['container' => 'all_locations_container', 'order' => 100],
				'locations' => ['container' => 'locations_container', 'order' => 200]
			]
		],
		'general_container' => [
			'am_adcode_category_id' => [
				'am_adcode_category_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Category', 'domain' => 'group_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Advertising\Model\Categories::optionsActive'],
				'am_adcode_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			],
			'am_adcode_effective_from' => [
				'am_adcode_effective_from' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Effective From', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'am_adcode_effective_to' => ['order' => 2, 'label_name' => 'Effective To', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'am_adcode_hidden' => ['order' => 3, 'label_name' => 'Hidden', 'type' => 'boolean', 'percent' => 50],
			],
			'am_adcode_icon' => [
				'am_adcode_icon' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options'],
			]
		],
		'all_locations_container' => [
			'am_adcode_all_locations' => [
				'am_adcode_all_locations' => ['order' => 1, 'row_order' => 100, 'label_name' => 'All Locations', 'type' => 'boolean'],
			]
		],
		'locations_container' => [
			'row1' => [
				'am_adcodloc_location_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Location', 'domain' => 'location_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'onchange' => 'this.form.submit();'],
				'am_adcodloc_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Ad Codes',
		'model' => '\Numbers\Users\Advertising\Model\AdCodes',
		'details' => [
			'\Numbers\Users\Advertising\Model\AdCode\Locations' => [
				'name' => 'Locations',
				'pk' => ['am_adcodloc_tenant_id', 'am_adcodloc_adcode_id', 'am_adcodloc_location_id'],
				'type' => '1M',
				'map' => ['am_adcode_tenant_id' => 'am_adcodloc_tenant_id', 'am_adcode_id' => 'am_adcodloc_adcode_id'],
			]
		]
	];
}