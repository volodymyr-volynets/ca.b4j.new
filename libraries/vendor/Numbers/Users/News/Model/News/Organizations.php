<?php

namespace Numbers\Users\News\Model\News;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'NS';
	public $title = 'N/S News Organizations';
	public $name = 'ns_news_organizations';
	public $pk = ['um_nwsorg_tenant_id', 'um_nwsorg_news_id', 'um_nwsorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'um_nwsorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_nwsorg_';
	public $columns = [
		'um_nwsorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_nwsorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_nwsorg_news_id' => ['name' => 'News #', 'domain' => 'group_id'],
		'um_nwsorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_nwsorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ns_news_organizations_pk' => ['type' => 'pk', 'columns' => ['um_nwsorg_tenant_id', 'um_nwsorg_news_id', 'um_nwsorg_organization_id']],
		'um_nwsorg_news_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_nwsorg_tenant_id', 'um_nwsorg_news_id'],
			'foreign_model' => '\Numbers\Users\News\Model\News',
			'foreign_columns' => ['ns_new_tenant_id', 'ns_new_id']
		],
		'um_nwsorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_nwsorg_tenant_id', 'um_nwsorg_organization_id'],
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

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}