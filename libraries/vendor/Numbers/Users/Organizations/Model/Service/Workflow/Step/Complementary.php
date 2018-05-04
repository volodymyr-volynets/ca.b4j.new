<?php

namespace Numbers\Users\Organizations\Model\Service\Workflow\Step;
class Complementary extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'ON Workflow Step Complementary';
	public $schema;
	public $name = 'on_workflow_step_complementary';
	public $pk = ['on_workstpcomp_tenant_id', 'on_workstpcomp_workflow_id', 'on_workstpcomp_step_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_workstpcomp_';
	public $columns = [
		'on_workstpcomp_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_workstpcomp_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'on_workstpcomp_step_id' => ['name' => 'Step #', 'domain' => 'step_id'],
		'on_workstpcomp_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
		'on_workstpcomp_date_field_id' => ['name' => 'Date Field #', 'domain' => 'field_id', 'null' => true],
		'on_workstpcomp_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_workflow_step_complementary_pk' => ['type' => 'pk', 'columns' => ['on_workstpcomp_tenant_id', 'on_workstpcomp_workflow_id', 'on_workstpcomp_step_id']],
		'on_workstpcomp_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpcomp_tenant_id', 'on_workstpcomp_workflow_id', 'on_workstpcomp_step_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Steps',
			'foreign_columns' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id']
		],
		'on_workstpcomp_date_field_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_workstpcomp_tenant_id', 'on_workstpcomp_date_field_id'],
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}