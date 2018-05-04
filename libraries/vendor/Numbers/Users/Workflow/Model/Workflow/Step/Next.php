<?php

namespace Numbers\Users\Workflow\Model\Workflow\Step;
class Next extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'WW';
	public $title = 'W/W Workflow Step Next';
	public $schema;
	public $name = 'ww_workflow_step_next';
	public $pk = ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_step_id', 'ww_wrkflwstepnext_next_step_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ww_wrkflwstepnext_';
	public $columns = [
		'ww_wrkflwstepnext_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ww_wrkflwstepnext_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id'],
		'ww_wrkflwstepnext_step_id' => ['name' => 'Step #', 'domain' => 'workflow_id'],
		'ww_wrkflwstepnext_next_step_id' => ['name' => 'Step #', 'domain' => 'workflow_id'],
		'ww_wrkflwstepnext_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ww_workflow_step_next_pk' => ['type' => 'pk', 'columns' => ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_step_id', 'ww_wrkflwstepnext_next_step_id']],
		'ww_wrkflwstepnext_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_step_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflow\Steps',
			'foreign_columns' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id']
		],
		'ww_wrkflwstepnext_next_step_id_fk' => [
			'type' => 'fk',
			'columns' => ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_next_step_id'],
			'foreign_model' => '\Numbers\Users\Workflow\Model\Workflow\Steps',
			'foreign_columns' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id']
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