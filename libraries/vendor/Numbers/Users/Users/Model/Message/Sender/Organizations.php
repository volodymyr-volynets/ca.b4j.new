<?php

namespace Numbers\Users\Users\Model\Message\Sender;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Message Sender Organizations';
	public $name = 'um_message_sender_organizations';
	public $pk = ['um_senderorg_tenant_id', 'um_senderorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'um_senderorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_senderorg_';
	public $columns = [
		'um_senderorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_senderorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_senderorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_senderorg_from_email' => ['name' => 'From Email', 'domain' => 'email'],
		'um_senderorg_from_name' => ['name' => 'From Name', 'domain' => 'name'],
		'um_senderorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_message_sender_organizations_pk' => ['type' => 'pk', 'columns' => ['um_senderorg_tenant_id', 'um_senderorg_organization_id']],
		'um_senderorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_senderorg_tenant_id', 'um_senderorg_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
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