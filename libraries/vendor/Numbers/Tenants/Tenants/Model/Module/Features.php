<?php

namespace Numbers\Tenants\Tenants\Model\Module;
class Features extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Module Features';
	public $name = 'tm_module_features';
	public $pk = ['tm_feature_tenant_id', 'tm_feature_module_id', 'tm_feature_feature_code'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_feature_';
	public $columns = [
		'tm_feature_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_feature_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'tm_feature_module_code' => ['name' => 'Module Code', 'domain' => 'module_code'],
		'tm_feature_feature_code' => ['name' => 'Feature Code', 'domain' => 'feature_code'],
		'tm_feature_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_module_features_pk' => ['type' => 'pk', 'columns' => ['tm_feature_tenant_id', 'tm_feature_module_id', 'tm_feature_feature_code']],
		'tm_feature_module_code_fk' => [
			'type' => 'fk',
			'columns' => ['tm_feature_tenant_id', 'tm_feature_module_id', 'tm_feature_module_code'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id', 'tm_module_module_code']
		],
		'tm_feature_feature_code_fk' => [
			'type' => 'fk',
			'columns' => ['tm_feature_module_code', 'tm_feature_feature_code'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Module\Features',
			'foreign_columns' => ['sm_feature_module_code', 'sm_feature_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'tm_feature_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}