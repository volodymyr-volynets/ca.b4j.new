<?php

namespace Numbers\Users\Organizations\Helper\Workflow;
class Helper {

	/**
	 * Cached fields
	 *
	 * @var array
	 */
	public static $cached_fields;

	/**
	 * Start workflow
	 *
	 * @param int $workflow_id
	 * @param string $linked_type
	 * @param int $linked_module_id
	 * @param int $linked_id
	 * @param string $name
	 * @param array $options
	 * @return array
	 */
	public static function start(int $workflow_id, string $linked_type, int $linked_module_id, int $linked_id, string $name, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		$workflow = \Numbers\Users\Organizations\Model\Service\Workflows::getStatic([
			'where' => [
				'on_workflow_id' => $workflow_id
			],
			'pk' => null,
			'single_row' => true
		]);
		$model = new \Numbers\Users\Organizations\Model\Service\Executed\Workflows();
		$model->db_object->begin();
		$data = [
			'on_execwflow_workflow_id' => $workflow_id,
			'on_execwflow_versioned_workflow_id' => $workflow['on_workflow_version_workflow_id'],
			'on_execwflow_workflow_name' => $workflow['on_workflow_name'],
			'on_execwflow_customer_name' => $name,
			'on_execwflow_customer_phone' => $options['on_execwflow_customer_phone'],
			'on_execwflow_customer_email' => $options['on_execwflow_customer_email'],
			'on_execwflow_status_id' => 10,
			'on_execwflow_linked_type_code' => $linked_type,
			'on_execwflow_linked_module_id' => $linked_module_id,
			'on_execwflow_linked_id' => $linked_id,
			'on_execwflow_organization_id' => $options['on_execwflow_organization_id'],
			'on_execwflow_inactive' => 0
		];
		$flow_result = $model->collection()->merge($data);
		if (!$flow_result['success']) {
			$model->db_object->rollback();
			return $flow_result;
		}
		$execwflow_id = $flow_result['new_serials']['on_execwflow_id'];
		// process first steps
		$next_steps = self::getNextSteps($workflow_id, $execwflow_id);
		if (!empty($next_steps)) {
			foreach ($next_steps as $k => $v) {
				if ($v['on_workstep_subtype_id'] == 999) {
					$auto_result = self::processAutomaticSteps($workflow_id, $execwflow_id, $v);
					if (!$auto_result['success']) {
						$model->db_object->rollback();
						return $auto_result;
					}
				}
			}
		}
		$model->db_object->commit();
		$result['success'] = true;
		return $result;
	}

	/**
	 * Get next step
	 *
	 * @param int $workflow_id
	 * @param int $execwflow_id
	 * @return array
	 */
	public static function getNextSteps(int $workflow_id, int $execwflow_id) : array {
		// find last step
		$query = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps::queryBuilderStatic()->select();
		$query->where('AND', ['a.on_execwfstep_execwflow_id', '=', $execwflow_id]);
		$query->orderby(['on_execwfstep_id' => SORT_DESC]);
		$query->limit(1);
		$existing_step = $query->query();
		if (empty($existing_step['rows'])) {
			return \Numbers\Users\Organizations\Model\Service\Workflow\Steps::getStatic([
				'where' => [
					'on_workstep_workflow_id' => $workflow_id,
					'on_workstep_type_id' => 10,
				],
				'pk' => ['on_workstep_id']
			]);
		} else {
			// if status not complete means we are on the right step, just return it
			if ($existing_step['rows'][0]['on_execwfstep_status_id'] != 30) {
				return \Numbers\Users\Organizations\Model\Service\Workflow\Steps::getStatic([
					'where' => [
						'on_workstep_workflow_id' => $workflow_id,
						'on_workstep_id' => $existing_step['rows'][0]['on_execwfstep_step_id'],
					],
					'pk' => ['on_workstep_id']
				]);
			} else {
				// last step
				$step_id = $existing_step['rows'][0]['on_execwfstep_step_id'];
				$chosen_step_id = $existing_step['rows'][0]['on_execwfstep_chosen_step_id'];
				// fetch next steps
				$query = \Numbers\Users\Organizations\Model\Service\Workflow\Steps::queryBuilderStatic()->select();
				$query->where('AND', ['a.on_workstep_workflow_id', '=', $workflow_id]);
				$query->where('AND', function (& $query) use ($workflow_id, $step_id, $chosen_step_id) {
					$query = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Next::queryBuilderStatic(['alias' => 'exists_a'])->select();
					$query->columns(['exists_a.on_workstpnext_next_step_id']);
					$query->where('AND', ['exists_a.on_workstpnext_workflow_id', '=', $workflow_id]);
					$query->where('AND', ['exists_a.on_workstpnext_step_id', '=', $step_id, false]);
					$query->where('AND', ['exists_a.on_workstpnext_next_step_id', '=', 'a.on_workstep_id', true]);
					if (!empty($chosen_step_id)) {
						$query->where('AND', ['exists_a.on_workstpnext_next_step_id', '=', $chosen_step_id]);
					}
				}, 'EXISTS');
				$result = $query->query(['on_workstep_id']);
				return $result['rows'];
			}
		}
	}

