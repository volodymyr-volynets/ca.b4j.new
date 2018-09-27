<?php

namespace Numbers\Users\Organizations\Model;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Organizations';
	public $schema;
	public $name = 'on_organizations';
	public $pk = ['on_organization_tenant_id', 'on_organization_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_organization_';
	public $columns = [
		'on_organization_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id_sequence'],
		'on_organization_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_organization_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_organization_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		// contact
		'on_organization_email' => ['name' => 'Primary Email', 'domain' => 'email', 'null' => true],
		'on_organization_email2' => ['name' => 'Secondary Email', 'domain' => 'email', 'null' => true],
		'on_organization_phone' => ['name' => 'Primary Phone', 'domain' => 'phone', 'null' => true],
		'on_organization_phone2' => ['name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true],
		'on_organization_cell' => ['name' => 'Cell Phone', 'domain' => 'phone', 'null' => true],
		'on_organization_fax' => ['name' => 'Fax', 'domain' => 'phone', 'null' => true],
		// logo
		'on_organization_logo_file_id' => ['name' => 'Logo File #', 'domain' => 'file_id', 'null' => true],
		// operating country / province
		'on_organization_operating_country_code' => ['name' => 'Operating Country Code', 'domain' => 'country_code', 'null' => true],
		'on_organization_operating_province_code' => ['name' => 'Operating Province Code', 'domain' => 'province_code', 'null' => true],
		// inactive & hold
		'on_organization_hold' => ['name' => 'Hold', 'type' => 'boolean'],
		'on_organization_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_organizations_pk' => ['type' => 'pk', 'columns' => ['on_organization_tenant_id', 'on_organization_id']],
		'on_organization_code_un' => ['type' => 'unique', 'columns' => ['on_organization_tenant_id', 'on_organization_code']]
	];
	public $indexes = [
		'on_organizations_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_organization_code', 'on_organization_name', 'on_organization_phone', 'on_organization_email']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_organization_tenant_id' => 'wg_audit_tenant_id',
			'on_organization_id' => 'wg_audit_organization_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_organization_name' => 'name',
		'on_organization_icon' => 'icon_class',
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $addresses = [
		'map' => [
			'on_organization_tenant_id' => 'wg_address_tenant_id',
			'on_organization_id' => 'wg_address_organization_id'
		]
	];

	public $attributes = [
		'map' => [
			'on_organization_tenant_id' => 'wg_attribute_tenant_id',
			'on_organization_id' => 'wg_attribute_organization_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}