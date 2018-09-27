<?php

namespace Numbers\Users\Monitoring\Model\Collection;
class Usages extends \Object\Collection {
	public $data = [
		'name' => 'Usages',
		'model' => '\Numbers\Users\Monitoring\Model\Usages',
		'details' => [
			'\Numbers\Users\Monitoring\Model\Usage\Actions' => [
				'name' => 'Usage Actions',
				'pk' => ['sm_monusgact_tenant_id', 'sm_monusgact_usage_id', 'sm_monusgact_usage_code'],
				'type' => '1M',
				'map' => ['sm_monusage_tenant_id' => 'sm_monusgact_tenant_id', 'sm_monusage_id' => 'sm_monusgact_usage_id']
			]
		]
	];
}