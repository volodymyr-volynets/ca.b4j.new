<?php

namespace Numbers\Users\Users\Model\Scheduling;
class Intervals extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Intervals';
	public $name = 'um_scheduling_intervals';
	public $pk = ['um_schedinterval_tenant_id', 'um_schedinterval_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_schedinterval_';
	public $columns = [
		'um_schedinterval_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_schedinterval_id' => ['name' => 'Interval #', 'domain' => 'interval_id_sequence'],
		'um_schedinterval_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'um_schedinterval_hash_name' => ['name' => 'Hash Name', 'domain' => 'code', 'null' => true],
		'um_schedinterval_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Interval\Types'],
		'um_schedinterval_appointment_type_id' => ['name' => 'Appointment Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Appointment\Types'],
		'um_schedinterval_status_id' => ['name' => 'Status', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Scheduling\Interval\Statuses'],
		'um_schedinterval_shift_id' => ['name' => 'Shift #', 'domain' => 'shift_id', 'null' => true],
		'um_schedinterval_work_starts' => ['name' => 'Work Starts', 'type' => 'datetime'],
		'um_schedinterval_work_ends' => ['name' => 'Work Ends', 'type' => 'datetime'],
		'um_schedinterval_lunch_starts' => ['name' => 'Lunch Starts', 'type' => 'datetime', 'null' => true],
		'um_schedinterval_lunch_ends' => ['name' => 'Lunch Ends', 'type' => 'datetime', 'null' => true],
		'um_schedinterval_user_id' => ['name' => 'User #', 'domain' => 'user_id', 'null' => true],
		'um_schedinterval_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'null' => true],
		'um_schedinterval_service_id' => ['name' => 'Service #', 'domain' => 'service_id', 'null' => true],
		'um_schedinterval_location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'null' => true],
		'um_schedinterval_country_code' => ['name' => 'Country Code', 'domain' => 'country_code', 'null' => true],
		'um_schedinterval_province_code' => ['name' => 'Province Code', 'domain' => 'province_code', 'null' => true],
		'um_schedinterval_timezone_code' => ['name' => 'Timezone Code', 'domain' => 'timezone_code'],
		'um_schedinterval_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
		'um_schedinterval_location_name' => ['name' => 'Location Name', 'domain' => 'name', 'null' => true],
		// linked columns
		'um_schedinterval_linked_type_code' => ['name' => 'Linked Type', 'domain' => 'group_code', 'null' => true, 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Linked\Types'],
		'um_schedinterval_linked_module_id' => ['name' => 'Linked Module #', 'domain' => 'module_id', 'null' => true],
		'um_schedinterval_linked_id' => ['name' => 'Linked #', 'domain' => 'big_id', 'null' => true], // we do not have fk for this field
		// other
		'um_schedinterval_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_scheduling_intervals_pk' => ['type' => 'pk', 'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_id']],
		'um_schedinterval_shift_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_shift_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Scheduling\Shifts',
			'foreign_columns' => ['um_schedshift_tenant_id', 'um_schedshift_id']
		],
		'um_schedinterval_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_schedinterval_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'um_schedinterval_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_location_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Locations',
			'foreign_columns' => ['on_location_tenant_id', 'on_location_id']
		],
		'um_schedinterval_service_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_service_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Services',
			'foreign_columns' => ['on_service_tenant_id', 'on_service_id']
		],
		'um_schedinterval_province_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_country_code', 'um_schedinterval_province_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Provinces',
			'foreign_columns' => ['cm_province_tenant_id', 'cm_province_country_code', 'cm_province_province_code']
		],
		'um_schedinterval_linked_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_schedinterval_tenant_id', 'um_schedinterval_linked_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
		],
	];
	public $indexes = [
		'um_scheduling_intervals_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_schedinterval_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_schedinterval_tenant_id' => 'wg_audit_tenant_id',
			'um_schedinterval_id' => 'wg_audit_interval_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $addresses = [
		'map' => [
			'um_schedinterval_tenant_id' => 'wg_address_tenant_id',
			'um_schedinterval_id' => 'wg_address_interval_id'
		]
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}