	/**
	 * Prepare for render next step
	 *
	 * @param int $workflow_id
	 * @param int $execwflow_id
	 * @return array
	 */
	public static function prepareForRenderNextStep(int $workflow_id, int $execwflow_id) : array {
		$result = [
			'success' => false,
			'error' => [],
			'form_model' => '',
			'step_id' => null,
			'step_name' => '',
			'html' => ''
		];
		$next_steps = self::getNextSteps($workflow_id, $execwflow_id);
		if (count($next_steps) == 1) {
			$next = current($next_steps);
			$result['step_id'] = $next['on_workstep_id'];
			$result['step_name'] = $next['on_workstep_name'];
			switch ($next['on_workstep_subtype_id']) {
				case 100: // form
					$result['form_model'] = '\Numbers\Users\Organizations\Form\Workflow\SubType\Form';
					break;
				case 200: // decision
					$result['form_model'] = '\Numbers\Users\Organizations\Form\Workflow\SubType\Decision';
					break;
				case 300:
					$result['form_model'] = '\Numbers\Users\Organizations\Form\Workflow\SubType\Information';
					break;
				case 900: // assignment
					$result['form_model'] = '\Numbers\Users\Organizations\Form\Workflow\SubType\Assignment';
					break;
				default:
					Throw new \Exception('Type ' . $next['on_workstep_subtype_id'] . '?');
			}
		} else { // we have a choice
			return $result;
		}
		$result['success'] = true;
		return $result;
	}

	/**
	 * Process automatic step
	 *
	 * @param int $workflow_id
	 * @param int $execwflow_id
	 * @param array $step_data
	 * @return array
	 */
	public static function processAutomaticSteps(int $workflow_id, int $execwflow_id, array $step_data) : array {
		$result = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps::collectionStatic()->merge([
			'on_execwfstep_execwflow_id' => $execwflow_id,
			'on_execwfstep_workflow_id' => $workflow_id,
			'on_execwfstep_step_id' => $step_data['on_workstep_id'],
			'on_execwfstep_name' => $step_data['on_workstep_name'],
			'on_execwfstep_status_id' => 30
		]);
		// insert fields
		$field_result = self::insertSingleField($execwflow_id, $result['new_serials']['on_execwfstep_id'], 'SYSTEM_BOOK_DATE', \Format::now('timestamp'));
		if (!$field_result['success']) {
			return $field_result;
		}
		// current step
		$current_result = self::updateWorkflowCurrentStep($execwflow_id, $step_data['on_workstep_id'], $result['new_serials']['on_execwfstep_id']);
		if (!$current_result['success']) {
			return $current_result;
		}
		return $result;
	}

