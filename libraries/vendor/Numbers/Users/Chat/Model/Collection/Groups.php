<?php

namespace Numbers\Users\Chat\Model\Collection;
class Groups extends \Object\Collection {
	public $data = [
		'name' => 'Groups',
		'model' => '\Numbers\Users\Chat\Model\Groups',
		'details' => [
			'\Numbers\Users\Chat\Model\Group\Users' => [
				'name' => 'Group Users',
				'pk' => ['ct_grpuser_tenant_id', 'ct_grpuser_group_id', 'ct_grpuser_user_id'],
				'type' => '1M',
				'map' => ['ct_group_tenant_id' => 'ct_grpuser_tenant_id', 'ct_group_id' => 'ct_grpuser_group_id']
			]
		]
	];
}