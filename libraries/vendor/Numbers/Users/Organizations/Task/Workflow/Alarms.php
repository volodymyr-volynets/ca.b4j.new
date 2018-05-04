<?php

namespace Numbers\Users\Organizations\Task\Workflow;
class Alarms extends \Numbers\Users\TaskScheduler\Abstract2\Task {

	public $task_code = 'ON_TASK_WORKFLOW_ALARMS';

	public function execute(array $parameters, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => [],
			'data' => []
		];
		if (empty($options['datetime'])) $options['datetime'] = \Format::now('datetime');
		if (empty($options['timezone_code'])) $options['timezone_code'] = \Format::$options['timezone_code'];
		// get all rows
		$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflows::queryBuilderStatic();
		$query->columns([
			'a.on_execwflow_id',
			'a.on_execwflow_workflow_id',
			'a.on_execwflow_current_step_id',
			'a.on_execwflow_current_execwfstep_id',
			'a.on_execwflow_current_step_start',
			'a.on_execwflow_organization_id',
			'b.on_workstpalarm_step_id',
			'b.on_workstpalarm_code',
			'b.on_workstpalarm_name',
			'b.on_workstpalarm_interval_period',
			'b.on_workstpalarm_interval_type_id',
			'b.on_workstpalarm_business',
			'b.on_workstpalarm_from_step_start',
			'b.on_workstpalarm_from_date_field_id',
			'b.on_workstpalarm_inactive',
			'b.on_workstpalarm_order',
			'c.on_execwffield_value_timestamp'
		]);
		$query->join('INNER', new \Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms(), 'b', 'ON', [
			['AND', ['a.on_execwflow_workflow_id', '=', 'b.on_workstpalarm_workflow_id ', true], false],
			['AND', ['a.on_execwflow_current_step_id', '=', 'b.on_workstpalarm_step_id', true], false],
		]);
		$query->join('LEFT', new \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields(), 'c', 'ON', [
			['AND', ['a.on_execwflow_id', '=', 'c.on_execwffield_execwflow_id ', true], false],
			['AND', ['c.on_execwffield_field_id', '=', 'b.on_workstpalarm_from_date_field_id', true], false],
		]);
		$query->orderby(['on_execwflow_id' => SORT_DESC, 'on_workstpalarm_order' => SORT_DESC]);
		$data = $query->query(['on_execwflow_id', 'on_workstpalarm_order']);
		// exit if no rows
		if (empty($data['rows'])) {
			$result['success'] = true;
			return $result;
		}
		// process workflows one by one
		$now_date = new \DateTime(\Format::now('timestamp'), new \DateTimeZone($options['timezone_code']));
		foreach ($data['rows'] as $k => $v) {
			foreach ($v as $k2 => $v2) {
				// determine base date
				if (!empty($v2['on_workstpalarm_from_step_start'])) {
					$base_date = $v2['on_execwflow_current_step_start'];
				} else {
					$base_date = $v2['on_execwffield_value_timestamp'];
				}
				// if business hours
				if ($v2['on_workstpalarm_business']) {
					$future_date = \Numbers\Users\Organizations\Helper\BusinessHours::findNearestDatetime(
						$v2['on_execwflow_organization_id'],
						$base_date,
						$options['timezone_code'],
						\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarm\IntervalTypes::convertToMinutes($v2['on_workstpalarm_interval_type_id'], $v2['on_workstpalarm_interval_period'])
					);
				} else { // regular interval
					$future_date = new \DateTime($base_date, new \DateTimeZone($options['timezone_code']));
					$future_date->add(date_interval_create_from_date_string($v2['on_workstpalarm_interval_period'] . ' ' . \Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarm\IntervalTypes::mapInterval($v2['on_workstpalarm_interval_type_id'])));
				}
				if ($future_date <= $now_date) {
					$update_result = \Numbers\Users\Organizations\Helper\Workflow\Helper::updateWorkflowCurrentAlarm($v2['on_execwflow_id'], $v2['on_execwflow_current_execwfstep_id'], $v2['on_workstpalarm_code'], $v2['on_workstpalarm_name']);
					if (!$update_result['success']) {
						$result['error'] = array_merge($result['error'], $update_result['error']);
						return $result;
					}
					goto nextflow;
				}
			}
nextflow:
		}
		$result['success'] = true;
		return $result;
	}
}