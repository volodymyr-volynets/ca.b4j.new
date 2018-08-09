<?php

namespace Numbers\Users\Users\Form\Owner;
class ExistingOwners extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_owners_form_id';
	public $module_code = 'UM';
	public $title = 'U/M Existing Owners Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'users_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_key' => '\Numbers\Users\Users\Model\Owner\Users',
			'details_pk' => ['um_owneruser_type_id', 'um_owneruser_user_id'],
			'details_cannot_delete' => true,
			'order' => 200
		],
		'new_user_container' => [
			'type' => 'subdetails',
			'label_name' => 'Change Owner',
			'details_rendering_type' => 'grid_with_label',
			'details_11' => true,
			'details_new_rows' => 0,
			'details_parent_key' => '\Numbers\Users\Users\Model\Owner\Users',
			'details_key' => '\NewUsers',
			'details_pk' => ['new_user_id'],
			'order' => 30000,
		],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'um_owneruser_linked_type_code' => ['label_name' => 'Linked Type Code', 'domain' => 'group_code', 'method' => 'hidden'],
				'um_owneruser_linked_module_id' => ['label_name' => 'Linked Module #', 'domain' => 'module_id', 'method' => 'hidden'],
				'um_owneruser_linked_id' => ['label_name' => 'Linked #', 'domain' => 'big_id', 'method' => 'hidden'],
			]
		],
		'users_container' => [
			'row1' => [
				'um_owneruser_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes', 'readonly' => true],
				'um_owneruser_user_id' => ['order' => 2, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Users', 'readonly' => true],
			],
			self::HIDDEN => [
				'um_owneruser_id' => ['label_name' => 'Owner #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden'],
				'um_owneruser_type_code' => ['label_name' => 'Type Code', 'domain' => 'group_code', 'null' => true, 'method' => 'hidden'],
				'um_owneruser_queue_selection' => ['label_name' => 'Queue Selection', 'type' => 'json', 'null' => true, 'method' => 'hidden'],
			]
		],
		'new_user_container' => [
			'row1' => [
				'new_user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'New Owner', 'domain' => 'user_id', 'null' => true, 'percent' => 100, 'method' => 'select'],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_SAVE_DATA,
			]
		]
	];
	public $collection = [];

	public function refresh(& $form) {
		$model = new \Numbers\Users\Users\Model\Owner\Users();
		$data = $model->get([
			'where' => [
				'um_owneruser_linked_type_code' => $form->values['um_owneruser_linked_type_code'],
				'um_owneruser_linked_module_id' => $form->values['um_owneruser_linked_module_id'],
				'um_owneruser_linked_id' => $form->values['um_owneruser_linked_id']
			],
			'pk' => ['um_owneruser_type_id', 'um_owneruser_user_id'],
			'orderby' => [
				'um_owneruser_type_id' => SORT_DESC,
				'um_owneruser_user_id' => SORT_DESC
			]
		]);
		if (!empty($data)) {
			foreach ($data as $k => $v) {
				foreach ($v as $k2 => $v2) {
					$key = $k . '::' . $k2;
					$form->values['\Numbers\Users\Users\Model\Owner\Users'][$key] = [
						'um_owneruser_id' => $v2['um_owneruser_id'],
						'um_owneruser_type_id' => $v2['um_owneruser_type_id'],
						'um_owneruser_type_code' => $v2['um_owneruser_type_code'],
						'um_owneruser_user_id' => $v2['um_owneruser_user_id'],
						'um_owneruser_queue_selection' => $v2['um_owneruser_queue_selection'],
						'\NewUsers' => $form->values['\Numbers\Users\Users\Model\Owner\Users'][$key]['\NewUsers'] ?? []
					];
				}
			}
		}
	}

	public function save(& $form) {
		foreach ($form->values['\Numbers\Users\Users\Model\Owner\Users'] as $k => $v) {
			if (!empty($v['\NewUsers'][self::BUTTON_SUBMIT_SAVE]) && !empty($v['\NewUsers']['new_user_id']) && $v['um_owneruser_user_id'] != $v['\NewUsers']['new_user_id']) {
				$data = [
					'um_owneruser_id' => $v['um_owneruser_id'],
					'um_owneruser_type_id' => $v['um_owneruser_type_id'],
					'um_owneruser_user_id' => $v['\NewUsers']['new_user_id'],
					'um_owneruser_linked_type_code' => $form->values['um_owneruser_linked_type_code'],
					'um_owneruser_linked_module_id' => $form->values['um_owneruser_linked_module_id'],
					'um_owneruser_linked_id' => $form->values['um_owneruser_linked_id'],
				];
				$result = \Numbers\Users\Users\Model\Owner\Users::collectionStatic()->merge($data);
				if (!$result['success']) {
					$form->error(DANGER, $result['error']);
					return false;
				} else {
					$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED, null, ['postponed' => true]);
				}
			}
		}
		return true;
	}

	public function success(& $form) {
		$form->redirectOnSuccess();
	}

	public function overrideTabs(& $form, & $tab_options, & $tab_name, & $neighbouring_values = []) {
		if ($tab_name == '\NewUsers') {
			if ($neighbouring_values['um_owneruser_type_code'] == 'CREATOR' || !\Application::$controller->can('Record_Execute_Owners', 'Edit')) {
				return ['hidden' => true];
			}
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'new_user_id') {
			$options['options']['options_params'] = json_decode($options['options']['__detail_values']['um_owneruser_queue_selection'], true) ?? [];
			if (!empty($options['options']['options_params']['__model'])) {
				$options['options']['options_model'] = $options['options']['options_params']['__model'];
			}
			$options['options']['options_options']['i18n'] = 'skip_sorting';
		}
	}
}