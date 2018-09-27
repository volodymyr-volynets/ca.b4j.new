<?php

namespace Numbers\Users\Organizations\Model;
class LegalAuthorities extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Legal Authorities';
	public $schema;
	public $name = 'on_legal_authorities';
	public $pk = ['on_authority_tenant_id', 'on_authority_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_authority_';
	public $columns = [
		'on_authority_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_authority_id' => ['name' => 'Authority #', 'domain' => 'authority_id_sequence'],
		'on_authority_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_authority_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_authority_effective_from' => ['name' => 'Effective From', 'type' => 'date'],
		'on_authority_effective_to' => ['name' => 'Effective To', 'type' => 'date', 'null' => true],
		'on_authority_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_legal_authorities_pk' => ['type' => 'pk', 'columns' => ['on_authority_tenant_id', 'on_authority_id']],
		'on_authority_code_un' => ['type' => 'unique', 'columns' => ['on_authority_tenant_id', 'on_authority_code']]
	];
	public $indexes = [
		'on_legal_authorities_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_authority_code', 'on_authority_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_authority_tenant_id' => 'wg_audit_tenant_id',
			'on_authority_id' => 'wg_audit_authority_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $addresses = [
		'map' => [
			'on_authority_tenant_id' => 'wg_address_tenant_id',
			'on_authority_id' => 'wg_address_authority_id'
		]
	];

	public $attributes = [
		'map' => [
			'on_authority_tenant_id' => 'wg_attribute_tenant_id',
			'on_authority_id' => 'wg_attribute_authority_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}