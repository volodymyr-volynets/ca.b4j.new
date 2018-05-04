<?php

namespace Numbers\Tenants\Widgets\Attributes\Model\Attribute;
class Details extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Attribute Details';
	public $name = 'tm_attribute_details';
	public $pk = ['tm_attrdetail_tenant_id', 'tm_attrdetail_attribute_id', 'tm_attrdetail_module_id', 'tm_attrdetail_model_id'];
	public $tenant = true;
	public $orderby = [
		'tm_attrdetail_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'tm_attrdetail_';
	public $columns = [
		'tm_attrdetail_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_attrdetail_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'tm_attrdetail_attribute_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'tm_attrdetail_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'tm_attrdetail_model_id' => ['name' => 'Model #', 'domain' => 'group_id'],
		'tm_attrdetail_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_attribute_details_pk' => ['type' => 'pk', 'columns' => ['tm_attrdetail_tenant_id', 'tm_attrdetail_attribute_id', 'tm_attrdetail_module_id', 'tm_attrdetail_model_id']],
		'tm_attrdetail_model_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_attrdetail_model_id'],
			'foreign_model' => '\Numbers\Backend\Db\Common\Model\Models',
			'foreign_columns' => ['sm_model_id']
		],
		'tm_attrdetail_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_attrdetail_tenant_id', 'tm_attrdetail_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
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