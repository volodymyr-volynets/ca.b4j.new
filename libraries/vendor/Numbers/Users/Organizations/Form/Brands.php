<?php

namespace Numbers\Users\Organizations\Form;
class Brands extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_brands';
	public $module_code = 'ON';
	public $title = 'O/N Brands Form';
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
		'logo_container' => ['default_row_type' => 'grid', 'order' => 32200],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Brand\Organizations',
			'details_pk' => ['on_brndorg_organization_id'],
			'required' => true,
			'order' => 35000
		],
		'trademarks_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Brand\Trademarks',
			'details_pk' => ['on_brndtrdmrk_trademark_id'],
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'on_brand_id' => ['order' => 100],
			'on_brand_name' => ['order' => 200],
		],
		'tabs' => [
			'organizations' => ['order' => 300, 'label_name' => 'Organizations'],
			'trademarks' => ['order' => 400, 'label_name' => 'Trademarks'],
			'logo' => ['order' => 500, 'label_name' => 'Logo'],
		]
	];
	public $elements = [
		'top' => [
			'on_brand_id' => [
				'on_brand_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Brand #', 'domain' => 'brand_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_brand_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_brand_name' => [
				'on_brand_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_brand_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100]
			],
			'trademarks' => [
				'trademarks' => ['container' => 'trademarks_container', 'order' => 100]
			],
			'logo' => [
				'logo' => ['container' => 'logo_container', 'order' => 100]
			]
		],
		'organizations_container' => [
			'row1' => [
				'on_brndorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 80, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_brndorg_primary' => ['order' => 2, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 15],
				'on_brndorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'trademarks_container' => [
			'row1' => [
				'on_brndtrdmrk_trademark_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Trademark', 'domain' => 'trademark_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Trademarks::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_brndtrdmrk_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'logo_container' => [
			'__logo_upload' => [
				'__logo_upload' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Upload Logo', 'type' => 'mixed', 'method' => 'file', 'validator_method' => '\Numbers\Users\Documents\Base\Validator\Files::validate', 'validator_params' => ['types' => ['images'], 'image_size' => '200x80', 'thumbnail_size' => '125x50'], 'description' => 'Extensions: ' . \Numbers\Users\Documents\Base\Helper\Validate::IMAGE_EXTENSIONS . '. Size: 200x80.'],
			],
			'__logo_preview' => [
				'__logo_preview' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Preview Logo', 'custom_renderer' => '\Numbers\Users\Documents\Base\Helper\Preview::renderPreview', 'preview_file_id' => 'on_brand_logo_file_id'],
			],
			self::HIDDEN => [
				'on_brand_logo_file_id' => ['label_name' => 'Logo File #', 'domain' => 'file_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Brands',
		'model' => '\Numbers\Users\Organizations\Model\Brands',
		'details' => [
			'\Numbers\Users\Organizations\Model\Brand\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['on_brndorg_tenant_id', 'on_brndorg_brand_id', 'on_brndorg_organization_id'],
				'type' => '1M',
				'map' => ['on_brand_tenant_id' => 'on_brndorg_tenant_id', 'on_brand_id' => 'on_brndorg_brand_id'],
			],
			'\Numbers\Users\Organizations\Model\Brand\Trademarks' => [
				'name' => 'Trademarks',
				'pk' => ['on_brndtrdmrk_tenant_id', 'on_brndtrdmrk_brand_id', 'on_brndtrdmrk_trademark_id'],
				'type' => '1M',
				'map' => ['on_brand_tenant_id' => 'on_brndtrdmrk_tenant_id', 'on_brand_id' => 'on_brndtrdmrk_brand_id'],
			]
		]
	];

	public function validate(& $form) {
		$primary_organization_id = $form->validateDetailsPrimaryColumn(
			'\Numbers\Users\Organizations\Model\Brand\Organizations',
			'on_brndorg_primary',
			'on_brndorg_inactive',
			'on_brndorg_organization_id'
		);
		// logo
		if (!$form->hasErrors() && !empty($form->values['__logo_upload'])) {
			$form->values['__logo_upload']['__image_properties'] = $form->fields['__logo_upload']['options']['validator_params'] ?? [];
			$model = new \Numbers\Users\Documents\Base\Base();
			// remove file if exists
			if (!empty($form->values['on_brand_logo_file_id'])) {
				$result = $model->delete($form->values['on_brand_logo_file_id']);
				if (!$result['success']) {
					$form->error(DANGER, $result['error']);
					return;
				}
				$form->values['on_brand_logo_file_id'] = null;
			}
			// add file
			$catalog = $model->fetchPrimaryCatalog($primary_organization_id);
			if (empty($catalog)) {
				$form->error(DANGER, 'You must set primary catalog!');
				return;
			}
			$result = $model->upload($form->values['__logo_upload'], $catalog);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				return;
			}
			$form->values['on_brand_logo_file_id'] = $result['file_id'];
		}
	}

	public function overrideTabs(& $form, & $options, & $tab, & $neighbouring_values) {
		$result = [];
		if ($tab == 'logo' && empty($form->values['on_brand_id'])) {
			$result['hidden'] = true;
		}
		return $result;
	}
}