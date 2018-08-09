<?php

namespace Numbers\Users\APIs\Form;
class Roles extends \Object\Form\Wrapper\Base {
	public $form_link = 'ua_roles';
	public $module_code = 'UA';
	public $title = 'U/A Roles Form';
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
		'permissions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\APIs\Model\Role\Permissions',
			'details_pk' => ['ua_apirolperm_resource_id'],
			'order' => 800
		],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'ua_apirol_id' => [
				'ua_apirol_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role #', 'domain' => 'role_id_sequence', 'percent' => 50, 'navigation' => true],
				'ua_apirol_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'ua_apirol_name' => [
				'ua_apirol_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 85, 'required' => true],
				'ua_apirol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			],
			'ua_apirol_icon' => [
				'ua_apirol_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 75, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
				'ua_apirol_weight' => ['order' => 2, 'label_name' => 'Weight', 'domain' => 'weight', 'null' => true],
			]
		],
		'permissions_container' => [
			'row1' => [
				'ua_apirolperm_resource_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Resource', 'domain' => 'resource_id', 'required' => true, 'null' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\ACL\Controllers2::optionsJson', 'options_params' => ['sm_resource_acl_permission' => 1, 'acl_handle_exceptions' => true, 'sm_resource_type' => 150], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'ua_apirolperm_module_id', 'resource_id' => 'ua_apirolperm_resource_id']],
				'ua_apirolperm_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'ua_apirolperm_module_id' => ['order' => 1, 'label_name' => 'Module #', 'domain' => 'module_id', 'required' => true, 'null' => true, 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];

	public $collection = [
		'name' => 'Roles',
		'model' => '\Numbers\Users\APIs\Model\Roles',
		'details' => [
			'\Numbers\Users\APIs\Model\Role\Permissions' => [
				'name' => 'Permissions',
				'pk' => ['ua_apirolperm_tenant_id', 'ua_apirolperm_role_id', 'ua_apirolperm_module_id', 'ua_apirolperm_resource_id'],
				'type' => '1M',
				'map' => ['ua_apirol_tenant_id' => 'ua_apirolperm_tenant_id', 'ua_apirol_id' => 'ua_apirolperm_role_id']
			],
		]
	];

	public function validate(& $form) {

	}
}