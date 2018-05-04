<?php

namespace Numbers\Users\Users\Model\Form;
class Overrides extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Form Overrides';
	public $name = 'um_form_overrides';
	public $pk = ['um_formoverride_tenant_id', 'um_formoverride_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_formoverride_';
	public $columns = [
		'um_formoverride_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_formoverride_id' => ['name' => 'Override #', 'domain' => 'group_id_sequence'],
		'um_formoverride_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'um_formoverride_module_code' => ['name' => 'Module Code', 'domain' => 'module_code'],
		'um_formoverride_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_formoverride_role_id' => ['name' => 'Role #', 'domain' => 'role_id', 'null' => true],
		'um_formoverride_role_weight' => ['name' => 'Role Weight', 'domain' => 'weight', 'null' => true],
		'um_formoverride_form_code' => ['name' => 'Form Code', 'domain' => 'code'],
		'um_formoverride_form_field_code' => ['name' => 'Form Field Code', 'domain' => 'code'],
		'um_formoverride_action' => ['name' => 'Action', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Form\ActionTypes'],
		'um_formoverride_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_form_overrides_pk' => ['type' => 'pk', 'columns' => ['um_formoverride_tenant_id', 'um_formoverride_id']],
		'um_formoverride_tenant_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_formoverride_tenant_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Tenants',
			'foreign_columns' => ['tm_tenant_id']
		],
		'um_formoverride_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_formoverride_tenant_id', 'um_formoverride_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
		],
		'um_formoverride_form_field_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_formoverride_form_code', 'um_formoverride_form_field_code'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Form\Fields',
			'foreign_columns' => ['sm_frmfield_form_code', 'sm_frmfield_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'um_formoverride_tenant_id' => 'wg_audit_tenant_id',
			'um_formoverride_id' => 'wg_audit_override_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'um_formoverride_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}