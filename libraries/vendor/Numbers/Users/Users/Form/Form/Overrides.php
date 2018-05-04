<?php

namespace Numbers\Users\Users\Form\Form;
class Overrides extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_groups';
	public $module_code = 'UM';
	public $title = 'U/M Form Overrides Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'um_formoverride_id' => [
				'um_formoverride_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Override #', 'domain' => 'group_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_formoverride_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_formoverride_name' => [
				'um_formoverride_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'um_formoverride_module_code' => [
				'um_formoverride_module_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Module Code', 'domain' => 'module_code', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Backend\System\Modules\Model\Modules', 'onchange' => 'this.form.submit();'],
				'um_formoverride_module_id' => ['order' => 2, 'label_name' => 'Module #', 'domain' => 'module_id', 'null' => true, 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\Model\Modules', 'options_depends' => ['tm_module_module_code' => 'um_formoverride_module_code'], 'onchange' => 'this.form.submit();'],
			],
			'um_formoverride_form_code' => [
				'um_formoverride_form_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Form', 'domain' => 'code', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Backend\System\Modules\Model\Forms', 'options_depends' => ['sm_form_module_code' => 'um_formoverride_module_code'], 'onchange' => 'this.form.submit();'],
				'um_formoverride_form_field_code' => ['order' => 2, 'label_name' => 'Field', 'domain' => 'code', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'tree' => true, 'options_model' => '\Numbers\Backend\System\Modules\Model\Form\Fields::optionsGroupped', 'options_depends' => ['sm_frmfield_form_code' => 'um_formoverride_form_code'], 'onchange' => 'this.form.submit();'],
			],
			'um_formoverride_action' => [
				'um_formoverride_action' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Action', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Form\ActionTypes'],
			],
			'um_formoverride_role_id' => [
				'um_formoverride_role_id' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Role', 'domain' => 'role_id', 'null' => true, 'required' => 'c', 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Roles'],
				'um_formoverride_role_weight' => ['order' => 2, 'label_name' => 'Maximum Role Weight', 'domain' => 'weight', 'null' => true, 'required' => 'c', 'percent' => 50],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Overrides',
		'model' => '\Numbers\Users\Users\Model\Form\Overrides'
	];

	public function validate(& $form) {
		if (empty($form->values['um_formoverride_role_id']) && empty($form->values['um_formoverride_role_weight'])) {
			$form->error(DANGER, 'Role or Maximum Role Weight is reqired!', 'um_formoverride_role_id');
			$form->error(DANGER, 'Role or Maximum Role Weight is reqired!', 'um_formoverride_role_weight');
		}
	}

	public function processOptionsModels(& $form, $field_name, $details_key, $details_parent_key, & $where) {
		if ($field_name == 'um_formoverride_role_id') {
			$where['selected_organizations'] = \User::get('organizations');
		}
	}
}