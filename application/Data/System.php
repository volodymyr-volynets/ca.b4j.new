<?php

namespace Data;
class System extends \Object\Import {
	public $data = [
		'controllers' => [
			'options' => [
				'pk' => ['sm_resource_id'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Resources',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_resource_id' => '::id::\Controller\B4J\Periods',
					'sm_resource_code' => '\Controller\B4J\Periods',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Settings',
					'sm_resource_name' => 'B/J Periods',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-calendar',
					'sm_resource_module_code' => 'B4',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'Registrations',
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => null,
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Resource\Features' => [
						[
							'sm_rsrcftr_feature_code' => 'B4::B4J',
							'sm_rsrcftr_inactive' => 0
						]
					],
					'\Numbers\Backend\System\Modules\Model\Resource\Map' => [
						[
							'sm_rsrcmp_method_code' => 'AllActions',
							'sm_rsrcmp_action_id' => '::id::All_Actions',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Index',
							'sm_rsrcmp_action_id' => '::id::List_View',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Index',
							'sm_rsrcmp_action_id' => '::id::List_Export',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Edit',
							'sm_rsrcmp_action_id' => '::id::Record_View',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Edit',
							'sm_rsrcmp_action_id' => '::id::Record_New',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Edit',
							'sm_rsrcmp_action_id' => '::id::Record_Edit',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Edit',
							'sm_rsrcmp_action_id' => '::id::Record_Inactivate',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Edit',
							'sm_rsrcmp_action_id' => '::id::Record_Delete',
							'sm_rsrcmp_inactive' => 0
						],
						[
							'sm_rsrcmp_method_code' => 'Import',
							'sm_rsrcmp_action_id' => '::id::Import_Records',
							'sm_rsrcmp_inactive' => 0
						]
					]
				],
				[
					'sm_resource_id' => '::id::\Controller\B4J\Register',
					'sm_resource_code' => '\Controller\B4J\Register',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Miscellaneous',
					'sm_resource_name' => 'Register',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-registered',
					'sm_resource_module_code' => 'B4',
					'sm_resource_group1_name' => 'Account',
					'sm_resource_group2_name' => null,
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 1,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => null,
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Resource\Features' => [],
					'\Numbers\Backend\System\Modules\Model\Resource\Map' => []
				]
			]
		],
		'menu' => [
			'options' => [
				'pk' => ['sm_resource_id'],
				'model' => '\Numbers\Backend\System\Modules\Model\Collection\Resources',
				'method' => 'save'
			],
			'data' => [
				[
					'sm_resource_id' => '::id::\Menu\Operations\Registrations',
					'sm_resource_code' => '\Menu\Operations\Registrations',
					'sm_resource_type' => 299,
					'sm_resource_name' => 'Registrations',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-user-circle',
					'sm_resource_module_code' => 'B4',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => null,
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => null,
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Controller\B4J\Periods',
					'sm_resource_code' => '\Menu\Controller\B4J\Periods',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Periods',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-calendar',
					'sm_resource_module_code' => 'B4',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'Registrations',
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Controller\B4J\Periods',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/B4J/Periods',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Controller\B4J\Register',
					'sm_resource_code' => '\Menu\Controller\B4J\Register',
					'sm_resource_type' => 210,
					'sm_resource_name' => 'Register',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-registered',
					'sm_resource_module_code' => 'B4',
					'sm_resource_group1_name' => 'Account',
					'sm_resource_group2_name' => null,
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 1,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => '::id::\Controller\B4J\Register',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => '/B4J/Register',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_menu_order' => 10100,
					'sm_resource_inactive' => 0
				],
			]
		]
	];
}