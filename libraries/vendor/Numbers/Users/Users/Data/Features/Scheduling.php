<?php

namespace Numbers\Users\Users\Data\Features;
class Scheduling extends \Object\Import {
	public $data = [
		'types' => [
			'options' => [
				'pk' => ['um_schedapptype_tenant_id', 'um_schedapptype_code'],
				'model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'um_schedapptype_code' => 'ESTIMATE',
					'um_schedapptype_name' => 'Estimate',
					'um_schedapptype_inactive' => 0
				],
				[
					'um_schedapptype_code' => 'WORK',
					'um_schedapptype_name' => 'Work',
					'um_schedapptype_inactive' => 0
				]
			]
		]
	];
}