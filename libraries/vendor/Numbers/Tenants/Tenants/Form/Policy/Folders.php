<?php

namespace Numbers\Tenants\Tenants\Form\Policy;
class Folders extends \Object\Form\Wrapper\Base {
	public $form_link = 'tm_policy_folders';
	public $module_code = 'TM';
	public $title = 'T/M Policy Folders Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'new_folder' => ['default_row_type' => 'grid', 'order' => 200],
		'tree_container' => [
			'type' => 'trees',
			'details_rendering_type' => 'name_only',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Tenants\Tenants\Model\Policy\Folders',
			'details_pk' => ['tm_polfolder_polroot_code', 'tm_polfolder_id'],
			'details_tree_key' => 'tm_polfolder_id',
			'details_tree_parent_key' => 'tm_polfolder_parent_polfolder_id',
			'details_tree_name_only_custom_renderer' => '\Numbers\Tenants\Tenants\Form\Policy\Folders::renderTreeDocumentField',
			'order' => 200
		],
		'tree_container_modal' => [
			'type' => 'modal',
			'default_row_type' => 'grid',
			'label_name' => 'Add new folder:',
			'order' => 32200,
		],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'tm_polroot_code' => [
				'tm_polroot_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Root', 'domain' => 'type_code', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\Model\Policy\Roots::optionsActive', 'refetch_values_on_change' => true, 'onchange' => 'this.form.submit();'],
			],
		],
		'tree_container' => [
			self::HIDDEN => [
				'tm_polfolder_id' => ['label_name' => 'Folder #', 'domain' => 'folder_id_sequence', 'null' => true, 'method' => 'hidden'],
				'tm_polfolder_polroot_code' => ['label_name' => 'Root Code', 'domain' => 'type_code', 'null' => true, 'method' => 'hidden'],
				'tm_polfolder_parent_polfolder_id' => ['label_name' => 'Parent Folder', 'domain' => 'folder_id', 'null' => true, 'method' => 'hidden'],
				'tm_polfolder_icon' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'method' => 'hidden'],
				'tm_polfolder_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'required' => true, 'method' => 'hidden'],
				'tm_polfolder_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'method' => 'hidden'],
				'tm_polfolder_counter' => ['order' => 3, 'label_name' => 'Counter', 'domain' => 'counter', 'default' => 0, 'method' => 'hidden'],
			]
		],
		'tree_container_modal' => [
			self::HIDDEN => [
				'tree_container_modal_tm_polfolder_id' => ['label_name' => 'Folder #', 'domain' => 'folder_id_sequence', 'null' => true, 'method' => 'hidden'],
				'tree_container_modal_tm_polfolder_polroot_code' => ['label_name' => 'Root Code', 'domain' => 'type_code', 'null' => true, 'method' => 'hidden'],
			],
			'tree_container_modal_tm_polfolder_parent_polfolder_id' => [
				'tree_container_modal_tm_polfolder_parent_polfolder_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Parent Folder', 'domain' => 'folder_id', 'null' => true],
			],
			'tree_container_modal_tm_polfolder_name' => [
				'tree_container_modal_tm_polfolder_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'required' => true, 'percent' => 95],
				'tree_container_modal_tm_polfolder_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'tree_container_modal_tm_polfolder_icon' => [
				'tree_container_modal_tm_polfolder_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true],
			],
			'buttons' => [
				self::BUTTON_SUBMIT_OTHER => self::BUTTON_SUBMIT_OTHER_DATA + ['row_order' => 32000, 'onclick' => 'Numbers.NumbersUsersUsersFormUsers.setPolygon(); Numbers.Modal.hide(\'form_um_users_modal_google_map_modal_dialog\'); return false;'],
				'tree_container_modal_remove_selected_folder' => ['order' => 32000, 'button_group' => 'right', 'value' => 'Delete', 'type' => 'danger', 'method' => 'button2', 'icon' => 'far fa-trash-alt', 'class' => 'float-right', 'onclick' => 'Numbers.NumbersUsersUsersFormUsers.deleteSelectedShape(); return false;']
			]
		],
		// 'show_google_map' => ['order' => 2, 'label_name' => null, 'percent' => 30, 'value' => 'Draw Area', 'method' => 'button', 'onclick' => 'Numbers.Modal.show(\'form_um_users_modal_google_map_modal_dialog\'); Numbers.NumbersUsersUsersFormUsers.initialize(this);'],
		/*
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
		*/
	];
	public $collection = [
		'name' => 'Roots',
		'model' => '\Numbers\Tenants\Tenants\Model\Policy\Roots',
		'pk' => ['tm_polroot_tenant_id', 'tm_polroot_code'],
		'details' => [
			'\Numbers\Tenants\Tenants\Model\Policy\Folders' => [
				'name' => 'Folders',
				'pk' => ['tm_polfolder_tenant_id', 'tm_polfolder_polroot_code', 'tm_polfolder_id'],
				'type' => '1M',
				'map' => ['tm_polroot_tenant_id' => 'tm_polfolder_tenant_id', 'tm_polroot_code' => 'tm_polfolder_polroot_code']
			],
		]
	];

	public function refresh(& $form) {

	}

	public function renderTreeDocumentField(& $form, & $rows, & $data) {
		//$result.= \HTML::icon(['type' => $data['tm_polfolder_icon'] ?? 'far fa-folder']) . ' ';
		$result = $data['tm_polfolder_name'] . ' ';
		if (!empty($data['tm_polfolder_inactive'])) {
			$result.= '(' . i18n(null, 'Inactive') . ')' . ' ';
		}
		$result.= '(' . $data['tm_polfolder_counter'] . ')';
		// permissions
		$can_inactivate = \Application::$controller->can('Record_Inactivate', 'Edit');
		$toolbar = [];
		if (\Application::$controller->canCached('Record_New')) {
			$toolbar[] = \HTML::a(['href' => 'javascript:void(0);', 'onclick' => 'Numbers.Modal.show(\'form_tm_policy_folders_modal_tree_container_modal_dialog\');', 'value' => i18n(null, 'New')]);
		}
		if (\Application::$controller->canCached('Record_Edit')) {
			$toolbar[] = \HTML::a(['href' => 'javascript:void(0);', 'onclick' => 'Numbers.Modal.show(\'form_tm_policy_folders_modal_tree_container_modal_dialog\');', 'value' => i18n(null, 'Edit')]);
		}
		if (\Application::$controller->canCached('Record_Delete')) {
			$toolbar[] = \HTML::a(['href' => 'javascript:void(0);', 'onclick' => 'Numbers.Modal.show(\'form_tm_policy_folders_modal_tree_container_modal_dialog\');', 'value' => i18n(null, 'Delete')]);
		}
		return [
			'name' => $result,
			'icon_class' => $data['tm_polfolder_icon'] ?? 'far fa-folder',
			'toolbar' => $toolbar
		];
	}
}