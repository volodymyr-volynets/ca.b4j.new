<?php

namespace Numbers\Users\Organizations\Helper;
class Dashboard extends \Numbers\Users\Users\Helper\Dashboard\Builder {

	/**
	 * Data
	 *
	 * @var array
	 */
	public $data = [
		1 => [
			1 => [
				'name' => 'Organizations',
				'icon' => 'far fa-building',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Organizations',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Organizations'
			],
			2 => [
				'name' => 'Locations',
				'icon' => 'fas fa-coffee',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Locations',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Locations'
			],
			3 => [
				'name' => '&nbsp;'
			],
			4 => [
				'name' => 'Strategic Business Units',
				'icon' => 'fas fa-hospital',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\StrategicBusinessUnits',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/StrategicBusinessUnits'
			],
			5 => [
				'name' => 'Trademarks',
				'icon' => 'fas fa-trademark',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Trademarks',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Trademarks'
			],
			6 => [
				'name' => 'Organization Types',
				'icon' => 'far fa-clone',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Organization\Types',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Organization/Types'
			],
		],
		2 => [
			1 => [
				'name' => '&nbsp;'
			],
			2 => [
				'name' => '&nbsp;'
			],
			3 => [
				'name' => '&nbsp;'
			],
			4 => [
				'name' => 'Legal Authorities',
				'icon' => 'far fa-money-bill-alt',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\LegalAuthorities',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/LegalAuthorities'
			],
			5 => [
				'name' => 'Markets',
				'icon' => 'fas fa-sticky-note',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Markets',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Markets'
			],
			6 => [
				'name' => 'Regions',
				'icon' => 'fas fa-tag',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Regions',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Regions'
			],
		],
		3 => [
			1 => [
				'name' => 'Brands',
				'icon' => 'fas fa-thumbs-up',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Brands',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Brands'
			],
			2 => [
				'name' => 'Cost Centers',
				'icon' => 'fas fa-rupee-sign',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\CostCenters',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/CostCenters'
			],
			3 => [
				'name' => 'Departments',
				'icon' => 'fas fa-address-book',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Departments',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Departments'
			],
			4 => [
				'name' => 'Districts',
				'icon' => 'far fa-sticky-note',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Districts',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Districts'
			],
			5 => [
				'name' => 'Divisions',
				'icon' => 'fas fa-star-half',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Divisions',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Divisions'
			],
			6 => [
				'name' => 'Jurisdictions',
				'icon' => 'fas fa-flag',
				'acl' => [
					'resource_id' => '\Numbers\Users\Organizations\Controller\Jurisdictions',
					'method_code' => 'Index',
					'action_id' => 'List_View'
				],
				'url' => '/Numbers/Users/Organizations/Controller/Jurisdictions'
			],
		]
	];

	/**
	 * Constructor
	 */
	public function __construct() {}
}