	/**
	 * Process automatic step
	 *
	 * @param int $workflow_id
	 * @param int $execwflow_id
	 * @param int $step_id
	 * @param array $options
	 *		on_execwfstep_chosen_step_id
	 * @return array
	 */
	public static function processSingleStep(int $workflow_id, int $execwflow_id, int $step_id, array $options = []) : array {
		$step_data = \Numbers\Users\Organizations\Model\Service\Workflow\Steps::getStatic([
			'where' => [
				'on_workstep_workflow_id' => $workflow_id,
				'on_workstep_id' => $step_id,
			],
			'pk' => ['on_workstep_id'],
			'single_row' => true
		]);
		$result = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Steps::collectionStatic()->merge([
			'on_execwfstep_execwflow_id' => $execwflow_id,
			'on_execwfstep_workflow_id' => $workflow_id,
			'on_execwfstep_step_id' => $step_id,
			'on_execwfstep_name' => $step_data['on_workstep_name'],
			'on_execwfstep_status_id' => 30,
			'on_execwfstep_chosen_step_id' => $options['on_execwfstep_chosen_step_id'] ?? null
		]);
		if (!$result['success']) {
			return $result;
		}
		// load complementary
		$info_result = \Numbers\Users\Organizations\Model\Service\Workflow\Step\Complementary::getStatic([
			'where' => [
				'on_workstpcomp_workflow_id' => $workflow_id,
				'on_workstpcomp_step_id' => $step_id,
			],
			'pk' => null,
			'single_row' => true
		]);
		if (!empty($info_result['on_workstpcomp_date_field_id'])) {
			$field_result = self::insertSingleField($execwflow_id, $result['new_serials']['on_execwfstep_id'], $info_result['on_workstpcomp_date_field_id'], \Format::now('timestamp'));
			if (!$field_result['success']) {
				return $field_result;
			}
		}
		// current step
		$current_result = self::updateWorkflowCurrentStep($execwflow_id, $step_id, $result['new_serials']['on_execwfstep_id'], [
			'on_workstep_type_id' => $step_data['on_workstep_type_id']
		]);
		if (!$current_result['success']) {
			return $current_result;
		}
		return $result;
	}

	/**
	 * Update workflow current step
	 *
	 * @param int $execwflow_id
	 * @param int $step_id
	 * @param int $execwfstep_id
	 * @param array $options
	 *		on_workstep_type_id
	 * @return array
	 */
	public static function updateWorkflowCurrentStep(int $execwflow_id, int $step_id, int $execwfstep_id, array $options = []) : array {
		$data = [
			'on_execwflow_id' => $execwflow_id,
			'on_execwflow_current_execwfstep_id' =>$execwfstep_id,
			'on_execwflow_current_step_id' => $step_id,
			'on_execwflow_current_step_start' => \Format::now('timestamp'),
			// important to reset alarm when we change step
			'on_execwflow_current_alarm_code' => null,
			'on_execwflow_current_alarm_name' => null,
		];
		if (!empty($options['on_workstep_type_id']) && $options['on_workstep_type_id'] == 30) {
			$data['on_execwflow_status_id'] = 30;
		} else {
			$data['on_execwflow_status_id'] = 20;
		}
		return \Numbers\Users\Organizations\Model\Service\Executed\Workflows::collectionStatic()->merge($data);
	}

	/**
	 * Update workflow alarm
	 *
	 * @param int $execwflow_id
	 * @param string $alarm_code
	 * @param string $alarm_name
	 * @return array
	 */
	public static function updateWorkflowCurrentAlarm(int $execwflow_id, int $execwfstep_id, string $alarm_code, string $alarm_name) : array {
		$result = \Numbers\Users\Organizations\Model\Service\Executed\Workflows::collectionStatic()->merge([
			'on_execwflow_id' => $execwflow_id,
			'on_execwflow_current_alarm_code' => $alarm_code,
			'on_execwflow_current_alarm_name' => $alarm_name,
		]);
		$alarm_result = \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Step\Alarms::collectionStatic()->merge([
			'on_execwfstpalarm_execwflow_id' => $execwflow_id,
			'on_execwfstpalarm_execwfstep_id' => $execwfstep_id,
			'on_execwfstpalarm_alarm_code' => $alarm_code,
			'on_execwfstpalarm_alarm_name' => $alarm_name,
		]);
		if (!$alarm_result['success']) {
			return $alarm_result;
		}
		return $result;
	}

