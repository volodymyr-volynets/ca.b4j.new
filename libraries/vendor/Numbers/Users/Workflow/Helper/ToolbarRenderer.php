<?php

namespace Numbers\Users\Workflow\Helper;
class ToolbarRenderer {

	/**
	 * Render
	 *
	 * @param int $workflow_id
	 * @return string
	 */
	public static function render(array $workflow) : string {
		// determine next steps
		$next_step = self::determineNextSteps($workflow);
		// check if we are in a controller
		if (!empty(\Application::$controller->controller_id) && !empty($next_step['next_resources'])) {
			if (!empty($next_step['next_resources'][\Application::$controller->controller_id])) {
				// write to step
				$merge_result = \Numbers\Users\Workflow\Model\Executed\Workflow\Steps::collectionStatic()->merge([
					'ww_execwstep_execwflow_id' => $workflow['execution_id'],
					'ww_execwstep_step_id' => $next_step['next_resources'][\Application::$controller->controller_id],
					'ww_execwstep_status_id' => 30
				]);
				// update status
				$merge_result = \Numbers\Users\Workflow\Model\Executed\Workflows::collectionStatic()->merge([
					'ww_execwflow_id' => $workflow['execution_id'],
					'ww_execwflow_status_id' => 20
				]);
				$next_step = self::determineNextSteps($workflow);
			}
		}
		// load menu items
		$menu = \Numbers\Backend\System\Modules\Model\Resources::getStatic([
			'where' => [
				'sm_resource_type' => [200, 210],
				'sm_resource_menu_acl_resource_id;IS NOT' => null
			],
			'columns' => [
				'sm_resource_menu_acl_resource_id',
				'sm_resource_menu_url'
			],
			'pk' => 'sm_resource_menu_acl_resource_id'
		]);
		// generate next step links
		$next = [];
		foreach ($next_step['next_step'] as $k => $v) {
			$next[] = \HTML::a(['href' => $menu[$v['page_resource_id']]['sm_resource_menu_url'] . '?__module_id=' . $v['page_module_id'], 'value' => i18n(null, $v['name'])]);
		}
		$value = '';
		if (!empty($next)) {
			$value.= i18n(null, 'Next Step(s):') . ' ';
			$value.= implode(\Format::$symbol_comma . ' ', $next);
		} else if (!empty($next_step['no_more_steps'])) {
			$value.= '<b>' . i18n(null, 'Assignment completed!') . '</b>';
			// if its a last step we empty and update status
			\Session::set(['numbers', 'workflow'], []);
			$merge_result = \Numbers\Users\Workflow\Model\Executed\Workflows::collectionStatic()->merge([
				'ww_execwflow_id' => $workflow['execution_id'],
				'ww_execwflow_status_id' => 30
			]);
		}
		$value.= '<br/>' . i18n(null, 'Preview:') . ' ' . \HTML::a(['href' => 'javascript:void(0);', 'onclick' => '$(\'#workflow_preview_link_id\').toggle();', 'value' => i18n(null, 'open')]);
		$value.= '<div id="workflow_preview_link_id" style="display: none;">' . $next_step['image'] . '</div>';
		$result = \HTML::segment([
			'type' => 'info',
			'header' => i18n(null, 'Workflow #:') . ' ' . \Format::id($workflow['workflow_id']) . \Format::$symbol_comma .  ' ' .
						i18n(null, 'Workflow Name:') . ' ' . \Format::id($next_step['workflow_name']) . \Format::$symbol_comma .  ' ' .
						i18n(null, 'Assignment #:') . ' ' . \Format::id($workflow['assignment_id']) . \Format::$symbol_comma .  ' ' .
						i18n(null, 'Assignment Name:') . ' ' . \Format::id($next_step['assignment_name']) . \Format::$symbol_comma .  ' ' .
						i18n(null, 'Execution #:') . ' ' . \Format::id($workflow['execution_id']),
			'value' => $value,
		]);
		return $result;
	}

