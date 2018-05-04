<?php

namespace Numbers\Users\News\Model\News;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'NS';
	public $title = 'N/S News Roles';
	public $name = 'ns_news_roles';
	public $pk = ['ns_nwsrol_tenant_id', 'ns_nwsrol_news_id', 'ns_nwsrol_role_id'];
	public $tenant = true;
	public $orderby = [
		'ns_nwsrol_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ns_nwsrol_';
	public $columns = [
		'ns_nwsrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ns_nwsrol_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'ns_nwsrol_news_id' => ['name' => 'News #', 'domain' => 'group_id'],
		'ns_nwsrol_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'ns_nwsrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ns_news_roles_pk' => ['type' => 'pk', 'columns' => ['ns_nwsrol_tenant_id', 'ns_nwsrol_news_id', 'ns_nwsrol_role_id']],
		'ns_nwsrol_news_id_fk' => [
			'type' => 'fk',
			'columns' => ['ns_nwsrol_tenant_id', 'ns_nwsrol_news_id'],
			'foreign_model' => '\Numbers\Users\News\Model\News',
			'foreign_columns' => ['ns_new_tenant_id', 'ns_new_id']
		],
		'ns_nwsrol_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['ns_nwsrol_tenant_id', 'ns_nwsrol_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
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

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}