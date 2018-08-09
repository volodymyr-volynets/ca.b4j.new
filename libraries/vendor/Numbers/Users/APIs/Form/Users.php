<?php

namespace Numbers\Users\APIs\Form;
class Users extends \Object\Form\Wrapper\Base {
	public $form_link = 'ua_users';
	public $module_code = 'UA';
	public $title = 'U/A Users Form';
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
		'general_container' => ['default_row_type' => 'grid', 'order' => 110],
		'tabs' => ['default_row_type' => 'grid', 'order' => 200, 'type' => 'tabs'],
		'permissions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\APIs\Model\User\Permissions',
			'details_pk' => ['ua_apiusrperm_resource_id'],
			'order' => 800
		],
		'roles_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\APIs\Model\User\Roles',
			'details_pk' => ['ua_apiusrrol_role_id'],
			'order' => 850
		],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'roles' => ['order' => 400, 'label_name' => 'Roles'],
			'permissions' => ['order' => 440, 'label_name' => 'Permissions'],
		]
	];
	public $elements = [
		'top' => [
			'ua_apiusr_id' => [
				'ua_apiusr_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User #', 'domain' => 'user_id_sequence', 'percent' => 50, 'navigation' => true],
				'ua_apiusr_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => 'c', 'navigation' => true]
			],
			'ua_apiusr_name' => [
				'ua_apiusr_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 70, 'required' => true],
				'ua_apiusr_hold' => ['order' => 2, 'label_name' => 'Hold', 'type' => 'boolean', 'percent' => 15],
				'ua_apiusr_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'roles' => [
				'roles' => ['container' => 'roles_container', 'order' => 100],
			],
			'permissions' => [
				'permissions' => ['container' => 'permissions_container', 'order' => 100],
			]
		],
		'general_container' => [
			'ua_apiusr_login_username' => [
				'ua_apiusr_login_username' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Username', 'domain' => 'login', 'null' => true, 'required' => true, 'percent' => 50],
				'ua_apiusr_login_password_new' => ['order' => 2, 'label_name' => 'Password', 'domain' => 'password', 'null' => true, 'required' => 'c', 'percent' => 50, 'method' => 'password', 'empty_value' => true],
			],
			'ua_apiusr_user_id' => [
				'ua_apiusr_user_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Assigned User', 'domain' => 'user_id', 'null' => true, 'required' => true, 'method' => 'select', 'searchable' => true, 'options_model' => '\Numbers\Users\Users\DataSource\Users::optionsActive'],
			]
		],
		'roles_container' => [
			'row1' => [
				'ua_apiusrrol_role_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role', 'domain' => 'role_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\APIs\Model\Roles::optionsActive', 'onchange' => 'this.form.submit();'],
				'ua_apiusrrol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'permissions_container' => [
			'row1' => [
				'ua_apiusrperm_resource_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Resource', 'domain' => 'resource_id', 'required' => true, 'null' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\ACL\Controllers2::optionsJson', 'options_params' => ['sm_resource_acl_permission' => 1, 'acl_handle_exceptions' => true, 'sm_resource_type' => 150], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'ua_apiusrperm_module_id', 'resource_id' => 'ua_apiusrperm_resource_id']],
				'ua_apiusrperm_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'ua_apiusrperm_module_id' => ['order' => 1, 'label_name' => 'Module #', 'domain' => 'module_id', 'required' => true, 'null' => true, 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];

	public $collection = [
		'name' => 'Users',
		'model' => '\Numbers\Users\APIs\Model\Users',
		'details' => [
			'\Numbers\Users\APIs\Model\User\Permissions' => [
				'name' => 'Permissions',
				'pk' => ['ua_apiusrperm_tenant_id', 'ua_apiusrperm_user_id', 'ua_apiusrperm_module_id', 'ua_apiusrperm_resource_id'],
				'type' => '1M',
				'map' => ['ua_apiusr_tenant_id' => 'ua_apiusrperm_tenant_id', 'ua_apiusr_id' => 'ua_apiusrperm_user_id']
			],
			'\Numbers\Users\APIs\Model\User\Roles' => [
				'name' => 'Roles',
				'pk' => ['ua_apiusrrol_tenant_id', 'ua_apiusrrol_user_id', 'ua_apiusrrol_role_id'],
				'type' => '1M',
				'map' => ['ua_apiusr_tenant_id' => 'ua_apiusrrol_tenant_id', 'ua_apiusr_id' => 'ua_apiusrrol_user_id']
			]
		]
	];

	public function validate(& $form) {
		if (!$form->values_loaded && empty($form->values['ua_apiusr_login_password_new'])) {
			$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'ua_apiusr_login_password_new');
		}
		if (!$form->hasErrors()) {
			if (!empty($form->values['ua_apiusr_login_password_new'])) {
				$crypt = new \Crypt();
				$form->values['ua_apiusr_login_password'] = $crypt->passwordHash($form->values['ua_apiusr_login_password_new']);
			}
		}
	}
}