<?php

namespace Numbers\Countries\Countries\Model;
class PostalCodes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CM';
	public $title = 'C/M Postal Codes';
	public $name = 'cm_postal_codes';
	public $pk = ['cm_postal_tenant_id', 'cm_postal_country_code', 'cm_postal_postal_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'cm_postal_';
	public $columns = [
		'cm_postal_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'cm_postal_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'cm_postal_province_code' => ['name' => 'Province Code', 'domain' => 'province_code', 'null' => true],
		'cm_postal_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'cm_postal_city' => ['name' => 'City', 'domain' => 'name', 'null' => true],
		'cm_postal_latitude' => ['name' => 'Latitude', 'domain' => 'geo_coordinate', 'null' => true],
		'cm_postal_longitude' => ['name' => 'Longitude', 'domain' => 'geo_coordinate', 'null' => true],
		'cm_postal_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'cm_postal_codes_pk' => ['type' => 'pk', 'columns' => ['cm_postal_tenant_id', 'cm_postal_country_code', 'cm_postal_postal_code']],
		'cm_postal_province_code_fk' => [
			'type' => 'fk',
			'columns' => ['cm_postal_tenant_id', 'cm_postal_country_code', 'cm_postal_province_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Provinces',
			'foreign_columns' => ['cm_province_tenant_id', 'cm_province_country_code', 'cm_province_province_code']
		],
		'cm_postal_country_code_fk' => [
			'type' => 'fk',
			'columns' => ['cm_postal_tenant_id', 'cm_postal_country_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Countries',
			'foreign_columns' => ['cm_country_tenant_id', 'cm_country_code'],
		]
	];
	public $indexes = [
		'cm_postal_codes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['cm_postal_postal_code']]
	];
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
		'classification' => 'public',
		'protection' => 0,
		'scope' => 'global'
	];
}