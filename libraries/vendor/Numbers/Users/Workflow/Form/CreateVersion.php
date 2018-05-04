<?php

namespace Numbers\Users\Workflow\Form;
class CreateVersion extends \Object\Form\Wrapper\Base {
	public $form_link = 'ww_create_version';
	public $module_code = 'WW';
	public $title = 'W/W Create Version';
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
			'ww_workflow_id' => [
				'ww_workflow_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Workflow', 'domain' => 'workflow_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Workflow\Model\Workflows', 'options_params' => ['ww_workflow_versioned' => 0]],
			],
			'ww_workflow_version_code' => [
				'ww_workflow_version_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Version Code', 'domain' => 'version_code', 'required' => true, 'percent' => 50],
				'ww_workflow_version_name' => ['order' => 2, 'label_name' => 'Version Name', 'domain' => 'name', 'required' => true, 'percent' => 50],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		]
	];

	public function save(& $form) {
		$model = \Numbers\Users\Workflow\Form\Workflows::API();
		$result = $model->get([
			'ww_workflow_id' => $form->values['ww_workflow_id']
		]);
		// version fields
		$result['values']['ww_workflow_versioned'] = 1;
		$result['values']['ww_workflow_version_workflow_id'] = $result['values']['ww_workflow_id'];
		$result['values']['ww_workflow_version_code'] = $form->values['ww_workflow_version_code'];
		$result['values']['ww_workflow_version_name'] = $form->values['ww_workflow_version_name'];
		$result['values']['ww_workflow_code'].= ' - ' . $result['values']['ww_workflow_version_code'];
		// transaction
		$model->begin();
		unset($result['values']['ww_workflow_id']);
		$merge_result = \Numbers\Users\Workflow\Model\Workflows::collectionStatic()->merge($result['values']);
		if (!$merge_result['success']) {
			$form->error(DANGER, $merge_result['error']);
			return;
		}
		$workflow_id = $merge_result['new_serials']['ww_workflow_id'];
		// copy steps
		foreach ($result['values']['\Numbers\Users\Workflow\Model\Workflow\Steps'] as $k => $v) {
			unset($v['ww_wrkflwstep_tenant_id']);
			$v['ww_wrkflwstep_workflow_id'] = $workflow_id;
			$merge_result = \Numbers\Users\Workflow\Model\Workflow\Steps::collectionStatic()->merge($v);
			if (!$merge_result['success']) {
				$form->error(DANGER, $merge_result['error']);
				return;
			}
		}
		// copy next steps after steps
		foreach ($result['values']['\Numbers\Users\Workflow\Model\Workflow\Steps'] as $k => $v) {
			if (!empty($v['\Numbers\Users\Workflow\Model\Workflow\Step\Next'])) {
				foreach ($v['\Numbers\Users\Workflow\Model\Workflow\Step\Next'] as $k2 => $v2) {
					unset($v2['ww_wrkflwstepnext_tenant_id']);
					$v2['ww_wrkflwstepnext_workflow_id'] = $workflow_id;
					$merge_result = \Numbers\Users\Workflow\Model\Workflow\Step\Next::collectionStatic()->merge($v2);
					if (!$merge_result['success']) {
						$form->error(DANGER, $merge_result['error']);
						return;
					}
				}
			}
		}
		// copy canvas
		foreach ($result['values']['\Numbers\Users\Workflow\Model\Workflow\Canvas'] as $k => $v) {
			unset($v['ww_wrkflwcanvas_tenant_id']);
			$v['ww_wrkflwcanvas_workflow_id'] = $workflow_id;
			$merge_result = \Numbers\Users\Workflow\Model\Workflow\Canvas::collectionStatic()->merge($v);
			if (!$merge_result['success']) {
				$form->error(DANGER, $merge_result['error']);
				return;
			}
			// copy line
			if (!empty($v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines'])) {
				$v2 = $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines'];
				unset($v2['ww_wrkflwcnvsline_tenant_id']);
				$v2['ww_wrkflwcnvsline_workflow_id'] = $workflow_id;
				$merge_result = \Numbers\Users\Workflow\Model\Workflow\Canvas\Lines::collectionStatic()->merge($v2);
				if (!$merge_result['success']) {
					$form->error(DANGER, $merge_result['error']);
					return;
				}
			}
			// copy shape
			if (!empty($v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes'])) {
				$v2 = $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes'];
				unset($v2['ww_wrkflwcnvsshape_tenant_id']);
				$v2['ww_wrkflwcnvsshape_workflow_id'] = $workflow_id;
				$merge_result = \Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes::collectionStatic()->merge($v2);
				if (!$merge_result['success']) {
					$form->error(DANGER, $merge_result['error']);
					return;
				}
			}
		}
		// commit
		$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		$model->commit();
	}
}