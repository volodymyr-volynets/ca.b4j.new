<?php

namespace Numbers\Users\Organizations\DataSource\Workflow;
class Dashboards extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['dashboard_id', 'id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Organizations\Model\Service\Executed\Workflows';
	public $parameters = [
		'module_id' => ['name' => 'Module #', 'domain' => 'module_id', 'required' => true],
		'dashboard_id' => ['name' => 'Dashboard #', 'domain' => 'dashboard_id', 'multiple_column' => 1],
		'entry_type' => ['name' => 'Entry Type', 'domain' => 'group_code', 'multiple_column' => 1, 'required' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'dashboard_id' => 'b.on_workstep_dashboard_id',
			'id' => 'a.on_execwflow_id',
			'step_id' => 'b.on_workstep_id',
			'module_id' => 'a.on_execwflow_linked_module_id',
			'type' => 'a.on_execwflow_linked_type_code',
			'linked_id' => 'a.on_execwflow_linked_id',
			'workflow_name' => 'a.on_execwflow_workflow_name',
			'customer_name' => 'a.on_execwflow_customer_name',
			'customer_phone' => 'a.on_execwflow_customer_phone',
			'customer_email' => 'a.on_execwflow_customer_email',
			'alarm_name' => 'a.on_execwflow_current_alarm_name'
		]);
		// join
		$this->query->join('INNER', new \Numbers\Users\Organizations\Model\Service\Workflow\Steps(), 'b', 'ON', [
			['AND', ['a.on_execwflow_workflow_id', '=', 'b.on_workstep_workflow_id', true], false],
			['AND', ['a.on_execwflow_current_step_id', '=', 'b.on_workstep_id', true], false],
			['AND', ['b.on_workstep_dashboard_id', 'IS NOT', null, false], false],
		]);
		// where
		if (!empty($parameters['dashboard_id'])) {
			$this->query->where('AND', ['b.on_workstep_dashboard_id', '=', $parameters['dashboard_id'], false]);
		}
		$this->query->where('AND', ['a.on_execwflow_linked_module_id', '=', $parameters['module_id'], false]);
		$this->query->where('AND', ['a.on_execwflow_linked_type_code', '=', $parameters['entry_type'], false]);
		// union
		$this->query->union('UNION ALL', function (& $query) use ($parameters) {
			$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflows::queryBuilderStatic(['alias' => 'union_a'])->select();
			$query->columns([
				'dashboard_id' => 'union_b.on_workstpalarm_dashboard_id',
				'id' => 'union_a.on_execwflow_id',
				'step_id' => 'union_a.on_execwflow_current_step_id',
				'module_id' => 'union_a.on_execwflow_linked_module_id',
				'type' => 'union_a.on_execwflow_linked_type_code',
				'linked_id' => 'union_a.on_execwflow_linked_id',
				'workflow_name' => 'union_a.on_execwflow_workflow_name',
				'customer_name' => 'union_a.on_execwflow_customer_name',
				'customer_phone' => 'union_a.on_execwflow_customer_phone',
				'customer_email' => 'union_a.on_execwflow_customer_email',
				'alarm_name' => 'union_a.on_execwflow_current_alarm_name'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms(), 'union_b', 'ON', [
				['AND', ['union_a.on_execwflow_workflow_id', '=', 'union_b.on_workstpalarm_workflow_id', true], false],
				['AND', ['union_a.on_execwflow_current_step_id', '=', 'union_b.on_workstpalarm_step_id', true], false],
				['AND', ['union_a.on_execwflow_current_alarm_code', '=', 'union_b.on_workstpalarm_code', true], false],
				['AND', ['union_b.on_workstpalarm_dashboard_id', 'IS NOT', null, false], false],
			]);
			// where
			if (!empty($parameters['dashboard_id'])) {
				$query->where('AND', ['union_b.on_workstpalarm_dashboard_id', '=', $parameters['dashboard_id'], false]);
			}
			$query->where('AND', ['union_a.on_execwflow_linked_module_id', '=', $parameters['module_id'], false]);
			$query->where('AND', ['union_a.on_execwflow_linked_type_code', '=', $parameters['entry_type'], false]);
			// order by
			$query->orderby(['dashboard_id' => SORT_ASC, 'id' => SORT_DESC]);
		});
	}
}