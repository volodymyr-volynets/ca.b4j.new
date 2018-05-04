<?php

namespace Numbers\Users\News\Model\News;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'NS';
	public $title = 'N/S News Users';
	public $name = 'ns_news_users';
	public $pk = ['ns_nwsusr_tenant_id', 'ns_nwsusr_news_id', 'ns_nwsusr_user_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'ns_nwsusr_';
	public $columns = [
		'ns_nwsusr_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ns_nwsusr_news_id' => ['name' => 'News #', 'domain' => 'group_id'],
		'ns_nwsusr_user_id' => ['name' => 'User #', 'domain' => 'user_id']
	];
	public $constraints = [
		'ns_news_users_pk' => ['type' => 'pk', 'columns' => ['ns_nwsusr_tenant_id', 'ns_nwsusr_news_id', 'ns_nwsusr_user_id']],
		'ns_nwsusr_news_id_fk' => [
			'type' => 'fk',
			'columns' => ['ns_nwsusr_tenant_id', 'ns_nwsusr_news_id'],
			'foreign_model' => '\Numbers\Users\News\Model\News',
			'foreign_columns' => ['ns_new_tenant_id', 'ns_new_id']
		],
		'ns_nwsusr_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ns_nwsusr_tenant_id', 'ns_nwsusr_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
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