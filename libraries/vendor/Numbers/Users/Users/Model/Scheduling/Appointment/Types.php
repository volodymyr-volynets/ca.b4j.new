<?php

namespace Numbers\Users\Users\Model\Scheduling\Appointment;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Appointment Types';
	public $name = 'um_scheduling_appointment_types';
	public $pk = ['um_schedapptype_tenant_id', 'um_schedapptype_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_schedapptype_';
	public $columns = [
		'um_schedapptype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_schedapptype_id' => ['name' => 'Type #', 'domain' => 'type_id_sequence'],
		'um_schedapptype_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'um_schedapptype_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_schedapptype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_scheduling_appointment_types_pk' => ['type' => 'pk', 'columns' => ['um_schedapptype_tenant_id', 'um_schedapptype_id']],
		'um_schedapptype_code_un' => ['type' => 'unique', 'columns' => ['um_schedapptype_tenant_id', 'um_schedapptype_code']]
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'um_schedapptype_tenant_id' => 'wg_audit_tenant_id',
			'um_schedapptype_id' => 'wg_audit_appointment_type_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}