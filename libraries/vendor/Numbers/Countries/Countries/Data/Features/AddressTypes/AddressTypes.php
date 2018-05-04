<?php

namespace Numbers\Countries\Countries\Data\Features\AddressTypes;
class AddressTypes extends \Object\Import {
	public $data = [
		'address_types' => [
			'options' => [
				'pk' => ['cm_addrtype_code'],
				'model' => '\Numbers\Countries\Countries\Model\Address\Types',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'cm_addrtype_code' => 'HOME',
					'cm_addrtype_name' => 'Home Address',
					'cm_addrtype_global' => 1,
					'cm_addrtype_inactive' => 0
				],
				[
					'cm_addrtype_code' => 'BUSINESS',
					'cm_addrtype_name' => 'Business Address',
					'cm_addrtype_global' => 1,
					'cm_addrtype_inactive' => 0
				],
				[
					'cm_addrtype_code' => 'BILLING',
					'cm_addrtype_name' => 'Billing Address',
					'cm_addrtype_global' => 1,
					'cm_addrtype_inactive' => 0
				],
				[
					'cm_addrtype_code' => 'SHIPPING',
					'cm_addrtype_name' => 'Shipping Address',
					'cm_addrtype_global' => 1,
					'cm_addrtype_inactive' => 0
				]
			]
		]
	];
}