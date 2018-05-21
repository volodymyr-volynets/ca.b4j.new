<?php

namespace Numbers\Users\Organizations\Data;
class Import extends \Object\Import {
	public $data = [
		'modules' => [
			'options' => [
				'pk' => ['sm_module_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Modules',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_module_code' => 'ON',
					'sm_module_type' => 20,
					'sm_module_name' => 'O/N Organization Management',
					'sm_module_abbreviation' => 'O/N',
					'sm_module_icon' => 'fas fa-home',
					'sm_module_transactions' => 0,
					'sm_module_multiple' => 0,
					'sm_module_activation_model' => null,
					'sm_module_custom_activation' => false,
					'sm_module_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				]
			]
		],
		'features' => [
			'options' => [
				'pk' => ['sm_feature_code'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Module\Features',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_feature_module_code' => 'ON',
					'sm_feature_code' => 'ON::ORGANIZATIONS',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'O/N Organizations',
					'sm_feature_icon' => 'fas fa-home',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 1,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				],
				[
					'sm_feature_module_code' => 'ON',
					'sm_feature_code' => 'ON::LOCATIONS',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'O/N Locations',
					'sm_feature_icon' => 'fas fa-coffee',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				],
				[
					'sm_feature_module_code' => 'ON',
					'sm_feature_code' => 'ON::TERRITORIES',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'O/N Territories',
					'sm_feature_icon' => 'fas fa-home',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				],
				[
					'sm_feature_module_code' => 'ON',
					'sm_feature_code' => 'ON::SERVICES',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'O/N Services',
					'sm_feature_icon' => 'fab fa-servicestack',
					'sm_feature_activation_model' => '\Numbers\Users\Organizations\Data\Features\Service\Supplementary',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				],
				[
					'sm_feature_module_code' => 'ON',
					'sm_feature_code' => 'ON::WORKFLOW_SUPPLEMENTARY',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'O/N Workflow Supplementary',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Users\Organizations\Data\Features\Workflow\Supplementary',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'ON',
							'sm_mdldep_child_feature_code' => 'ON::SERVICES'
						]
					]
				],
			]
		],
		'tasks' => [
			'options' => [
				'pk' => ['ts_task_code'],
				'model' => '\Numbers\Users\TaskScheduler\Model\Collection\Tasks',
				'method' => 'save'
			],
			'data' => [
				[
					'ts_task_code' => 'ON_TASK_WORKFLOW_ALARMS',
					'ts_task_name' => 'O/N Task Workflow Alarms',
					'ts_task_model' => '\Numbers\Users\Organizations\Task\Workflow\Alarms',
					'ts_task_inactive' => 0,
					'\Numbers\Users\TaskScheduler\Model\TaskParameters' => []
				]
			]
		],
	];
}