	/**
	 * Determine next step
	 *
	 * @param array $workflow
	 * @return array
	 */
	public static function determineNextSteps(array $workflow) : array {
		$result = [
			'success' => false,
			'error' => [],
			'current_step' => [],
			'next_step' => [],
			'assignment_name' => null,
			'workflow_name' => null,
			'next_resources' => [],
			'no_more_steps' => false,
			'image' => null,
		];
		// load executed workflow
		$executed_workflow = \Numbers\Users\Workflow\Model\Collection\Executed\Workflows::getStatic([
			'where' => [
				'ww_execwflow_id' => $workflow['execution_id']
			],
		]);
		$executed_workflow_data = [];
		if ($executed_workflow['success']) {
			$executed_workflow_data = current($executed_workflow['data']);
		}
		$result['assignment_name'] = $executed_workflow_data['ww_execwflow_assignment_name'];
		$result['workflow_name'] = $executed_workflow_data['ww_execwflow_workflow_name'];
		// load workflow
		$versioned_workflow = \Numbers\Users\Workflow\Model\Collection\Workflows::getStatic([
			'where' => [
				'ww_workflow_id' => $workflow['workflow_id']
			],
		]);
		$versioned_workflow_data = [];
		if ($versioned_workflow['success']) {
			$versioned_workflow_data = current($versioned_workflow['data']);
		}
		// find first step
		$completed_steps = [];
		if (empty($executed_workflow_data['\Numbers\Users\Workflow\Model\Executed\Workflow\Steps'])) {
			foreach ($versioned_workflow_data['\Numbers\Users\Workflow\Model\Workflow\Steps'] as $k => $v) {
				if ($v['ww_wrkflwstep_type_id'] == 10) {
					$result['next_step'][$v['ww_wrkflwstep_id']] = [
						'id' => $v['ww_wrkflwstep_id'],
						'name' => $v['ww_wrkflwstep_name'],
						'page_module_id' => $v['ww_wrkflwstep_page_module_id'],
						'page_resource_id' => $v['ww_wrkflwstep_page_resource_id']
					];
					$result['next_resources'][$v['ww_wrkflwstep_page_resource_id']] = $v['ww_wrkflwstep_id'];
				}
			}
		} else {
			// get all steps for later use
			foreach ($executed_workflow_data['\Numbers\Users\Workflow\Model\Executed\Workflow\Steps'] as $k => $v) {
				$completed_steps[$v['ww_execwstep_step_id']] = $v['ww_execwstep_step_id'];
			}
			// get last step
			$last_step = end($executed_workflow_data['\Numbers\Users\Workflow\Model\Executed\Workflow\Steps']);
			$last_step_id = $last_step['ww_execwstep_step_id'];
			$temp = $versioned_workflow_data['\Numbers\Users\Workflow\Model\Workflow\Steps'];
			pk('ww_wrkflwstep_id', $temp);
			if ($temp[$last_step_id]['ww_wrkflwstep_type_id'] == 30) {
				$result['no_more_steps'] = true;
			} else if (!empty($temp[$last_step_id]['\Numbers\Users\Workflow\Model\Workflow\Step\Next'])) {
				foreach ($temp[$last_step_id]['\Numbers\Users\Workflow\Model\Workflow\Step\Next'] as $k => $v) {
					$result['next_step'][$v['ww_wrkflwstepnext_next_step_id']] = [
						'id' => $v['ww_wrkflwstepnext_next_step_id'],
						'name' => $temp[$v['ww_wrkflwstepnext_next_step_id']]['ww_wrkflwstep_name'],
						'page_module_id' => $temp[$v['ww_wrkflwstepnext_next_step_id']]['ww_wrkflwstep_page_module_id'],
						'page_resource_id' => $temp[$v['ww_wrkflwstepnext_next_step_id']]['ww_wrkflwstep_page_resource_id'],
					];
					$result['next_resources'][$temp[$v['ww_wrkflwstepnext_next_step_id']]['ww_wrkflwstep_page_resource_id']] = $v['ww_wrkflwstepnext_next_step_id'];
				}
			}
		}
		// image data
		$data = [];
		foreach ($versioned_workflow_data['\Numbers\Users\Workflow\Model\Workflow\Canvas'] as $k => $v) {
			if (!empty($v['ww_wrkflwcanvas_inactive'])) continue;
			$data[$k] = [
				'order' => $v['ww_wrkflwcanvas_order'],
				'type' => $v['ww_wrkflwcanvas_type_id'],
				'name' => $v['ww_wrkflwcanvas_name'],
				'x1' => $v['ww_wrkflwcanvas_x1'],
				'x2' => $v['ww_wrkflwcanvas_x2'],
				'y1' => $v['ww_wrkflwcanvas_y1'],
				'y2' => $v['ww_wrkflwcanvas_y2'],
				'step' => $v['ww_wrkflwcanvas_step_id'],
				// line attributes
				'line_left_type' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_left_type_id'] ?? 10,
				'line_right_type' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_right_type_id'] ?? 10,
				'line_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_style_id'] ?? 10,
				'line_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines']['ww_wrkflwcnvsline_line_color'] ?? '000000',
				// shape attributes
				'shape_border_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_border_style_id'] ?? 10,
				'shape_border_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_border_color'] ?? '000000',
				'shape_fill_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_shape_fill_color'] ?? 'FFFFFF',
				'completed_border_style' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_border_style_id'] ?? 10,
				'completed_border_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_border_color'] ?? '000000',
				'completed_fill_color' => $v['\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes']['ww_wrkflwcnvsshape_completed_fill_color'] ?? 'FFFFFF',
			];
		}
		$result['image'] = \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $versioned_workflow_data['ww_workflow_canvas_width'],
			'height' => $versioned_workflow_data['ww_workflow_canvas_height'],
			'completed_steps' => $completed_steps
		]);
		return $result;
	}
}