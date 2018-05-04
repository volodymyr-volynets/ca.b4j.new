<?php

namespace Numbers\Users\Organizations\Form;
class Locations extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_locations';
	public $module_code = 'ON';
	public $title = 'O/N Locations Form';
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
		'contact_container' => ['default_row_type' => 'grid', 'order' => 32100],
		'logo_container' => ['default_row_type' => 'grid', 'order' => 32200],
	];
	public $rows = [
		'top' => [
			'on_location_id' => ['order' => 100],
			'on_location_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'contact' => ['order' => 200, 'label_name' => 'Contact'],
			'primary_address' => ['order' => 300, 'label_name' => 'Primary Address'],
			'logo' => ['order' => 500, 'label_name' => 'Logo'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		]
	];
	public $elements = [
		'top' => [
			'on_location_id' => [
				'on_location_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Location #', 'domain' => 'location_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_location_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 45, 'required' => true, 'navigation' => true],
				'on_location_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_location_name' => [
				'on_location_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_location_hold' => ['order' => 2, 'label_name' => 'Hold', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'contact' => [
				'contact' => ['container' => 'contact_container', 'order' => 100]
			],
			'primary_address' => [
				'primary_address' => ['container' => 'primary_address_container', 'order' => 100]
			],
			'logo' => [
				'logo' => ['container' => 'logo_container', 'order' => 100]
			]
		],
		'general_container' => [
			'on_location_organization_id' => [
				'on_location_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Types'],
				'on_location_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
			],
			'on_location_brand_id' => [
				'on_location_brand_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive'],
				'on_location_district_id' => ['order' => 2, 'label_name' => 'District', 'domain' => 'district_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Districts::optionsActive'],
			],
			'on_location_market_id' => [
				'on_location_market_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Market', 'domain' => 'market_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Markets::optionsActive'],
				'on_location_region_id' => ['order' => 2, 'label_name' => 'Region', 'domain' => 'region_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Regions::optionsActive'],
			],
			'on_location_item_master_id' => [
				'on_location_item_master_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Item Master', 'domain' => 'item_master_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\ItemMasters::optionsActive'],
			]
		],
		'contact_container' => [
			'on_location_email' => [
				'on_location_email' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
				'on_location_email2' => ['order' => 2, 'label_name' => 'Secondary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'on_location_phone' => [
				'on_location_phone' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'on_location_phone2' => ['order' => 2, 'label_name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'on_location_cell' => [
				'on_location_cell' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Cell Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'on_location_fax' => ['order' => 2, 'label_name' => 'Fax', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			]
		],
		'primary_address_container' => [
			'on_location_address_line1' => [
				'on_location_address_line1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Address Line 1', 'domain' => 'name', 'required' => true, 'percent' => 50],
				'on_location_address_line2' => ['order' => 2, 'label_name' => 'Address Line 2', 'domain' => 'name', 'null' => true, 'percent' => 50],
			],
			'on_location_city' => [
				'on_location_city' => ['order' => 1, 'row_order' => 200, 'label_name' => 'City', 'domain' => 'name', 'required' => true, 'percent' => 50],
				'on_location_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'required' => true, 'percent' => 50],
			],
			'on_location_country_code' => [
				'on_location_country_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_location_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'on_location_country_code']],
			],
			'on_location_latitude' => [
				'on_location_latitude' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Latitude', 'domain' => 'geo_coordinate', 'required' => true],
				'on_location_longitude' => ['order' => 2, 'label_name' => 'Longitude', 'domain' => 'geo_coordinate', 'required' => true],
			]
		],
		'logo_container' => [
			'__logo_upload' => [
				'__logo_upload' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Upload Logo', 'type' => 'mixed', 'method' => 'file', 'validator_method' => '\Numbers\Users\Documents\Base\Validator\Files::validate', 'validator_params' => ['types' => ['images'], 'image_size' => '200x80', 'thumbnail_size' => '125x50'], 'description' => 'Extensions: ' . \Numbers\Users\Documents\Base\Helper\Validate::IMAGE_EXTENSIONS . '. Size: 200x80.'],
			],
			'__logo_preview' => [
				'__logo_preview' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Preview Logo', 'custom_renderer' => '\Numbers\Users\Documents\Base\Helper\Preview::renderPreview', 'preview_file_id' => 'on_location_logo_file_id'],
			],
			self::HIDDEN => [
				'on_location_logo_file_id' => ['label_name' => 'Logo File #', 'domain' => 'file_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Locations',
		'model' => '\Numbers\Users\Organizations\Model\Locations'
	];

	public function validate(& $form) {
		if (!$form->hasErrors() && !empty($form->values['__logo_upload'])) {
			$form->values['__logo_upload']['__image_properties'] = $form->fields['__logo_upload']['options']['validator_params'] ?? [];
			$model = new \Numbers\Users\Documents\Base\Base();
			// remove file if exists
			if (!empty($form->values['on_location_logo_file_id'])) {
				$result = $model->delete($form->values['on_location_logo_file_id']);
				if (!$result['success']) {
					$form->error(DANGER, $result['error']);
					return;
				}
				$form->values['on_location_logo_file_id'] = null;
			}
			// add file
			$catalog = $model->fetchPrimaryCatalog($form->values['on_location_organization_id']);
			if (empty($catalog)) {
				$form->error(DANGER, 'You must set primary catalog!');
				return;
			}
			$result = $model->upload($form->values['__logo_upload'], $catalog);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				return;
			}
			$form->values['on_location_logo_file_id'] = $result['file_id'];
		}
	}

	public function overrideTabs(& $form, & $options, & $tab, & $neighbouring_values) {
		$result = [];
		if ($tab == 'logo' && empty($form->values['on_location_organization_id'])) {
			$result['hidden'] = true;
		}
		return $result;
	}
}