<?php

namespace Numbers\Tenants\Tenants\Override\ACL;
class Resources {
	public $data = [
		'application_structure' => [
			'tenant' => [
				'tenant_datasource' => '\Numbers\Tenants\Tenants\DataSource\Tenants',
				'column_prefix' => 'tm_tenant_'
			]
		],
		'modules' => [
			'primary' => [
				'datasource' => '\Numbers\Tenants\Tenants\DataSource\Module\AllModules',
			]
		]
	];
}