<?php

namespace Numbers\Users\Organizations\Form;
class StrategicBusinessUnits extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_sbu';
	public $module_code = 'ON';
	public $title = 'O/N Strategic Business Units Form';
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
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations',
			'details_pk' => ['on_sborg_organization_id'],
			'required' => true,
			'order' => 35000
		],
	];
	public $rows = [
		'top' => [
			'on_sbu_id' => ['order' => 100],
			'on_sbu_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'children' => ['order' => 200, 'label_name' => 'Organizations'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		]
	];
	public $elements = [
		'top' => [
			'on_sbu_id' => [
				'on_sbu_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'SBU #', 'domain' => 'sbu_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_sbu_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_sbu_name' => [
				'on_sbu_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
				'contact' => ['container' => 'contact_container', 'order' => 200]
			],
			'children' => [
				'children' => ['container' => 'organizations_container', 'order' => 100]
			]
		],
		'general_container' => [
			'on_sbu_default_organization_id' => [
				'on_sbu_parent_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Parent Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 90, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
				'on_sbu_hold' => ['order' => 3, 'label_name' => 'Hold', 'type' => 'boolean', 'percent' => 5],
				'on_sbu_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_sbu_parent_division_id' => [
				'on_sbu_parent_division_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent Division/Subdivision', 'domain' => 'division_id', 'null' => true, 'required' => false, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Divisions::optionsActive'],
			],
			'separator_1' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 400, 'label_name' => 'Contact Information', 'icon' => 'far fa-envelope', 'percent' => 100],
			],
			'on_sbu_email' => [
				'on_sbu_email' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
				'on_sbu_email2' => ['order' => 2, 'label_name' => 'Secondary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'on_sbu_phone' => [
				'on_sbu_phone' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'on_sbu_phone2' => ['order' => 2, 'label_name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'on_sbu_cell' => [
				'on_sbu_cell' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Cell Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'on_sbu_fax' => ['order' => 2, 'label_name' => 'Fax', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			]
		],
		'organizations_container' => [
			'row1' => [
				'on_sborg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 90, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_sborg_primary' => ['order' => 2, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 5],
				'on_sborg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Strategic Business Units',
		'model' => '\Numbers\Users\Organizations\Model\StrategicBusinessUnits',
		'details' => [
			'\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['on_sborg_tenant_id', 'on_sborg_sbu_id', 'on_sborg_organization_id'],
				'type' => '1M',
				'map' => ['on_sbu_tenant_id' => 'on_sborg_tenant_id', 'on_sbu_id' => 'on_sborg_sbu_id'],
			]
		]
	];

	public function validate(& $form) {
		// primary organizations
		$primary_found = 0;
		$primary_first_line = null;
		foreach ($form->values['\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations'] as $k => $v) {
			if (!isset($primary_first_line)) {
				$primary_first_line = "\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations[{$k}][on_sborg_primary]";
			}
			if (!empty($v['on_sborg_primary'])) {
				$primary_found++;
				if (!empty($v['on_sborg_inactive'])) {
					$form->error(DANGER, 'Primary cannot be inactive!', "\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations[{$k}][on_sborg_inactive]");
				}
				if ($primary_found > 1) {
					$form->error(DANGER, 'There can be only one primary organization!', "\Numbers\Users\Organizations\Model\StrategicBusinessUnit\Organizations[{$k}][on_sborg_primary]");
				}
			}
		}
		if ($primary_found == 0) {
			$form->error(DANGER, 'You must select primary organization!', $primary_first_line);
		}
	}
}