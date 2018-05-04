<?php

namespace Numbers\Users\Workflow\Model\Collection\Executed;
class Workflows extends \Object\Collection {
	public $data = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Workflow\Model\Executed\Workflows',
		'details' => [
			'\Numbers\Users\Workflow\Model\Executed\Workflow\Steps' => [
				'name' => 'Steps',
				'pk' => ['ww_execwstep_tenant_id', 'ww_execwstep_execwflow_id', 'ww_execwstep_id'],
				'type' => '1M',
				'map' => ['ww_execwflow_tenant_id' => 'ww_execwstep_tenant_id', 'ww_execwflow_id' => 'ww_execwstep_execwflow_id'],
			]
		]
	];
}