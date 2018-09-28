<?php

namespace Numbers\Tenants\Tenants\Model\Assignment;
class Details extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Assignment Details';
	public $name = 'tm_assignment_details';
	public $pk = ['tm_assigndet_tenant_id', 'tm_assigndet_assignment_id', 'tm_assigndet_abacattr_id'];
	public $tenant = true;
	public $orderby = [
		'tm_assigndet_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'tm_assigndet_';
	public $columns = [
		'tm_assigndet_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_assigndet_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'tm_assigndet_assignment_id' => ['name' => 'Assignment #', 'domain' => 'assignment_id'],
		'tm_assigndet_abacattr_id' => ['name' => 'Attribute #', 'domain' => 'attribute_id'],
		'tm_assigndet_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_assignment_details_pk' => ['type' => 'pk', 'columns' => ['tm_assigndet_tenant_id', 'tm_assigndet_assignment_id', 'tm_assigndet_abacattr_id']],
		'tm_assigndet_assignment_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_assigndet_tenant_id', 'tm_assigndet_assignment_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Assignments',
			'foreign_columns' => ['tm_assignment_tenant_id' , 'tm_assignment_id']
		],
		'tm_assigndet_abacattr_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_assigndet_abacattr_id'],
			'foreign_model' => '\Numbers\Backend\ABAC\Model\Attributes',
			'foreign_columns' => ['sm_abacattr_id']
		],
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