<?php

namespace Numbers\Users\Organizations\Model\Jurisdiction;
class Countries extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Jurisdiction Countries';
	public $name = 'on_jurisdiction_countries';
	public $pk = ['on_juriscntr_tenant_id', 'on_juriscntr_jurisdiction_id', 'on_juriscntr_country_code'];
	public $tenant = true;
	public $orderby = [
		'on_juriscntr_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_juriscntr_';
	public $columns = [
		'on_juriscntr_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_juriscntr_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_juriscntr_jurisdiction_id' => ['name' => 'Jurisdictions #', 'domain' => 'jurisdiction_id'],
		'on_juriscntr_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'on_juriscntr_all_provinces' => ['name' => 'Inactive', 'type' => 'boolean'],
		'on_juriscntr_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_jurisdiction_countries_pk' => ['type' => 'pk', 'columns' => ['on_juriscntr_tenant_id', 'on_juriscntr_jurisdiction_id', 'on_juriscntr_country_code']],
		'on_juriscntr_jurisdiction_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_juriscntr_tenant_id', 'on_juriscntr_jurisdiction_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Jurisdictions',
			'foreign_columns' => ['on_jurisdiction_tenant_id', 'on_jurisdiction_id']
		],
		'on_juriscntr_country_code_fk' => [
			'type' => 'fk',
			'columns' => ['on_juriscntr_tenant_id', 'on_juriscntr_country_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Countries',
			'foreign_columns' => ['cm_country_tenant_id', 'cm_country_code']
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