	/**
	 * Insert single field
	 *
	 * @param int $execwflow_id
	 * @param int $execwfstep_id
	 * @param int|string $field_code
	 * @param type $field_value
	 * @return array
	 */
	public static function insertSingleField(int $execwflow_id, int $execwfstep_id, $field_code, $field_value) : array {
		if (!isset(self::$cached_fields)) {
			self::$cached_fields = \Numbers\Users\Organizations\Model\Service\Workflow\Fields::getStatic([
				'pk' => ['on_workfield_code']
			]);
		}
		// if we pass field id
		if (is_numeric($field_code)) {
			foreach (self::$cached_fields as $k => $v) {
				if ($v['on_workfield_id'] == $field_code) {
					$field_code = $k;
					break;
				}
			}
		}
		// determine storage type
		$type = 'mixed';
		if (in_array(self::$cached_fields[$field_code]['on_workfield_type'], ['date', 'time', 'datetime', 'timestamp'])) {
			$type = 'timestamp';
		} else if (self::$cached_fields[$field_code]['on_workfield_php_type'] == 'integer') {
			$type = 'integer';
		} else if (self::$cached_fields[$field_code]['on_workfield_php_type'] == 'float' || self::$cached_fields[$field_code]['on_workfield_php_type'] == 'bcnumeric') {
			$type = 'numeric';
		} else if (self::$cached_fields[$field_code]['on_workfield_php_type'] == 'string') {
			$type = 'text';
		}
		// merge
		return \Numbers\Users\Organizations\Model\Service\Executed\Workflow\Fields::collectionStatic()->merge([
			'on_execwffield_execwflow_id' => $execwflow_id,
			'on_execwffield_execwfstep_id' => $execwfstep_id,
			'on_execwffield_field_id' => self::$cached_fields[$field_code]['on_workfield_id'],
			'on_execwffield_php_type' => $type,
			'on_execwffield_value_' . $type => $field_value,
		]);
	}

	/**
	 * Preview workflow
	 *
	 * @param int $workflow_id
	 * @return mixed
	 */
	public static function previewWorkflow(int $workflow_id, array $executed_steps) {
		$collection_model = new \Numbers\Users\Organizations\Model\Service\Collection\Workflows();
		$collection_data = $collection_model->get([
			'where' => [
				'on_workflow_id' => $workflow_id
			]
		]);
		$collection_data = current($collection_data['data']);
		$data = [];
		foreach ($collection_data['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas'] as $k => $v) {
			if (!empty($v['on_workcanvas_inactive'])) continue;
			$data[$k] = [
				'order' => $v['on_workcanvas_order'],
				'type' => $v['on_workcanvas_type_id'],
				'name' => $v['on_workcanvas_name'],
				'step' => $v['on_workcanvas_step_id'],
				'x1' => $v['on_workcanvas_x1'],
				'x2' => $v['on_workcanvas_x2'],
				'y1' => $v['on_workcanvas_y1'],
				'y2' => $v['on_workcanvas_y2'],
				// line attributes
				'line_left_type' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_left_type_id'] ?? 10,
				'line_right_type' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_right_type_id'] ?? 10,
				'line_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_style_id'] ?? 10,
				'line_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines']['on_workcanvline_line_color'] ?? '000000',
				// shape attributes
				'shape_border_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_border_style_id'] ?? 10,
				'shape_border_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_border_color'] ?? '000000',
				'shape_fill_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_shape_fill_color'] ?? 'FFFFFF',
				'completed_border_style' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_border_style_id'] ?? 10,
				'completed_border_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_border_color'] ?? '000000',
				'completed_fill_color' => $v['\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes']['on_workcanvshape_completed_fill_color'] ?? 'FFFFFF',
			];
		}
		return \Numbers\Users\Workflow\Helper\CanvasRenderer::render($data, [
			'width' => $collection_data['on_workflow_canvas_width'],
			'height' => $collection_data['on_workflow_canvas_height'],
			'completed_steps' => $executed_steps
		]);
	}

	/**
	 * Generate URL
	 *
	 * @param string $linked_type
	 * @param int $module_id
	 * @param int $linked_id
	 * @return string
	 */
	public static function generateLinkedIdURL(string $linked_type, int $module_id, int $linked_id) : string {
		$temp = \Numbers\Users\Organizations\Model\Service\Executed\Linked\Types::getStatic();
		return str_replace(['[module_id]', '[linked_id]'], [$module_id, $linked_id], $temp[$linked_type]['on_execwflinktype_url']);
	}
}