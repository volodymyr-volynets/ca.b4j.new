<?php

namespace Numbers\Users\Organizations\Form;
class Divisions extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_divisions';
	public $module_code = 'ON';
	public $title = 'O/N Divisions Form';
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
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Division\Organizations',
			'details_pk' => ['on_diviorg_organization_id'],
			'required' => true,
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'on_division_id' => ['order' => 100],
			'on_division_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 250, 'label_name' => 'General'],
			'organizations' => ['order' => 300, 'label_name' => 'Organizations'],
		]
	];
	public $elements = [
		'top' => [
			'on_division_id' => [
				'on_division_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Division #', 'domain' => 'division_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_division_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_division_name' => [
				'on_division_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_division_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100]
			]
		],
		'organizations_container' => [
			'row1' => [
				'on_diviorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_diviorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'general_container' => [
			'on_division_type_id' => [
				'on_division_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'required' => true, 'percent' => 50, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Users\Organizations\Model\Division\Types', 'onchange' => 'this.form.submit();'],
				'on_division_region_id' => ['order' => 2, 'label_name' => 'Region', 'domain' => 'country_number', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Regions::optionsActive'],
			],
			'on_division_parent_organization_id' => [
				'on_division_parent_organization_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent Organization', 'domain' => 'organization_id', 'null' => true, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
				'on_division_parent_division_id' => ['order' => 2, 'label_name' => 'Parent Division', 'domain' => 'division_id', 'null' => true, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Divisions::optionsActive', 'options_params' => ['on_division_type_id' => 10]],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Brands',
		'model' => '\Numbers\Users\Organizations\Model\Divisions',
		'details' => [
			'\Numbers\Users\Organizations\Model\Division\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['on_diviorg_tenant_id', 'on_diviorg_division_id', 'on_diviorg_organization_id'],
				'type' => '1M',
				'map' => ['on_division_tenant_id' => 'on_diviorg_tenant_id', 'on_division_id' => 'on_diviorg_division_id'],
			]
		]
	];

	public function validate(& $form) {
		if ($form->values['on_division_type_id'] == 10) {
			if (empty($form->values['on_division_parent_organization_id'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'on_division_parent_organization_id');
			}
			$form->values['on_division_parent_division_id'] = null;
		}
		if ($form->values['on_division_type_id'] == 20) {
			if (empty($form->values['on_division_parent_division_id'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'on_division_parent_division_id');
			}
			$form->values['on_division_parent_organization_id'] = null;
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'on_division_parent_organization_id') {
			if ($neighbouring_values['on_division_type_id'] == 20) {
				$options['options']['readonly'] = true;
				$value = null;
			}
		}
		if ($options['options']['field_name'] == 'on_division_parent_division_id') {
			if ($neighbouring_values['on_division_type_id'] == 10) {
				$options['options']['readonly'] = true;
				$value = null;
			}
		}
	}
}