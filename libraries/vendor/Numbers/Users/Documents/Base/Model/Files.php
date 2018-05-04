<?php

namespace Numbers\Users\Documents\Base\Model;
class Files extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'DT';
	public $title = 'D/T Files';
	public $name = 'dt_files';
	public $pk = ['dt_file_tenant_id', 'dt_file_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'dt_file_';
	public $columns = [
		'dt_file_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'dt_file_id' => ['name' => 'File #', 'domain' => 'file_id_sequence'],
		'dt_file_storage_id' => ['name' => 'Storage #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Documents\Base\Model\Storages'],
		'dt_file_catalog_code' => ['name' => 'Catalog Code', 'domain' => 'group_code'],
		'dt_file_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'dt_file_name' => ['name' => 'File Name', 'domain' => 'file_name'],
		'dt_file_extension' => ['name' => 'File Extension', 'domain' => 'file_extension'],
		'dt_file_mime' => ['name' => 'File Mime', 'domain' => 'name'],
		'dt_file_size' => ['name' => 'File Size', 'domain' => 'file_size'],
		'dt_file_path' => ['name' => 'File Path', 'domain' => 'file_path'],
		'dt_file_thumbnail_path' => ['name' => 'Thumbnail Path', 'domain' => 'file_path', 'null' => true],
		'dt_file_language_code' => ['name' => 'Language Code', 'domain' => 'language_code', 'null' => true],
		'dt_file_readonly' => ['name' => 'Readonly', 'type' => 'boolean'],
		'dt_file_temporary' => ['name' => 'Temporary', 'type' => 'boolean'],
		'dt_file_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'dt_files_pk' => ['type' => 'pk', 'columns' => ['dt_file_tenant_id', 'dt_file_id']],
		'dt_file_catalog_code_fk' => [
			'type' => 'fk',
			'columns' => ['dt_file_tenant_id', 'dt_file_catalog_code'],
			'foreign_model' => '\Numbers\Users\Documents\Base\Model\Catalogs',
			'foreign_columns' => ['dt_catalog_tenant_id', 'dt_catalog_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}