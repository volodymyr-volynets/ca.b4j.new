<?php

namespace Numbers\Users\News\Data;
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
					'sm_module_code' => 'NS',
					'sm_module_type' => 20,
					'sm_module_name' => 'N/S News Management',
					'sm_module_abbreviation' => 'N/S',
					'sm_module_icon' => 'far fa-newspaper',
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
					'sm_feature_module_code' => 'NS',
					'sm_feature_code' => 'NS::NEWS',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'N/S News',
					'sm_feature_icon' => 'far fa-newspaper',
					'sm_feature_activated_by_default' => 1,
					'sm_feature_activation_model' => null,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'ON',
							'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
						],
						[
							'sm_mdldep_child_module_code' => 'UM',
							'sm_mdldep_child_feature_code' => 'UM::USERS'
						]
					]
				]
			]
		]
	];
}