<?php

namespace Numbers\Users\Users\Form\Account;
class Message extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_user_message';
	public $module_code = 'UM';
	public $title = 'U/M Account Message Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => ['href' => '/Numbers/Users/Users/Controller/Account/Messages/_New'],
			'back' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Organizations',
			'details_pk' => ['organization_id'],
			'details_cannot_delete' => false,
			'required' => true,
			'order' => 35001
		],
		'roles_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\Roles',
			'details_pk' => ['role_id'],
			'details_cannot_delete' => false,
			'order' => 35000
		],
		'users_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\Users',
			'details_pk' => ['user_id'],
			'details_cannot_delete' => false,
			'required' => true,
			'order' => 35000
		],
	];
	public $rows = [
		'top' => [
			'subject' => ['order' => 100],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'organizations' => ['order' => 200, 'label_name' => 'Organizations'],
			'roles' => ['order' => 300, 'label_name' => 'Roles'],
			'users' => ['order' => 400, 'label_name' => 'Users'],
		]
	];
	public $elements = [
		'top' => [
			'subject' => [
				'subject' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Message Subject', 'domain' => 'subject', 'required' => true, 'percent' => 90],
				'important' => ['order' => 2, 'label_name' => 'Important', 'type' => 'boolean', 'percent' => 10]
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
				'roles' => ['container' => 'roles_container', 'order' => 100],
			],
			'users' => [
				'users' => ['container' => 'users_container', 'order' => 100],
			],
		],
		'general_container' => [
			'body' => [
				'body' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Message Body', 'type' => 'text', 'percent' => 100, 'required' => true, 'method' => 'wysiwyg'],
			]
		],
		'organizations_container' => [
			'row1' => [
				'organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'persistent' => true, 'details_unique_select' => true, 'searchable' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
			]
		],
		'roles_container' => [
			'row1' => [
				'role_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role', 'domain' => 'role_id', 'required' => true, 'null' => true, 'persistent' => true, 'details_unique_select' => true, 'searchable' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Roles', 'options_params' => ['skip_acl' => true], 'onchange' => 'this.form.submit();'],
			]
		],
		'users_container' => [
			'row1' => [
				'user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User', 'domain' => 'user_id', 'required' => true, 'null' => true, 'persistent' => true, 'details_unique_select' => true, 'searchable' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Users', 'options_params' => ['skip_acl' => true], 'onchange' => 'this.form.submit();'],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT=> self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function validate(& $form) {
		// if we have users
		$user_list = [];
		if (!empty($form->values['\Numbers\Users\Users\Model\Users'])) {
			$user_list = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\Users'], 'user_id', ['unique' => true]);
		} else if (!empty($form->values['\Numbers\Users\Users\Model\Roles'])) {
			// fetch all users with a role
			$temp = \Numbers\Users\Users\Model\User\Roles::getStatic([
				'where' => [
					'um_usrrol_role_id' => array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\Roles'], 'role_id', ['unique' => true])
				],
				'pk' =>  ['um_usrrol_user_id']
			]);
			$user_list = array_keys($temp);
		} else if (!empty($form->values['\Numbers\Users\Organizations\Model\Organizations'])) {
			$temp = \Numbers\Users\Users\Model\User\Organizations::getStatic([
				'where' => [
					'um_usrorg_organization_id' => array_extract_values_by_key($form->values['\Numbers\Users\Organizations\Model\Organizations'], 'organization_id', ['unique' => true])
				],
				'pk' => ['um_usrorg_user_id']
			]);
			$user_list = array_keys($temp);
		}
		if (empty($user_list)) {
			$form->error(DANGER, \Object\Content\Messages::NO_ROWS_FOUND);
			return;
		}
		if ($form->hasErrors()) return;
		// deliver the message
		foreach ($user_list as $k => $v) {
			\Numbers\Users\Users\Helper\Notification\Sender::notifySingleUser('UM::EMAIL_SEND_MESSAGE', $v, '', [
				'subject' => $form->values['subject'],
				'body' => $form->values['body'],
				'important' => $form->values['important'],
				'from_name' => \User::get('name'),
				'from_email' => \User::get('email'),
			]);
		}
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		$form->values = [];
	}

	public function processOptionsModels(& $form, $field_name, $details_key, $details_parent_key, & $where) {
		if ($field_name == 'role_id') {
			$where['selected_organizations'] = array_extract_values_by_key($form->values['\Numbers\Users\Organizations\Model\Organizations'] ?? [], 'organization_id', ['unique' => true]);
		}
		if ($field_name == 'user_id') {
			$where['selected_organizations'] = array_extract_values_by_key($form->values['\Numbers\Users\Organizations\Model\Organizations'] ?? [], 'organization_id', ['unique' => true]);
			$where['selected_roles'] = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\Roles'] ?? [], 'role_id', ['unique' => true]);
		}
	}
}