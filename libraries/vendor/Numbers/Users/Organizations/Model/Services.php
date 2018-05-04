<?php

namespace Numbers\Users\Organizations\Model;
class Services extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Services';
	public $schema;
	public $name = 'on_services';
	public $pk = ['on_service_tenant_id', 'on_service_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_service_';
	public $columns = [
		'on_service_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_service_id' => ['name' => 'Service #', 'domain' => 'service_id_sequence'],
		'on_service_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_service_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_service_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_service_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_service_assignment_type_id' => ['name' => 'Assignment Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Assignment\Types'],
		'on_service_type_id' => ['name' => 'Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Types'],
		'on_service_category_id' => ['name' => 'Category #', 'domain' => 'category_id'],
		'on_service_queue_type_id' => ['name' => 'Queue Type #', 'domain' => 'type_id'],
		'on_service_workflow_id' => ['name' => 'Workflow #', 'domain' => 'workflow_id', 'null' => true],
		'on_service_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id', 'null' => true],
		'on_service_appointments' => ['name' => 'Appointments', 'type' => 'boolean'],
		'on_service_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_services_pk' => ['type' => 'pk', 'columns' => ['on_service_tenant_id', 'on_service_id']],
		'on_service_code_un' => ['type' => 'unique', 'columns' => ['on_service_tenant_id', 'on_service_code']],
		'on_service_assignment_type_id_un' => ['type' => 'unique', 'columns' => ['on_service_tenant_id', 'on_service_id', 'on_service_assignment_type_id']],
		'on_service_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_service_tenant_id', 'on_service_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'on_service_category_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_service_tenant_id', 'on_service_category_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Categories',
			'foreign_columns' => ['on_servcategory_tenant_id', 'on_servcategory_id']
		],
		'on_service_queue_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_service_tenant_id', 'on_service_queue_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\Types',
			'foreign_columns' => ['on_quetype_tenant_id', 'on_quetype_id']
		],
		'on_service_workflow_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_service_tenant_id', 'on_service_workflow_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
			'foreign_columns' => ['on_workflow_tenant_id', 'on_workflow_id']
		]
	];
	public $indexes = [
		'on_services_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_service_code', 'on_service_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_service_tenant_id' => 'wg_audit_tenant_id',
			'on_service_id' => 'wg_audit_service_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_service_name' => 'name',
		'on_service_icon' => 'icon_class',
	];
	public $options_active = [
		'on_service_inactive' => 0
	];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'on_service_id',
	];

	public $who = [
		'inserted' => true,
		'updated' => true
	];

	public $attributes = [
		'map' => [
			'on_service_tenant_id' => 'wg_attribute_tenant_id',
			'on_service_id' => 'wg_attribute_service_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}