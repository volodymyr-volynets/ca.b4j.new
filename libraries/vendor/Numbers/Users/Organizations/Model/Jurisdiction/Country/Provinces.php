<?php

namespace Numbers\Users\Organizations\Model\Jurisdiction\Country;
class Provinces extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Jurisdiction Country Provinces';
	public $name = 'on_jurisdiction_provinces';
	public $pk = ['on_jurisprov_tenant_id', 'on_jurisprov_jurisdiction_id', 'on_jurisprov_country_code', 'on_jurisprov_province_code'];
	public $tenant = true;
	public $orderby = [
		'on_jurisprov_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_jurisprov_';
	public $columns = [
		'on_jurisprov_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_jurisprov_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_jurisprov_jurisdiction_id' => ['name' => 'Jurisdictions #', 'domain' => 'jurisdiction_id'],
		'on_jurisprov_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'on_jurisprov_province_code' => ['name' => 'Province Code', 'domain' => 'province_code'],
		'on_jurisprov_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_jurisdiction_provinces_pk' => ['type' => 'pk', 'columns' => ['on_jurisprov_tenant_id', 'on_jurisprov_jurisdiction_id', 'on_jurisprov_country_code', 'on_jurisprov_province_code']],
		'on_jurisprov_jurisdiction_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_jurisprov_tenant_id', 'on_jurisprov_jurisdiction_id', 'on_jurisprov_country_code'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Jurisdiction\Countries',
			'foreign_columns' => ['on_juriscntr_tenant_id', 'on_juriscntr_jurisdiction_id', 'on_juriscntr_country_code']
		],
		'on_jurisprov_province_code_fk' => [
			'type' => 'fk',
			'columns' => ['on_jurisprov_tenant_id', 'on_jurisprov_country_code', 'on_jurisprov_province_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Provinces',
			'foreign_columns' => ['cm_province_tenant_id', 'cm_province_country_code', 'cm_province_province_code']
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