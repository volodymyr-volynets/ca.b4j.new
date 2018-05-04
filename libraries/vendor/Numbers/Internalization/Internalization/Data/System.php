<?php

namespace Numbers\Internalization\Internalization\Data;
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Language\Codes',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Language\Codes',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Language Codes',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-flag',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Locales',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Locales',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Locales',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-compass',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Timezones',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Timezones',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Timezones',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-calendar',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Groups',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Groups',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Groups',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-object-group',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Translations',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Translations',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Translations',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-font',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
					'sm_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Missing',
					'sm_resource_code' => '\Numbers\Internalization\Internalization\Controller\Missing',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'I/N Missing Translations',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-strikethrough',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
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
							'sm_rsrcftr_feature_code' => 'IN::INTERNALIZATION',
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
						]
					]
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
					'sm_resource_id' => '::id::\Menu\Operations\System\Management\Internalization',
					'sm_resource_code' => '\Menu\Operations\System\Management\Internalization',
					'sm_resource_type' => 299,
					'sm_resource_name' => 'Internalization',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-adjust',
					'sm_resource_module_code' => 'UM',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
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
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Language\Codes',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Language\Codes',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Languages',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-flag',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Language\Codes',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Language/Codes',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Locales',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Locales',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Locales',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-compass',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Locales',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Locales',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Timezones',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Timezones',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Timezones',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-calendar',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Timezones',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Timezones',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Groups',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Groups',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Groups',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-object-group',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Groups',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Groups',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Translations',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Translations',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Translations',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-font',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Translations',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Translations',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				],
				[
					'sm_resource_id' => '::id::\Menu\Numbers\Internalization\Internalization\Controller\Missing',
					'sm_resource_code' => '\Menu\Numbers\Internalization\Internalization\Controller\Missing',
					'sm_resource_type' => 200,
					'sm_resource_name' => 'Missing Translations',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'fas fa-strikethrough',
					'sm_resource_module_code' => 'IN',
					'sm_resource_group1_name' => 'Operations',
					'sm_resource_group2_name' => 'System Management',
					'sm_resource_group3_name' => 'Internalization',
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 0,
					'sm_resource_acl_permission' => 1,
					'sm_resource_menu_acl_resource_id' => '::id::\Numbers\Internalization\Internalization\Controller\Missing',
					'sm_resource_menu_acl_method_code' => 'Index',
					'sm_resource_menu_acl_action_id' => '::id::List_View',
					'sm_resource_menu_url' => '/Numbers/Internalization/Internalization/Controller/Missing',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0
				]
			]
		]
	];
}