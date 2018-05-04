<?php

namespace Numbers\Users\Organizations\Form\Service\Workflow;
class CreateVersion extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_create_version';
	public $module_code = 'ON';
	public $title = 'O/N Create Version (Workflow)';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'on_workflow_id' => [
				'on_workflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow', 'domain' => 'workflow_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflows::optionsActive', 'options_params' => ['on_workflow_versioned' => 0, 'on_workflow_type_id' => 10]],
			],
			'on_workflow_version_code' => [
				'on_workflow_version_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Version Code', 'domain' => 'version_code', 'required' => true, 'percent' => 50],
				'on_workflow_version_name' => ['order' => 2, 'label_name' => 'Version Name', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		]
	];

	public function save(& $form) {
		$model = \Numbers\Users\Organizations\Form\Service\Workflows::API();
		$model->begin();
		// copy workflow
		$this->copySingleFlow($form->values['on_workflow_id'], $form);
		// all good
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		$model->commit();
	}

	private function copySingleFlow($workflow_id, & $form, $parent_workflow_id = null) {
		$model = \Numbers\Users\Organizations\Form\Service\Workflows::API();
		$result = $model->get([
			'on_workflow_id' => $workflow_id
		]);
		// version fields
		$result['values']['on_workflow_versioned'] = 1;
		$result['values']['on_workflow_version_workflow_id'] = $result['values']['on_workflow_id'];
		$result['values']['on_workflow_version_code'] = $form->values['on_workflow_version_code'];
		$result['values']['on_workflow_version_name'] = $form->values['on_workflow_version_name'];
		$result['values']['on_workflow_code'].= ' - ' . strtoupper($result['values']['on_workflow_version_code']);
		if (!empty($parent_workflow_id)) {
			$result['values']['on_workflow_parent_workflow_id'] = $parent_workflow_id;
		}
		// transaction
		$model->begin();
		unset($result['values']['on_workflow_id']);
		$merge_result = \Numbers\Users\Organizations\Model\Service\Workflows::collectionStatic()->merge($result['values']);
		if (!$merge_result['success']) {
			$form->error(DANGER, $merge_result['error']);
			return;
		}
		// process subflows
		$subflow_replaces = [];
		$subflows = \Numbers\Users\Organizations\Model\Service\Workflows::getStatic([
			'where' => [
				'on_workflow_parent_workflow_id' => $workflow_id,
			],
			'pk' => ['on_workflow_id']
		]);
		if (!empty($subflows)) {
			foreach ($subflows as $k => $v) {
				$subflow_replaces[$k] = $this->copySingleFlow($k, $form, $merge_result['new_serials']['on_workflow_id']);
				if ($form->hasErrors()) return;
			}
		}
		$workflow_id = $merge_result['new_serials']['on_workflow_id'];
		// copy steps
		foreach ($result['values']['\Numbers\Users\Organizations\Model\Service\Workflow\Steps'] as $k => $v) {
			unset($v['on_workstep_tenant_id']);
			$v['on_workstep_workflow_id'] = $workflow_id;
			// handle replaces
			if (!empty($subflow_replaces) && !empty($v['on_workstep_subflow_workflow_id'])) {
				$v['on_workstep_subflow_workflow_id'] = $subflow_replaces[$v['on_workstep_subflow_workflow_id']];
			}
			$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Steps::collectionStatic()->merge($v);
			if (!$merge_result['success']) {
				$form->error(DANGER, $merge_result['error']);
				return;
			}
		}
		// copy next steps after steps
		foreach ($result['values']['\Numbers\Users\Organizations\Model\Service\Workflow\Steps'] as $k => $v) {
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next'])) {
				foreach ($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next'] as $k2 => $v2) {
					unset($v2['on_workstpnext_tenant_id']);
					$v2['on_workstpnext_workflow_id'] = $workflow_id;
					$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Next::collectionStatic()->merge($v2);
					if (!$merge_result['success']) {
						$form->error(DANGER, $merge_result['error']);
						return;
					}
				}
			}
			// copy fields
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields'])) {
				foreach ($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields'] as $k2 => $v2) {
					unset($v2['on_workstpfield_tenant_id']);
					$v2['on_workstpfield_workflow_id'] = $workflow_id;
					$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields::collectionStatic()->merge($v2);
					if (!$merge_result['success']) {
						$form->error(DANGER, $merge_result['error']);
						return;
					}
				}
			}
			// copy alarms
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms'])) {
				foreach ($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms'] as $k2 => $v2) {
					unset($v2['on_workstpalarm_tenant_id']);
					$v2['on_workstpalarm_workflow_id'] = $workflow_id;
					$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Alarms::collectionStatic()->merge($v2);
					if (!$merge_result['success']) {
						$form->error(DANGER, $merge_result['error']);
						return;
					}
				}
			}
			// copy complementary
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary'])) {
				unset($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary']['on_workstpcomp_tenant_id']);
				$v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary']['on_workstpcomp_workflow_id'] = $workflow_id;
				$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary::collectionStatic()->merge($v['\Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary']);
				if (!$merge_result['success']) {
					$form->error(DANGER, $merge_result['error']);
					return;
				}
			}
		}
		// copy canvas
		foreach ($result['values']['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas'] as $k => $v) {
			unset($v['on_workcanvas_tenant_id']);
			$v['on_workcanvas_workflow_id'] = $workflow_id;
			$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Canvas::collectionStatic()->merge($v);
			if (!$merge_result['success']) {
				$form->error(DANGER, $merge_result['error']);
				return;
			}
			// copy line
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines'])) {
				$v2 = $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines'];
				unset($v2['on_workcanvline_tenant_id']);
				$v2['on_workcanvline_workflow_id'] = $workflow_id;
				$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines::collectionStatic()->merge($v2);
				if (!$merge_result['success']) {
					$form->error(DANGER, $merge_result['error']);
					return;
				}
			}
			// copy shape
			if (!empty($v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes'])) {
				$v2 = $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes'];
				unset($v2['on_workcanvshape_tenant_id']);
				$v2['on_workcanvshape_workflow_id'] = $workflow_id;
				$merge_result = \Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes::collectionStatic()->merge($v2);
				if (!$merge_result['success']) {
					$form->error(DANGER, $merge_result['error']);
					return;
				}
			}
		}
		// commit
		$model->commit();
	}
}