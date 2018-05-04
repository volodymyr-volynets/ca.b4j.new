<?php

namespace Numbers\Users\Workflow\Form;
class Assignments extends \Object\Form\Wrapper\Base {
	public $form_link = 'ww_assignments';
	public $module_code = 'WW';
	public $title = 'W/W Assignments Form';
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
		'all_roles_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'roles_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Workflow\Model\Assignment\Roles',
			'details_pk' => ['ww_assignrol_role_id'],
			'order' => 35000
		],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Workflow\Model\Assignment\Organizations',
			'details_pk' => ['ww_assignorg_organization_id'],
			'required' => true,
			'order' => 35001
		]
	];
	public $rows = [
		'top' => [
			'ww_assignment_id' => ['order' => 100],
			'ww_assignment_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 200, 'label_name' => 'General'],
			'organizations' => ['order' => 225, 'label_name' => 'Organizations'],
			'roles' => ['order' => 250, 'label_name' => 'Roles'],
		]
	];
	public $elements = [
		'top' => [
			'ww_assignment_id' => [
				'ww_assignment_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Assignment #', 'domain' => 'service_id_sequence', 'percent' => 50, 'required' => false, 'navigation' => true],
				'ww_assignment_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 45, 'required' => true, 'navigation' => true],
				'ww_assignment_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'ww_assignment_name' => [
				'ww_assignment_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100],
			],
			'roles' => [
				'all_roles' => ['container' => 'all_roles_container', 'order' => 50],
				'roles' => ['container' => 'roles_container', 'order' => 100],
			]
		],
		'general_container' => [
			'ww_assignment_workflow_id' => [
				'ww_assignment_workflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow #', 'domain' => 'workflow_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflows::optionsActive', 'options_params' => ['ww_workflow_versioned' => 1]],
			],
			'ww_assignment_icon' => [
				'ww_assignment_icon' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			]
		],
		'all_roles_container' => [
			'ww_assignment_all_roles' => [
				'ww_assignment_all_roles' => ['order' => 1, 'row_order' => 100, 'label_name' => 'All Roles', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'roles_container' => [
			'row1' => [
				'ww_assignrol_role_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role', 'domain' => 'role_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Roles', 'onchange' => 'this.form.submit();'],
				'ww_assignrol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'organizations_container' => [
			'row1' => [
				'ww_assignorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'ww_assignorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Assignments',
		'model' => '\Numbers\Users\Workflow\Model\Assignments',
		'details' => [
			'\Numbers\Users\Workflow\Model\Assignment\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['ww_assignorg_tenant_id', 'ww_assignorg_assignment_id', 'ww_assignorg_organization_id'],
				'type' => '1M',
				'map' => ['ww_assignment_tenant_id' => 'ww_assignorg_tenant_id', 'ww_assignment_id' => 'ww_assignorg_assignment_id']
			],
			'\Numbers\Users\Workflow\Model\Assignment\Roles' => [
				'name' => 'Roles',
				'pk' => ['ww_assignrol_tenant_id', 'ww_assignrol_assignment_id', 'ww_assignrol_role_id'],
				'type' => '1M',
				'map' => ['ww_assignment_tenant_id' => 'ww_assignrol_tenant_id', 'ww_assignment_id' => 'ww_assignrol_assignment_id']
			]
		]
	];

	public function validate(& $form) {

	}

	public function processOptionsModels(& $form, $field_name, $details_key, $details_parent_key, & $where) {
		if ($field_name == 'ww_assignrol_role_id') {
			$where['selected_organizations'] = array_extract_values_by_key($form->values['\Numbers\Users\Workflow\Model\Assignment\Organizations'], 'ww_assignorg_organization_id', ['unique' => true]);
		}
	}
}