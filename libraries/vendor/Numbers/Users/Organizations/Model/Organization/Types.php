<?php

namespace Numbers\Users\Organizations\Model\Organization;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Organization Types';
	public $name = 'on_organization_types';
	public $pk = ['on_orgtype_tenant_id', 'on_orgtype_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_orgtype_';
	public $columns = [
		'on_orgtype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_orgtype_code' => ['name' => 'Type Code', 'domain' => 'type_code'],
		'on_orgtype_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_orgtype_parent_type_code' => ['name' => 'Parent Type Code', 'domain' => 'type_code', 'null' => true],
		'on_orgtype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_organization_types_pk' => ['type' => 'pk', 'columns' => ['on_orgtype_tenant_id', 'on_orgtype_code']],
		'on_orgtype_parent_type_code_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgtype_tenant_id', 'on_orgtype_parent_type_code'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organization\Types',
			'foreign_columns' => ['on_orgtype_tenant_id', 'on_orgtype_code']
		]
	];
	public $indexes = [
		'on_organization_types_fulltext_simple_idx' => ['type' => 'fulltext', 'columns' => ['on_orgtype_code', 'on_orgtype_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_orgtype_tenant_id' => 'wg_audit_tenant_id',
			'on_orgtype_code' => 'wg_audit_orgtype_code'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [
		'on_orgtype_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'on_orgtype_relation_id',
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * @see $this->options()
	 */
	public function optionsGroupped(array $options = []) {
		$options['options_map'] = [
			'on_orgtype_name' => 'name',
			'on_orgtype_parent_type_code' => 'parent'
		];
		$result = $this->optionsActive($options);
		if (!empty($result)) {
			$converted = \Helper\Tree::convertByParent($result, 'parent');
			$result = [];
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name'], $result);
		}
		return $result;
	}
}