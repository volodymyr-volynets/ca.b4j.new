<?php

namespace Numbers\Users\Organizations\Form\Service\Workflow;
class Dashboards extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_dashboards';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Dashboards Form';
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
		'roles_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboard\Roles',
			'details_pk' => ['on_workdashrol_role_id'],
			'required' => true,
			'order' => 35000
		],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboard\Organizations',
			'details_pk' => ['on_workdashorg_organization_id'],
			'required' => true,
			'order' => 35001
		],
	];
	public $rows = [
		'top' => [
			'on_workdashboard_id' => ['order' => 100],
			'on_workdashboard_name' => ['order' => 200],
		],
		'tabs' => [
			'organizations' => ['order' => 100, 'label_name' => 'Organizations'],
			'roles' => ['order' => 200, 'label_name' => 'Roles'],
		],
	];
	public $elements = [
		'top' => [
			'on_workdashboard_id' => [
				'on_workdashboard_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Dashboard #', 'domain' => 'dashboard_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_workdashboard_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_workdashboard_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_workdashboard_name' => [
				'on_workdashboard_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_workdashboard_icon' => [
				'on_workdashboard_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'tabs' => [
			'roles' => [
				'roles' => ['container' => 'roles_container', 'order' => 100],
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100],
			],
		],
		'roles_container' => [
			'row1' => [
				'on_workdashrol_role_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role', 'domain' => 'role_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Roles', 'onchange' => 'this.form.submit();'],
				'on_workdashrol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'organizations_container' => [
			'row1' => [
				'on_workdashorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_workdashorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Workflow Dashboards',
		'model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Dashboards',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\Workflow\Dashboard\Roles' => [
				'name' => 'Roles',
				'pk' => ['on_workdashrol_tenant_id', 'on_workdashrol_dashboard_id', 'on_workdashrol_role_id'],
				'type' => '1M',
				'map' => ['on_workdashboard_tenant_id' => 'on_workdashrol_tenant_id', 'on_workdashboard_id' => 'on_workdashrol_dashboard_id']
			],
			'\Numbers\Users\Organizations\Model\Service\Workflow\Dashboard\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['on_workdashorg_tenant_id', 'on_workdashorg_dashboard_id', 'on_workdashorg_organization_id'],
				'type' => '1M',
				'map' => ['on_workdashboard_tenant_id' => 'on_workdashorg_tenant_id', 'on_workdashboard_id' => 'on_workdashorg_dashboard_id']
			],
		]
	];

	public function processOptionsModels(& $form, $field_name, $details_key, $details_parent_key, & $where, $neighbouring_values, $details_value) {
		if ($field_name == 'on_workdashrol_role_id') {
			$where['selected_organizations'] = array_extract_values_by_key($form->values['\Numbers\Users\Organizations\Model\Service\Workflow\Dashboard\Organizations'], 'on_workdashorg_organization_id', ['unique' => true]);
		}
	}
}