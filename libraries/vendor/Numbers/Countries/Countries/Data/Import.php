<?php

namespace Numbers\Countries\Countries\Data;
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
					'sm_module_code' => 'CM',
					'sm_module_type' => 20,
					'sm_module_name' => 'C/M Country Management',
					'sm_module_abbreviation' => 'C/M',
					'sm_module_icon' => 'fas fa-globe',
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
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::COUNTRIES',
					'sm_feature_type' => 10,
					'sm_feature_name' => 'C/M Countries',
					'sm_feature_icon' => 'fas fa-globe',
					'sm_feature_activation_model' => null,
					'sm_feature_activated_by_default' => 1,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => []
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_ALL_COUNTRIES',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M All Available Countries, Regions and Provinces',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\Countries\All',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						]
					]
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_CA_ONLY',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M Canadian Countries, Regions and Provinces',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\Countries\Canada',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						]
					]
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_US_ONLY',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M U.S. Countries, Regions and Provinces',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\Countries\US',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						]
					]
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_US_POSTAL',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M U.S. Zip Codes',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\PostalCodes\US',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						],
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::DATA_US_ONLY'
						]
					]
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_CA_POSTAL',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M Canadian Postal Codes',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\PostalCodes\Canada',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						],
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::DATA_CA_ONLY'
						]
					]
				],
				[
					'sm_feature_module_code' => 'CM',
					'sm_feature_code' => 'CM::DATA_ADDRESS_TYPES',
					'sm_feature_type' => 30,
					'sm_feature_name' => 'C/M Common Address Types',
					'sm_feature_icon' => 'fas fa-database',
					'sm_feature_activation_model' => '\Numbers\Countries\Countries\Data\Features\AddressTypes\AddressTypes',
					'sm_feature_activated_by_default' => 0,
					'sm_feature_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Module\Dependencies' => [
						[
							'sm_mdldep_child_module_code' => 'CM',
							'sm_mdldep_child_feature_code' => 'CM::COUNTRIES'
						]
					]
				]
			]
		]
	];
}