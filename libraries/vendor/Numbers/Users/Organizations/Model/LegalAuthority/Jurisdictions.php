<?php

namespace Numbers\Users\Organizations\Model\LegalAuthority;
class Jurisdictions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Legal Authority Jurisdictions';
	public $name = 'on_legal_authority_jurisdictions';
	public $pk = ['on_authjuris_tenant_id', 'on_authjuris_authority_id', 'on_authjuris_jurisdiction_id'];
	public $tenant = true;
	public $orderby = [
		'on_authjuris_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_authjuris_';
	public $columns = [
		'on_authjuris_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_authjuris_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_authjuris_authority_id' => ['name' => 'Authority #', 'domain' => 'authority_id'],
		'on_authjuris_jurisdiction_id' => ['name' => 'Jurisdiction #', 'domain' => 'jurisdiction_id'],
		'on_authjuris_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_legal_authority_jurisdictions_pk' => ['type' => 'pk', 'columns' => ['on_authjuris_tenant_id', 'on_authjuris_authority_id', 'on_authjuris_jurisdiction_id']],
		'on_authjuris_jurisdiction_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_authjuris_tenant_id', 'on_authjuris_jurisdiction_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Jurisdictions',
			'foreign_columns' => ['on_jurisdiction_tenant_id', 'on_jurisdiction_id']
		],
		'on_authjuris_authority_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_authjuris_tenant_id', 'on_authjuris_authority_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\LegalAuthorities',
			'foreign_columns' => ['on_authority_tenant_id', 'on_authority_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}