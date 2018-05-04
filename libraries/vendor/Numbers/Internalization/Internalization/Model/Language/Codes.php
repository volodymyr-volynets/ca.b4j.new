<?php

namespace Numbers\Internalization\Internalization\Model\Language;
class Codes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'IN';
	public $title = 'I/N Language Codes';
	public $name = 'in_language_codes';
	public $pk = ['in_language_tenant_id', 'in_language_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'in_language_';
	public $columns = [
		'in_language_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'in_language_code' => ['name' => 'Language Code', 'domain' => 'language_code'],
		'in_language_code2' => ['name' => 'Language Code (2)', 'type' => 'char', 'length' => 2, 'null' => true],
		'in_language_name' => ['name' => 'Name', 'domain' => 'name'],
		'in_language_native_name' => ['name' => 'Native Name', 'domain' => 'name', 'null' => true],
		'in_language_rtl' => ['name' => 'Right to Left', 'type' => 'boolean'],
		'in_language_family_name' => ['name' => 'Family Name', 'domain' => 'name', 'null' => true],
		'in_language_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'in_language_codes_pk' => ['type' => 'pk', 'columns' => ['in_language_tenant_id', 'in_language_code']]
	];
	public $indexes = [
		'in_language_codes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['in_language_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'in_language_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $data_asset = [
		'classification' => 'public',
		'protection' => 0,
		'scope' => 'global'
	];
}