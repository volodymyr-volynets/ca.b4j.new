<?php

namespace Numbers\Tenants\Tenants\Model;
class Activation {

	/**
	 * Activate module
	 *
	 * @param string $module_code
	 * @param string $module_name
	 * @param array $options
	 */
	public static function activateModule(string $module_code, $module_name = null, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		do {
			$modules = \Numbers\Tenants\Tenants\DataSource\Activation\Module\Modules::getStatic();
			if (empty($modules[$module_code])) {
				$result['error'][] = 'Module cannot be activated!';
				break;
			}
			$model = new \Numbers\Tenants\Tenants\Model\Modules();
			$model->db_object->begin();
			// save new module
			if (empty($module_name)) {
				$module_name = $modules[$module_code]['sm_module_name'];
			}
			$module_result = $model->collection()->merge([
				'tm_module_module_code' => $module_code,
				'tm_module_name' => $module_name,
				'tm_module_inactive' => 0
			]);
			if (!$module_result['success']) {
				$result['error'] = array_merge($result['error'], $module_result['error']);
				break;
			}
			$module_id = $module_result['new_serials']['tm_module_id'];
			// activate default features
			$default_features = \Numbers\Backend\System\Modules\Model\Module\Features::getStatic([
				'where' => [
					'sm_feature_module_code' => $module_code,
					'sm_feature_activated_by_default' => 1,
					'sm_feature_inactive' => 0
				]
			]);
			foreach ($default_features as $k => $v) {
				$feature_result = self::activateFeature($module_id, $module_code, $v['sm_feature_code']);
				if (!$feature_result['success']) {
					$result['error'] = array_merge($result['error'], $feature_result['error']);
					goto finish;
				}
			}
			// custom activation model
			if (!empty($modules[$module_code]['sm_module_activation_model'])) {
				$activation_options = [
					'module_id' => $module_id,
					'module_code' => $module_code
				];
				$activation_model = new $modules[$module_code]['sm_module_activation_model']($activation_options);
				// see if we have \Object\Activation\Base
				if (method_exists($activation_model, 'activate')) {
					$activation_result = $activation_model->activate();
				} else { // \Object\Import
					$activation_result = $activation_model->process();
				}
				if (!$activation_result['success']) {
					$result['error'] = array_merge($result['error'], $activation_result['error']);
					break;
				}
			}
			// commit if we got here
			$model->db_object->commit();
			$result['success'] = true;
		} while(0);
finish:
		return $result;
	}

	/**
	 * Activate feature
	 *
	 * @param int $module_id
	 * @param string $feature_code
	 * @param array $options
	 */
	public static function activateFeature(int $module_id, string $module_code, string $feature_code, array $options = []) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		do {
			$model = new \Numbers\Tenants\Tenants\Model\Modules();
			$model->cache = false;
			$model->db_object->begin();
			$feature_model = new \Numbers\Tenants\Tenants\Model\Module\Features();
			$feature_model->cache = false;
			// check dependencies
			$feature_collection = new \Numbers\Backend\System\Modules\Model\Collection\Module\Features();
			$feature_result = $feature_collection->get([
				'where' => [
					'sm_feature_code' => $feature_code
				],
				'single_row' => true
			]);
			if (!$feature_result['success']) {
				$result['error'] = array_merge($result['error'], $feature_result['error']);
				break;
			}
			if (empty($feature_result['data'])) {
				$result['error'][] = \Object\Content\Messages::record_not_found;
				$model->db_object->rollback();
				break;
			}
			// grab module code from features
			if (empty($module_code)) {
				$module_code = $feature_result['data']['sm_feature_module_code'];
			}
			if ($feature_result['data']['sm_feature_type'] != 30) {
				// see if we have a feature
				$feature_check = $feature_model->get([
					'where' => [
						'tm_feature_module_id' => $module_id,
						'tm_feature_feature_code' => $feature_code
					]
				]);
				if (!empty($feature_check)) {
					goto success;
				}
			}
			// see if we have dependencies
			if (!empty($feature_result['data']['\Numbers\Backend\System\Modules\Model\Module\Dependencies'])) {
				// see if module is already active
				$already_active_modules_result = $model->get([
					'where' => [
						'tm_module_inactive' => 0
					],
					'pk' => ['tm_module_module_code']
				]);
				$already_active_features_result = $feature_model->get([
					'where' => [
						'tm_feature_inactive' => 0
					],
					'pk' => ['tm_feature_module_code', 'tm_feature_feature_code']
				]);
				// check dependencies
				foreach ($feature_result['data']['\Numbers\Backend\System\Modules\Model\Module\Dependencies'] as $k => $v) {
					// see if we have a feature from another module
					if ($v['sm_mdldep_child_module_code'] != $module_code && empty($already_active_modules_result[$v['sm_mdldep_child_module_code']])) {
						$result['error'][] = 'You need to activate ' . $v['sm_mdldep_child_module_code'] . ' module first!';
						$model->db_object->rollback();
						goto finish;
					} else if ($v['sm_mdldep_child_module_code'] != $module_code) {
						if (empty($already_active_features_result[$v['sm_mdldep_child_module_code']][$v['sm_mdldep_child_feature_code']])) {
							$result['error'][] = 'You need to activate ' . $v['sm_mdldep_child_module_code'] . ' module and ' . $v['sm_mdldep_child_feature_code'] . ' feature first!';
							$model->db_object->rollback();
							goto finish;
						}
					}
					// we activate features from the same module
					if ($v['sm_mdldep_child_module_code'] == $module_code) {
						// see if we have a feature
						$feature_check = $feature_model->get([
							'where' => [
								'tm_feature_module_id' => $module_id,
								'tm_feature_feature_code' => $v['sm_mdldep_child_feature_code']
							]
						]);
						if (!empty($feature_check)) continue;
						// activate dependent feature if its the same module
						$activation_dependency_result = self::activateFeature($module_id, $v['sm_mdldep_child_module_code'], $v['sm_mdldep_child_feature_code']);
						if (!$activation_dependency_result['success']) {
							$result['error'] = array_merge($result['error'], $activation_dependency_result['error']);
							break;
						}
					}
				}
			}
			// activation model
			if (!empty($feature_result['data']['sm_feature_activation_model'])) {
				$activation_model_class = $feature_result['data']['sm_feature_activation_model'];
				$activation_model_model = new $activation_model_class([
					'module_id' => $module_id
				]);
				if (method_exists($activation_model_model, 'activate')) {
					$activation_model_result = $activation_model_model->activate();
				} else {
					$activation_model_result = $activation_model_model->process();
				}
				if (!$activation_model_result['success']) {
					$result['error'] = array_merge($result['error'], $activation_model_result['error']);
					break;
				}
			}
			// save
			$activation_result = $feature_model->collection()->merge([
				'tm_feature_module_id' => $module_id,
				'tm_feature_module_code' => $module_code,
				'tm_feature_feature_code' => $feature_code,
				'tm_feature_inactive' => 0
			]);
			if (!$activation_result['success']) {
				$result['error'] = array_merge($result['error'], $activation_result['error']);
				break;
			}
success:
			// commit if we got here
			$model->db_object->commit();
			$result['success'] = true;
		} while(0);
finish:
		return $result;
	}
}