<?php

namespace Numbers\Users\Organizations\Model\Service\Executed\Workflow;
class Fields extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Executed Workflow Fields';
	public $schema;
	public $name = 'on_executed_workflow_fields';
	public $pk = ['on_execwffield_tenant_id', 'on_execwffield_execwflow_id', 'on_execwffield_field_id'];
	public $tenant = true;
	public $orderby = [
		'on_execwffield_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_execwffield_';
	public $columns = [
		'on_execwffield_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_execwffield_execwflow_id' => ['name' => 'Executed #', 'domain' => 'executed_workflow_id'],
		'on_execwffield_execwfstep_id' => ['name' => 'Executed Step #', 'domain' => 'executed_workflow_id'],
		'on_execwffield_field_id' => ['name' => 'Field #', 'domain' => 'field_id'],
		'on_execwffield_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_execwffield_php_type' => ['name' => 'PHP Type', 'domain' => 'code'],
		'on_execwffield_value_integer' => ['name' => 'Value (Integer)', 'type' => 'bigint', 'null' => true, 'default' => null],
		'on_execwffield_value_numeric' => ['name' => 'Value (Numeric)', 'type' => 'numeric', 'null' => true, 'default' => null],
		'on_execwffield_value_timestamp' => ['name' => 'Value (Timestamp)', 'type' => 'timestamp', 'null' => true, 'default' => null],
		'on_execwffield_value_text' => ['name' => 'Value (Text)', 'type' => 'text', 'null' => true, 'default' => null],
		'on_execwffield_value_mixed' => ['name' => 'Value (Mixed)', 'type' => 'json', 'null' => true, 'default' => null],
	];
	public $constraints = [
		'on_executed_workflow_fields_pk' => ['type' => 'pk', 'columns' => ['on_execwffield_tenant_id', 'on_execwffield_execwflow_id', 'on_execwffield_field_id']],
		'on_execwffield_execwflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwffield_tenant_id', 'on_execwffield_execwflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflows',
			'foreign_columns' => ['on_execwflow_tenant_id', 'on_execwflow_id']
		],
		'on_execwffield_execwfstep_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwffield_tenant_id', 'on_execwffield_execwflow_id', 'on_execwffield_execwfstep_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps',
			'foreign_columns' => ['on_execwfstep_tenant_id', 'on_execwfstep_execwflow_id', 'on_execwfstep_id']
		],
		'on_execwffield_field_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_execwffield_tenant_id', 'on_execwffield_field_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields',
			'foreign_columns' => ['on_workfield_tenant_id', 'on_workfield_id']
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
		'inserted' => true,
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}