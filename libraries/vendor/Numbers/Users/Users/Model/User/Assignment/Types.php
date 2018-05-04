<?php

namespace Numbers\Users\Users\Model\User\Assignment;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Types';
	public $name = 'um_user_assignment_types';
	public $pk = ['um_assigntype_tenant_id', 'um_assigntype_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_assigntype_';
	public $columns = [
		'um_assigntype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_assigntype_code' => ['name' => 'Type Code', 'domain' => 'type_code'],
		'um_assigntype_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_assigntype_parent_role_id' => ['name' => 'Parent Role #', 'domain' => 'role_id'],
		'um_assigntype_child_role_id' => ['name' => 'Child Role #', 'domain' => 'role_id'],
		'um_assigntype_multiple' => ['name' => 'Multiple', 'type' => 'boolean'],
		'um_assigntype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_assignment_types_pk' => ['type' => 'pk', 'columns' => ['um_assigntype_tenant_id', 'um_assigntype_code']],
		'um_assigntype_code_un' => ['type' => 'unique', 'columns' => ['um_assigntype_tenant_id', 'um_assigntype_code', 'um_assigntype_parent_role_id', 'um_assigntype_child_role_id']],
		'um_assigntype_parent_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_assigntype_tenant_id', 'um_assigntype_parent_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_assigntype_child_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_assigntype_tenant_id', 'um_assigntype_child_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		]
	];
	public $indexes = [
		'um_user_assignment_types_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_assigntype_code', 'um_assigntype_name']]
	];
	public $history = false;
	public $audit = false;
	public $options_map = [
		'um_assigntype_name' => 'name',
		'um_assigntype_parent_role_id' => 'um_assigntype_parent_role_id',
		'um_assigntype_child_role_id' => 'um_assigntype_child_role_id',
		'um_assigntype_code' => ['field' => 'um_assigntype_code', 'i18n' => false]
	];
	public $options_active = [
		'um_assigntype_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * @see $this->options()
	 */
	public function optionsJson($options = []) {
		$data = $this->options($options);
		$result = [];
		foreach ($data as $k => $v) {
			// add item
			$key = \Object\Table\Options::optionJsonFormatKey([
				'assignment_code' => $v['um_assigntype_code'],
				'parent_role_id' => (int) $v['um_assigntype_parent_role_id'],
				'child_role_id' => (int) $v['um_assigntype_child_role_id']
			]);
			// filter
			if (!\Object\Table\Options::processOptionsExistingValuesAndSkipValues($key, $options['existing_values'] ?? null, $options['skip_values'] ?? null)) continue;
			$result[$key] = ['name' => $v['name']];
		}
		return $result;
	}
}