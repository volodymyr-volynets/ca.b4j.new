<?php

namespace Numbers\Users\Organizations\Model\Service;
class Categories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Categories';
	public $name = 'on_service_categories';
	public $pk = ['on_servcategory_tenant_id', 'on_servcategory_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'on_servcategory_';
	public $columns = [
		'on_servcategory_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servcategory_id' => ['name' => 'Category #', 'domain' => 'category_id_sequence'],
		'on_servcategory_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_servcategory_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_servcategory_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_servcategory_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_servcategory_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_categories_pk' => ['type' => 'pk', 'columns' => ['on_servcategory_tenant_id', 'on_servcategory_id']],
		'on_servcategory_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servcategory_tenant_id', 'on_servcategory_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'on_servcategory_tenant_id' => 'wg_audit_tenant_id',
			'on_servcategory_id' => 'wg_audit_category_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_servcategory_name' => 'name',
		'on_servcategory_icon' => 'icon_class'
	];
	public $options_active = [
		'on_servcategory_inactive' => 0
	];
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