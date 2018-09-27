<?php

namespace Numbers\Users\Users\Data;
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
					'sm_abacattr_id' => '::id::um_user_id',
					'sm_abacattr_code' => 'um_user_id',
					'sm_abacattr_name' => 'User #',
					'sm_abacattr_module_code' => 'UM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Users\Users\Model\Users',
					'sm_abacattr_domain' => '::from::columns::um_user_id::domain',
					'sm_abacattr_type' => '::from::columns::um_user_id::type',
					'sm_abacattr_is_numeric_key' => 'from::columns::um_user_id::is_numeric_key',
					'sm_abacattr_inactive' => 0
				],
				[
					'sm_abacattr_id' => '::id::um_role_id',
					'sm_abacattr_code' => 'um_role_id',
					'sm_abacattr_name' => 'Role #',
					'sm_abacattr_module_code' => 'UM',
					'sm_abacattr_parent_abacattr_id' => null,
					'sm_abacattr_flag_abac' => 1,
					'sm_abacattr_flag_assingment' => 1,
					'sm_abacattr_flag_attribute' => 1,
					'sm_abacattr_model_id' => '::primary_model::\Numbers\Users\Users\Model\Roles',
					'sm_abacattr_domain' => '::from::columns::um_role_id::domain',
					'sm_abacattr_type' => '::from::columns::um_role_id::type',
					'sm_abacattr_is_numeric_key' => 'from::columns::um_role_id::is_numeric_key',
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
					'sm_abacservice_id' => '::id::UM::USERS',
					'sm_abacservice_code' => 'UM::USERS',
					'sm_abacservice_name' => 'U/M Users',
					'sm_abacservice_module_code' => 'UM',
					'sm_abacservice_parent_abacservice_id' => null,
					'sm_abacservice_feature' => 1,
					'sm_abacservice_inactive' => 0,
					'\Numbers\Backend\ABAC\Model\Service\Actions' => []
				],
				[
					'sm_abacservice_id' => '::id::UM::RBAC',
					'sm_abacservice_code' => 'UM::RBAC',
					'sm_abacservice_name' => 'U/M RBAC',
					'sm_abacservice_module_code' => 'UM',
					'sm_abacservice_parent_abacservice_id' => null,
					'sm_abacservice_feature' => 1,
					'sm_abacservice_inactive' => 0,
					'\Numbers\Backend\ABAC\Model\Service\Actions' => []
				],
				[
					'sm_abacservice_id' => '::id::ON::ORGANIZATION_ASSIGNMENT_USERS',
					'sm_abacservice_code' => 'ON::ORGANIZATION_ASSIGNMENT_USERS',
					'sm_abacservice_name' => 'O/N Organization Assignment Users',
					'sm_abacservice_module_code' => 'UM',
					'sm_abacservice_parent_abacservice_id' => '::id::ON::ORGANIZATION_ASSIGNMENTS',
					'sm_abacservice_feature' => 0,
					'sm_abacservice_inactive' => 0,
					'\Numbers\Backend\ABAC\Model\Service\Actions' => [
						[
							'sm_abacservact_action_id' => '::id::All_Actions',
							'sm_abacservact_inactive' => 0,
						],
						[
							'sm_abacservact_action_id' => '::id::Record_View',
							'sm_abacservact_inactive' => 0,
						],
						[
							'sm_abacservact_action_id' => '::id::Record_New',
							'sm_abacservact_inactive' => 0,
						],
						[
							'sm_abacservact_action_id' => '::id::Record_Edit',
							'sm_abacservact_inactive' => 0,
						],
						[
							'sm_abacservact_action_id' => '::id::Record_Inactivate',
							'sm_abacservact_inactive' => 0,
						],
						[
							'sm_abacservact_action_id' => '::id::Record_Delete',
							'sm_abacservact_inactive' => 0,
						]
					]
				],
			]
		]
	];
}