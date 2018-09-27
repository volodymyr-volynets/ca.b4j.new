<?php

namespace Numbers\Countries\Countries\Model;
class Countries extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CM';
	public $title = 'C/M Countries';
	public $name = 'cm_countries';
	public $pk = ['cm_country_tenant_id', 'cm_country_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cm_country_';
	public $columns = [
		'cm_country_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cm_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'cm_country_name' => ['name' => 'Name', 'domain' => 'name'],
		'cm_country_code3' => ['name' => 'Code(3)', 'domain' => 'country_code3', 'null' => true],
		'cm_country_number' => ['name' => 'Number', 'domain' => 'country_number', 'null' => true],
		'cm_country_region_id' => ['name' => 'Region #', 'domain' => 'country_number', 'null' => true],
		'cm_country_sub_region_id' => ['name' => 'Sub Region #', 'domain' => 'country_number', 'null' => true],
		'cm_country_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cm_countries_pk' => ['type' => 'pk', 'columns' => ['cm_country_tenant_id', 'cm_country_code']],
		'cm_country_code3_un' => ['type' => 'unique', 'columns' => ['cm_country_tenant_id', 'cm_country_code3']],
		'cm_country_number_un' => ['type' => 'unique', 'columns' => ['cm_country_tenant_id', 'cm_country_number']],
		'cm_country_region_id_fk' => [
			'type' => 'fk',
			'columns' => ['cm_country_tenant_id', 'cm_country_region_id'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Regions',
			'foreign_columns' => ['cm_region_tenant_id', 'cm_region_id']
		],
		'cm_country_sub_region_id_fk' => [
			'type' => 'fk',
			'columns' => ['cm_country_tenant_id', 'cm_country_sub_region_id'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Regions',
			'foreign_columns' => ['cm_region_tenant_id', 'cm_region_id']
		]
	];
	public $indexes = [
		'cm_countries_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['cm_country_name']]
	];
	public $history = false;
	public $audit = false;
	public $options_map = [];
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