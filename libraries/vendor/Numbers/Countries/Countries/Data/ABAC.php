<?php

namespace Numbers\Countries\Countries\Data;
class ABAC extends \Object\Import {
	public $data = [
		'abac_attributes' => [
			'options' => [
				'pk' => ['sm_abacattr_id'],
				'model' => '\Numbers\Backend\ABAC\Model\Attributes',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_abacattr_id' => '::id::cm_country_code',
					'sm_abacattr_code' => 'cm_country_code',
					'sm_abacattr_name' => 'Country Code',
					'sm_abacattr_module_code' => 'CM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_tenant' => 1,
					'sm_abacattr_module' => 0,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Countries\Countries\Model\Countries',
					'sm_abacattr_domain' => '::from::columns::cm_country_code::domain',
					'sm_abacattr_type' => '::from::columns::cm_country_code::type',
					'sm_abacattr_is_numeric_key' => '::from::columns::cm_country_code::is_numeric_key',
					'sm_abacattr_inactive' => 0
				],
				[
					'sm_abacattr_id' => '::id::cm_country_code3',
					'sm_abacattr_code' => 'cm_country_code3',
					'sm_abacattr_name' => 'Country Code (3)',
					'sm_abacattr_module_code' => 'CM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_tenant' => 1,
					'sm_abacattr_module' => 0,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Countries\Countries\Model\Countries',
					'sm_abacattr_domain' => '::from::columns::cm_country_code3::domain',
					'sm_abacattr_type' => '::from::columns::cm_country_code3::type',
					'sm_abacattr_is_numeric_key' => '::from::columns::cm_country_code3::is_numeric_key',
					'sm_abacattr_inactive' => 0
				],
				[
					'sm_abacattr_id' => '::id::cm_region_id',
					'sm_abacattr_code' => 'cm_region_id',
					'sm_abacattr_name' => 'Country Region #',
					'sm_abacattr_module_code' => 'CM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_tenant' => 1,
					'sm_abacattr_module' => 0,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Countries\Countries\Model\Regions',
					'sm_abacattr_domain' => '::from::columns::cm_region_id::domain',
					'sm_abacattr_type' => '::from::columns::cm_region_id::type',
					'sm_abacattr_is_numeric_key' => '::from::columns::cm_region_id::is_numeric_key',
					'sm_abacattr_inactive' => 0
				],
				[
					'sm_abacattr_id' => '::id::cm_province_province_code',
					'sm_abacattr_code' => 'cm_province_province_code',
					'sm_abacattr_name' => 'Country Province Code',
					'sm_abacattr_module_code' => 'CM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_tenant' => 1,
					'sm_abacattr_module' => 0,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Countries\Countries\Model\Provinces',
					'sm_abacattr_domain' => '::from::columns::cm_province_province_code::domain',
					'sm_abacattr_type' => '::from::columns::cm_province_province_code::type',
					'sm_abacattr_is_numeric_key' => '::from::columns::cm_province_province_code::is_numeric_key',
					'sm_abacattr_inactive' => 0
				]
			]
		],
		'abac_services' => [
			'options' => [
				'pk' => ['sm_abacservice_id'],
				'model' => '\Numbers\Backend\ABAC\Model\Collection\Services',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_abacservice_id' => '::id::ON::ORGANIZATIONS',
					'sm_abacservice_code' => 'ON::ORGANIZATIONS',
					'sm_abacservice_name' => 'O/N Organizations',
					'sm_abacservice_module_code' => 'ON',
					'sm_abacservice_parent_abacservice_id' => null,
					'sm_abacservice_feature' => 1,
					'sm_abacservice_inactive' => 0,
					'\Numbers\Backend\ABAC\Model\Service\Actions' => []
				],
				[
					'sm_abacservice_id' => '::id::ON::ORGANIZATION_ASSIGNMENTS',
					'sm_abacservice_code' => 'ON::ORGANIZATION_ASSIGNMENTS',
					'sm_abacservice_name' => 'O/N Organization Assignments',
					'sm_abacservice_module_code' => 'ON',
					'sm_abacservice_parent_abacservice_id' => '::id::ON::ORGANIZATIONS',
					'sm_abacservice_feature' => 0,
					'sm_abacservice_inactive' => 0,
					'\Numbers\Backend\ABAC\Model\Service\Actions' => []
				],
			]
		]
	];
}