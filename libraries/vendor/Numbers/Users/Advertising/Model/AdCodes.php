<?php

namespace Numbers\Users\Advertising\Model;
class AdCodes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'AM';
	public $title = 'A/M Ad Codes';
	public $schema;
	public $name = 'am_adcodes';
	public $pk = ['am_adcode_tenant_id', 'am_adcode_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'am_adcode_';
	public $columns = [
		'am_adcode_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'am_adcode_id' => ['name' => 'Ad Code #', 'domain' => 'adcode_id_sequence'],
		'am_adcode_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'am_adcode_name' => ['name' => 'Name', 'domain' => 'name'],
		'am_adcode_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'am_adcode_category_id' => ['name' => 'Category #', 'domain' => 'group_id'],
		'am_adcode_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'am_adcode_hidden' => ['name' => 'Hidden', 'type' => 'boolean'],
		'am_adcode_effective_from' => ['name' => 'Effective From', 'type' => 'date', 'null' => true],
		'am_adcode_effective_to' => ['name' => 'Effective To', 'type' => 'date', 'null' => true],
		'am_adcode_all_locations' => ['name' => 'All Locations', 'type' => 'boolean'],
		'am_adcode_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'am_adcodes_pk' => ['type' => 'pk', 'columns' => ['am_adcode_tenant_id', 'am_adcode_id']],
		'am_adcode_code_un' => ['type' => 'unique', 'columns' => ['am_adcode_tenant_id', 'am_adcode_code']],
		'am_adcode_category_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_adcode_tenant_id', 'am_adcode_category_id'],
			'foreign_model' => '\Numbers\Users\Advertising\Model\Categories',
			'foreign_columns' => ['am_category_tenant_id', 'am_category_id']
		],
		'am_adcode_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['am_adcode_tenant_id', 'am_adcode_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [
		'am_adcodes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['am_adcode_code', 'am_adcode_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'am_adcode_tenant_id' => 'wg_audit_tenant_id',
			'am_adcode_id' => 'wg_audit_adcode_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'am_adcode_name' => 'name',
		'am_adcode_icon' => 'icon_class'
	];
	public $options_active = [
		'am_adcode_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}