<?php

namespace Numbers\Users\Organizations\Form\Location;
class Territories extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_location_territories';
	public $module_code = 'ON';
	public $title = 'O/N Location Territories Form';
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
		'locations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Location\Territory\Locations',
			'details_pk' => ['on_terrloc_location_id'],
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'on_territory_id' => ['order' => 100],
			'on_territory_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 300, 'label_name' => 'General'],
			'locations' => ['order' => 400, 'label_name' => 'Locations'],
		]
	];
	public $elements = [
		'top' => [
			'on_territory_id' => [
				'on_territory_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Territory #', 'domain' => 'territory_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_territory_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'navigation' => true]
			],
			'on_territory_name' => [
				'on_territory_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_territory_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'locations' => [
				'locations' => ['container' => 'locations_container', 'order' => 100]
			]
		],
		'general_container' => [
			'on_territory_node_type_id' => [
				'on_territory_node_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Node Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territory\NodeTypes', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
				'on_territory_type_id' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'percent' => 25, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territory\Types', 'onchange' => 'this.form.submit();'],
				'on_territory_organization_id' => ['order' => 3, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			'on_territory_parent_territory_id' => [
				'on_territory_parent_territory_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent Territory', 'domain' => 'territory_id', 'null' => true, 'percent' => 100, 'method' => 'select', 'tree' => true, 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territories::optionsGroupped', 'options_depends' => ['on_territory_type_id' => 'on_territory_type_id', 'on_territory_organization_id' => 'on_territory_organization_id'], 'options_params' => ['on_territory_node_type_id' => [10, 20]]],
			],
			'on_territory_country_code' => [
				'on_territory_country_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_territory_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'on_territory_country_code']],
			],
			'on_territory_postal_codes' => [
				'on_territory_postal_codes' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Postal Codes', 'domain' => 'postal_codes', 'null' => true, 'method' => 'textarea'],
			]
		],
		'locations_container' => [
			'row1' => [
				'on_terrloc_location_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Location', 'domain' => 'location_id', 'required' => true, 'null' => true, 'percent' => 80, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'options_depends' => ['on_location_organization_id' => 'parent::on_territory_organization_id', 'on_location_country_code' => 'parent::on_territory_country_code']],
				'on_terrloc_primary' => ['order' => 2, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 15],
				'on_terrloc_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Territories',
		'model' => '\Numbers\Users\Organizations\Model\Location\Territories',
		'details' => [
			'\Numbers\Users\Organizations\Model\Location\Territory\Locations' => [
				'name' => 'Organizations',
				'pk' => ['on_terrloc_tenant_id', 'on_terrloc_territory_id', 'on_terrloc_location_id'],
				'type' => '1M',
				'map' => ['on_territory_tenant_id' => 'on_terrloc_tenant_id', 'on_territory_id' => 'on_terrloc_territory_id'],
			]
		]
	];

	public function validate(& $form) {
		// leaf validations
		if ($form->values['on_territory_node_type_id'] == 30) {
			if (empty($form->values['on_territory_province_code'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'on_territory_province_code');
			}
			// postal codes type
			if ($form->values['on_territory_type_id'] == 13) {
				if (empty($form->values['on_territory_postal_codes'])) {
					$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'on_territory_postal_codes');
				} else {
					$form->values['on_territory_postal_codes'] = strtoupper(trim2($form->values['on_territory_postal_codes']));
				}
			} else { // county
				$form->values['on_territory_postal_codes'] = null;
			}
			if (empty($form->values['\Numbers\Users\Organizations\Model\Location\Territory\Locations'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, '\Numbers\Users\Organizations\Model\Location\Territory\Locations[1][on_terrloc_location_id]');
			}
		}
		// primary location
		$form->validateDetailsPrimaryColumn(
			'\Numbers\Users\Organizations\Model\Location\Territory\Locations',
			'on_terrloc_primary',
			'on_terrloc_inactive',
			'on_terrloc_location_id'
		);
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'on_territory_postal_codes') {
			if (empty($form->values['on_territory_node_type_id']) || in_array($form->values['on_territory_node_type_id'], [10, 20]) || $form->values['on_territory_type_id'] != 13) {
				$options['options']['row_class'] = 'grid_row_hidden';
			}
		}
		if ($options['options']['field_name'] == 'on_territory_parent_territory_id') {
			if (empty($form->values['on_territory_node_type_id']) || in_array($form->values['on_territory_node_type_id'], [10])) {
				$options['options']['row_class'] = 'grid_row_hidden';
			}
		}
	}

	public function overrideTabs(& $form, & $options, & $tab, & $neighbouring_values) {
		$result = [];
		if ($tab == 'locations' && (empty($form->values['on_territory_node_type_id']) || in_array($form->values['on_territory_node_type_id'], [10, 20]))) {
			$result['hidden'] = true;
		}
		return $result;
	}
}