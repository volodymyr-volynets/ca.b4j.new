<?php

namespace Numbers\Internalization\Internalization\Data;
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
					'sm_module_code' => 'IN',
					'sm_module_type' => 20,
					'sm_module_name' => 'I/N Internalization',
					'sm_module_abbreviation' => 'I/N',
					'sm_module_icon' => 'fas fa-adjust',
					'sm_module_transactions' => 0,
					'sm_module_multiple' => 0,
					'sm_module_activation_model' => '\Numbers\Internalization\Internalization\Data\Activation\Internalization',
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
					'sm_feature_module_code' => 'IN',
					'sm_feature_code' => 'IN::INTERNALIZATION',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'I/N Internalization',
					'sm_feature_icon' => 'far fa-compass',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 1,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'ON',
							'sm_mdldep_child_feature_code' => 'ON::ORGANIZATIONS'
						]
					]
				]
			]
		]
	];
}