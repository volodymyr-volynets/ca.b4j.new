<?php

namespace Numbers\Users\Users\Data\Activation;
class Tenant extends \Object\Import {
	public $data = [
		'roles' => [
			'options' => [
				'pk' => ['um_role_code'],
				'model' => '\Numbers\Users\Users\Model\Roles',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'um_role_code' => 'SA',
					'um_role_type_id' => 20,
					'um_role_name' => 'Super Administrator',
					'um_role_global' => 0,
					'um_role_super_admin' => 1,
					'um_role_icon' => 'fas fa-user-secret',
					'um_role_weight' => 1000000,
					'um_role_inactive' => 0
				],
				[
					'um_role_code' => 'CUSTOMER',
					'um_role_type_id' => 20,
					'um_role_name' => 'Customer',
					'um_role_global' => 1,
					'um_role_super_admin' => 0,
					'um_role_icon' => 'fas fa-female',
					'um_role_weight' => 1000,
					'um_role_inactive' => 0
				],
				[
					'um_role_code' => 'VENDOR',
					'um_role_type_id' => 20,
					'um_role_name' => 'Vendor',
					'um_role_global' => 1,
					'um_role_super_admin' => 0,
					'um_role_icon' => 'fas fa-male',
					'um_role_weight' => 1000,
					'um_role_inactive' => 0
				]
			]
		],
		'titles' => [
			'options' => [
				'pk' => ['um_usrtitle_name'],
				'model' => '\Numbers\Users\Users\Model\User\Titles',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'um_usrtitle_name' => 'Mr.',
					'um_usrtitle_order' => 1000,
					'um_usrtitle_inactive' => 0
				],
				[
					'um_usrtitle_name' => 'Ms.',
					'um_usrtitle_order' => 1100,
					'um_usrtitle_inactive' => 0
				],
				[
					'um_usrtitle_name' => 'Mrs.',
					'um_usrtitle_order' => 1200,
					'um_usrtitle_inactive' => 0
				],
				[
					'um_usrtitle_name' => 'Miss',
					'um_usrtitle_order' => 1300,
					'um_usrtitle_inactive' => 0
				],
				[
					'um_usrtitle_name' => 'Dr.',
					'um_usrtitle_order' => 1500,
					'um_usrtitle_inactive' => 0
				]
			]
		],
		'organization_types' => [
			'options' => [
				'pk' => ['on_orgtype_code'],
				'model' => '\Numbers\Users\Organizations\Model\Organization\Types',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'on_orgtype_code' => 'FORPROFIT',
					'on_orgtype_name' => 'For-Profit',
					'on_orgtype_parent_type_code' => null,
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'NONPROFIT',
					'on_orgtype_name' => 'Nonprofit',
					'on_orgtype_parent_type_code' => null,
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'SOLEPROP',
					'on_orgtype_name' => 'Sole Proprietorship',
					'on_orgtype_parent_type_code' => 'FORPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'PARTNERSHIP',
					'on_orgtype_name' => 'Partnership',
					'on_orgtype_parent_type_code' => 'FORPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'CORPORATION',
					'on_orgtype_name' => 'Corporation',
					'on_orgtype_parent_type_code' => 'FORPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'PUBCHARITY',
					'on_orgtype_name' => 'Public Charity',
					'on_orgtype_parent_type_code' => 'NONPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'FOUNDATION',
					'on_orgtype_name' => 'Foundation',
					'on_orgtype_parent_type_code' => 'NONPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'SOCIALADVOCACY',
					'on_orgtype_name' => 'Social Advocacy',
					'on_orgtype_parent_type_code' => 'NONPROFIT',
					'on_orgtype_inactive' => 0
				],
				[
					'on_orgtype_code' => 'PROFANDTRADE',
					'on_orgtype_name' => 'Professional and Trade',
					'on_orgtype_parent_type_code' => 'NONPROFIT',
					'on_orgtype_inactive' => 0
				]
			]
		],
		'team_roles' => [
			'options' => [
				'pk' => ['um_usrtmrol_name'],
				'model' => '\Numbers\Users\Users\Model\User\Team\Roles',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'um_usrtmrol_name' => 'Project Sponsor',
					'um_usrtmrol_icon' => 'fas fa-user-secret',
					'um_usrtmrol_inactive' => 0
				],
				[
					'um_usrtmrol_name' => 'Project Manager',
					'um_usrtmrol_icon' => 'fas fa-user-plus',
					'um_usrtmrol_inactive' => 0
				],
				[
					'um_usrtmrol_name' => 'Team Member',
					'um_usrtmrol_icon' => 'fas fa-male',
					'um_usrtmrol_inactive' => 0
				],
				[
					'um_usrtmrol_name' => 'Scrum Master',
					'um_usrtmrol_icon' => 'far fa-user',
					'um_usrtmrol_inactive' => 0
				],
				[
					'um_usrtmrol_name' => 'Product Owner',
					'um_usrtmrol_icon' => 'fas fa-user-plus',
					'um_usrtmrol_inactive' => 0
				],
			]
		],
	];
}