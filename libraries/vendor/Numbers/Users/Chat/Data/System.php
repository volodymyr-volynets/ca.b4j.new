<?php

namespace Numbers\Users\Chat\Data;
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
					'sm_resource_id' => '::id::\Numbers\Users\Chat\Controller\Chat',
					'sm_resource_code' => '\Numbers\Users\Chat\Controller\Chat',
					'sm_resource_type' => 100,
					'sm_resource_classification' => 'Global',
					'sm_resource_name' => 'Chat',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-comments',
					'sm_resource_module_code' => 'CT',
					'sm_resource_group1_name' => 'Account',
					'sm_resource_group2_name' => null,
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => null,
					'sm_resource_menu_options_generator' => null,
					'sm_resource_inactive' => 0,
					'\Numbers\Backend\System\Modules\Model\Resource\Features' => [
						[
							'sm_rsrcftr_feature_code' => 'CT::CHAT',
							'sm_rsrcftr_inactive' => 0
						]
					],
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
					'sm_resource_id' => '::id::\Menu\Numbers\Users\Chat\Controller\Chat',
					'sm_resource_code' => '\Menu\Numbers\Users\Chat\Controller\Chat',
					'sm_resource_type' => 210,
					'sm_resource_name' => 'Chat',
					'sm_resource_description' => null,
					'sm_resource_icon' => 'far fa-comments',
					'sm_resource_module_code' => 'CT',
					'sm_resource_group1_name' => 'Account',
					'sm_resource_group2_name' => null,
					'sm_resource_group3_name' => null,
					'sm_resource_group4_name' => null,
					'sm_resource_group5_name' => null,
					'sm_resource_group6_name' => null,
					'sm_resource_group7_name' => null,
					'sm_resource_group8_name' => null,
					'sm_resource_group9_name' => null,
					'sm_resource_acl_public' => 0,
					'sm_resource_acl_authorized' => 1,
					'sm_resource_acl_permission' => 0,
					'sm_resource_menu_acl_resource_id' => null,
					'sm_resource_menu_acl_method_code' => null,
					'sm_resource_menu_acl_action_id' => null,
					'sm_resource_menu_url' => '/Numbers/Users/Chat/Controller/Chat',
					'sm_resource_menu_options_generator' => null,
					'sm_resource_menu_name_generator' => '/Numbers/Users/Chat/Controller/Chat/_JsonMenuName',
					'sm_resource_menu_order' => 32000,
					'sm_resource_inactive' => 0
				],
			]
		]
	];
}