<?php

namespace Numbers\Users\Workflow\Model\Workflow;
class Steps extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflow Steps';
	public $schema;
	public $name = 'ww_workflow_steps';
	public $pk = ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id'];
	public $tenant = true;
	public $orderby = [
		'ww_wrkflwstep_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ww_wrkflwstep_';
	public $columns = [
		'ww_wrkflwstep_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_wrkflwstep_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_wrkflwstep_id' => ['name' => 'Step #', 'domain' => 'workflow_id'],
		'ww_wrkflwstep_name' => ['name' => 'Name', 'domain' => 'name'],
		'ww_wrkflwstep_order' => ['name' => 'Order', 'domain' => 'order'],
		'ww_wrkflwstep_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Workflow\Model\Workflow\Step\Types'],
		'ww_wrkflwstep_page_module_id' => ['name' => 'Page Module #', 'domain' => 'module_id', 'null' => true],
		'ww_wrkflwstep_page_resource_id' => ['name' => 'Page Resource #', 'domain' => 'resource_id', 'null' => true],
		'ww_wrkflwstep_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_workflow_steps_pk' => ['type' => 'pk', 'columns' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id']],
		'ww_wrkflwstep_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflows',
			'foreign_columns' => ['ww_workflow_tenant_id', 'ww_workflow_id']
		]
	];
	public $indexes = [
		'ww_workflow_steps_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ww_wrkflwstep_name']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'ww_wrkflwstep_name' => 'name'
	];
	public $options_active = [
		'ww_wrkflwstep_inactive' => 0
	];
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