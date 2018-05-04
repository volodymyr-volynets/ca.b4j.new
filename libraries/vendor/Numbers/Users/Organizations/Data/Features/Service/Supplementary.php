<?php

namespace Numbers\Users\Organizations\Data\Features\Service;
class Supplementary extends \Object\Import {
	public $data = [
		'service_channels' => [
			'options' => [
				'pk' => ['on_servchannel_tenant_id', 'on_servchannel_code'],
				'model' => '\Numbers\Users\Organizations\Model\Service\Channels',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'on_servchannel_code' => 'ADD_ORDER',
					'on_servchannel_name' => 'Add Order',
					'on_servchannel_type_id' => 20,
					'on_servchannel_icon' => 'fab fa-firstdraft',
					'on_servchannel_inactive' => 0
				],
			]
		],
		'owner_types' => [
			'options' => [
				'pk' => ['on_ownertype_tenant_id', 'on_ownertype_code'],
				'model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'on_ownertype_code' => 'SP',
					'on_ownertype_name' => 'Service Provider',
					'on_ownertype_inactive' => 0
				],
				[
					'on_ownertype_code' => 'EMP',
					'on_ownertype_name' => 'Service Provider Employee',
					'on_ownertype_inactive' => 0
				],
				[
					'on_ownertype_code' => 'CREATOR',
					'on_ownertype_name' => 'Creator',
					'on_ownertype_inactive' => 0
				]
			]
		]
	];
}