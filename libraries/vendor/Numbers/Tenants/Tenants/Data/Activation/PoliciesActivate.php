<?php

namespace Numbers\Tenants\Tenants\Data\Activation;
class PoliciesActivate extends \Object\Import {
	public $data = [
		'policy_roots' => [
			'options' => [
				'pk' => ['tm_polroot_code'],
				'model' => '\Numbers\Tenants\Tenants\Model\Policy\Roots',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'tm_polroot_tenant_id' => null,
					'tm_polroot_code' => 'SYSTEM',
					'tm_polroot_name' => 'System Policies',
					'tm_polroot_inactive' => 0
				],
				[
					'tm_polroot_tenant_id' => null,
					'tm_polroot_code' => 'USER',
					'tm_polroot_name' => 'User Defined Policies',
					'tm_polroot_inactive' => 0
				],
			]
		],
	];
}