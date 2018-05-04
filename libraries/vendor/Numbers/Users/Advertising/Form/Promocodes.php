<?php

namespace Numbers\Users\Advertising\Form;
class Promocodes extends \Object\Form\Wrapper\Base {
	public $form_link = 'am_promocodes';
	public $module_code = 'AM';
	public $title = 'A/M Promocodes Form';
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
		'barcode_container' => ['default_row_type' => 'grid', 'order' => 32200],
		'locations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Advertising\Model\Promocode\Locations',
			'details_pk' => ['am_promoloc_location_id'],
			'order' => 35000
		],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'locations' => ['order' => 200, 'label_name' => 'Locations'],
			'barcode' => ['order' => 300, 'label_name' => 'Barcode'],
		]
	];
	public $elements = [
		'top' => [
			'am_promocode_id' => [
				'am_promocode_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Category #', 'domain' => 'promocode_id_sequence', 'percent' => 50, 'navigation' => true],
				'am_promocode_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 45, 'required' => true, 'navigation' => true],
				'am_promocode_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'am_promocode_name' => [
				'am_promocode_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'am_promocode_promocode' => [
				'am_promocode_promocode' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Promocode', 'domain' => 'promocode', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'locations' => [
				'all_locations' => ['container' => 'all_locations_container', 'order' => 100],
				'locations' => ['container' => 'locations_container', 'order' => 200]
			],
			'barcode' => [
				'barcode' => ['container' => 'barcode_container', 'order' => 100],
			]
		],
		'general_container' => [
			'am_promocode_category_id' => [
				'am_promocode_category_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Category', 'domain' => 'group_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Advertising\Model\Categories::optionsActive'],
				'am_promocode_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			],
			'am_promocode_brand_id' => [
				'am_promocode_brand_id' => ['order' => 1, 'row_order' => 150, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive'],
				'am_promocode_effective_from' => ['order' => 2, 'label_name' => 'Effective From', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'am_promocode_effective_to' => ['order' => 3, 'label_name' => 'Effective To', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'am_promocode_description' => [
				'am_promocode_description' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Description', 'domain' => 'description', 'percent' => 100, 'method' => 'textarea']
			]
		],
		'all_locations_container' => [
			'am_promocode_all_locations' => [
				'am_promocode_all_locations' => ['order' => 1, 'row_order' => 100, 'label_name' => 'All Locations', 'type' => 'boolean'],
			]
		],
		'locations_container' => [
			'row1' => [
				'am_promoloc_location_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Location', 'domain' => 'location_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'onchange' => 'this.form.submit();'],
				'am_promoloc_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'barcode_container' => [
			'am_promocode_barcode' => [
				'am_promocode_barcode' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Barcode', 'domain' => 'barcode', 'null' => true, 'percent' => 100],
			],
			'__barcode_preview' => [
				'__barcode_preview' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Preview', 'domain' => 'barcode', 'null' => true, 'percent' => 100, 'custom_renderer' => '\Numbers\Users\Advertising\Form\Promocodes::previewBarcode']
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Promocodes',
		'model' => '\Numbers\Users\Advertising\Model\Promocodes',
		'details' => [
			'\Numbers\Users\Advertising\Model\Promocode\Locations' => [
				'name' => 'Locations',
				'pk' => ['am_promoloc_tenant_id', 'am_promoloc_promocode_id', 'am_promoloc_location_id'],
				'type' => '1M',
				'map' => ['am_promocode_tenant_id' => 'am_promoloc_tenant_id', 'am_promocode_id' => 'am_promoloc_promocode_id'],
			]
		]
	];

	public function previewBarcode(& $form) {
		$result = '<br/>';
		if (!empty($form->values['am_promocode_barcode']) && \Can::submoduleExists('Numbers\Backend\IO\PDF')) {
			$result.= \Numbers\Backend\IO\PDF\Barcode::renderAsHTML($form->values['am_promocode_barcode'], \Numbers\Backend\IO\PDF\Barcode::DEFAULT_BARCODE_TYPE, 2, 30, 'black');
		}
		return $result;
	}
}