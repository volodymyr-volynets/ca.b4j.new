<?php

namespace Numbers\Users\Organizations\Helper\ClearModule;
class ClearWorkflows {

	/**
	 * Execute
	 *
	 * @param int $module_id
	 * @param array|string $type_code
	 * @return array
	 */
	public function execute(int $module_id, $type_code) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		$model = new \Numbers\Users\Organizations\Model\Service\Executed\Workflows();
		$model->db_object->begin();
		// workflows
		$query = $model->queryBuilder()->select();
		$query->columns([
			'id' => 'a.on_execwflow_id'
		]);
		$query->where('AND', ['a.on_execwflow_linked_module_id', '=', $module_id]);
		$query->where('AND', ['a.on_execwflow_linked_type_code', '=', $type_code]);
		$delete_result = $query->query(['id']);
		if (!$delete_result['success']) {
			$model->db_object->rollback();
			return $delete_result;
		}
		$ids = array_keys($delete_result['rows']);
		if (!empty($ids)) {
			// fields
			$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields::queryBuilderStatic()->delete();
			$query->where('AND', ['a.on_execwffield_execwflow_id', '=', $ids]);
			$delete_result = $query->query();
			if (!$delete_result['success']) {
				$model->db_object->rollback();
				return $delete_result;
			}
			// step alarms
			$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Step\Alarms::queryBuilderStatic()->delete();
			$query->where('AND', ['a.on_execwfstpalarm_execwflow_id', '=', $ids]);
			$delete_result = $query->query();
			if (!$delete_result['success']) {
				$model->db_object->rollback();
				return $delete_result;
			}
			// steps
			$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps::queryBuilderStatic()->delete();
			$query->where('AND', ['a.on_execwfstep_execwflow_id', '=', $ids]);
			$delete_result = $query->query();
			if (!$delete_result['success']) {
				$model->db_object->rollback();
				return $delete_result;
			}
			// workflows
			$query = $model->queryBuilder()->delete();
			$query->where('AND', ['a.on_execwflow_id', '=', $ids]);
			$delete_result = $query->query();
			if (!$delete_result['success']) {
				$model->db_object->rollback();
				return $delete_result;
			}
		}
		$model->db_object->commit();
		$result['success'] = true;
		return $result;
	}
}