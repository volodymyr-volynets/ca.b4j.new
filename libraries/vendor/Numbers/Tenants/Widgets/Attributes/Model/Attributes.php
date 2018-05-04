<?php

namespace Numbers\Tenants\Widgets\Attributes\Model;
class Attributes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Attributes';
	public $name = 'tm_attributes';
	public $pk = ['tm_attribute_tenant_id', 'tm_attribute_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_attribute_';
	public $columns = [
		'tm_attribute_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_attribute_id' => ['name' => 'Attribute #', 'domain' => 'field_id_sequence'],
		'tm_attribute_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'tm_attribute_name' => ['name' => 'Name', 'domain' => 'name'],
		'tm_attribute_method' => ['name' => 'Method', 'domain' => 'code', 'options_model' => '\Numbers\Tenants\Widgets\Attributes\Model\Methods'],
		'tm_attribute_model_id' => ['name' => 'Model', 'domain' => 'group_id', 'null' => true],
		'tm_attribute_domain' => ['name' => 'Domain', 'domain' => 'code', 'null' => true],
		'tm_attribute_type' => ['name' => 'Type', 'domain' => 'code'],
		'tm_attribute_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_attributes_pk' => ['type' => 'pk', 'columns' => ['tm_attribute_tenant_id', 'tm_attribute_id']],
		'tm_attribute_code_un' => ['type' => 'unique', 'columns' => ['tm_attribute_tenant_id', 'tm_attribute_code']],
		'tm_attribute_model_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_attribute_model_id'],
			'foreign_model' => '\Numbers\Backend\Db\Common\Model\Models',
			'foreign_columns' => ['sm_model_id']
		]
	];
	public $indexes = [
		'tm_attributes_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['tm_attribute_code', 'tm_attribute_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}