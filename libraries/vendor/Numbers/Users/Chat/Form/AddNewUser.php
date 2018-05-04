<?php

namespace Numbers\Users\Chat\Form;
class AddNewUser extends \Object\Form\Wrapper\Base {
	public $form_link = 'ct_add_new_user';
	public $module_code = 'CT';
	public $title = 'C/T Add New User Form';
	public $options = [
		'actions' => [
			'refresh' => true,
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
			'details_key' => '\Numbers\Users\Organizations\Model\Organizations',
			'details_pk' => ['organization_id'],
			'details_cannot_delete' => false,
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
			'order' => 35000
		],
	];
	public $rows = [
		'tabs' => [
			'organizations' => ['order' => 100, 'label_name' => 'Organizations'],
			'roles' => ['order' => 300, 'label_name' => 'Roles'],
			'users' => ['order' => 400, 'label_name' => 'Users'],
		]
	];
	public $elements = [
		'top' => [
			'name' => [
				'name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Name', 'domain' => 'name', 'null' => true, 'percent' => 85],
				'important' => ['order' => 2, 'label_name' => 'Important', 'type' => 'boolean', 'percent' => 15]
			]
		],
		'tabs' => [
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
				'user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User', 'domain' => 'user_id', 'required' => true, 'null' => true, 'persistent' => true, 'details_unique_select' => true, 'searchable' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Users', 'options_params' => ['skip_acl' => true, 'skip_himself' => true], 'onchange' => 'this.form.submit();'],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT=> self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function validate(& $form) {
		$user_list = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\Users'], 'user_id', ['unique' => true]);
		if (empty($user_list)) {
			$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, '\Numbers\Users\Users\Model\Users[1][user_id]');
			return;
		}
		if (count($user_list) == 1) {
			$form->values['name'] = null;
			$single_user = 1;
		} else {
			$single_user = 0;
			if (empty($form->values['name'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'name');
			}
		}
		if (!$form->hasErrors()) {
			$data = [
				'ct_group_owner_user_id' => \User::id(),
				'ct_group_name' => $form->values['name'] ?? null,
				'ct_group_important' => $form->values['important'] ?? 0,
				'ct_group_single_user' => $single_user,
				'\Numbers\Users\Chat\Model\Group\Users' => []
			];
			foreach ($user_list as $k => $v) {
				$data['\Numbers\Users\Chat\Model\Group\Users'][] = [
					'ct_grpuser_user_id' => $v
				];
			}
			// important to add himself
			$himself = \User::id();
			if (!in_array($himself, $user_list)) {
				$user_list[] = $himself;
				$data['\Numbers\Users\Chat\Model\Group\Users'][] = [
					'ct_grpuser_user_id' => $himself
				];
			}
			// validate if such group already exists
			$query = \Numbers\Users\Chat\Model\Group\Users::queryBuilderStatic()->select();
			$query->columns([
				'ct_grpuser_group_id',
				'total_rows' => 'COUNT(*)',
				'matched_rows' => 'SUM(CASE WHEN a.ct_grpuser_user_id IN (' . implode(', ', $user_list) . ') THEN 1 ELSE 0 END)'
			]);
			$query->join('LEFT', new \Numbers\Users\Chat\Model\Groups(), 'b', 'ON', [
				['AND', ['a.ct_grpuser_group_id', '=', 'b.ct_group_id', true], false]
			]);
			//$query->where('AND', ['ct_group_owner_user_id', '=', \User::id()]);
			$query->groupby(['ct_grpuser_group_id']);
			$query->having('AND', ['COUNT(*)', '=', 'SUM(CASE WHEN a.ct_grpuser_user_id IN (' . implode(', ', $user_list) . ') THEN 1 ELSE 0 END)', true]);
			$query->having('AND', ['COUNT(*)', '=', count($user_list)]);
			$temp = $query->query('ct_grpuser_group_id');
			if (!empty($temp['rows'])) {
				$form->error(DANGER, 'Group with the same users already exists!');
				return;
			}
			// insert new group
			$model = new \Numbers\Users\Chat\Model\Collection\Groups();
			$result = $model->merge($data);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				return;
			}
			$form->error(SUCCESS, \Object\Content\Messages::RECORD_INSERTED);
			$form->redirect('/Numbers/Users/Chat/Controller/Chat/_Index');
		}
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