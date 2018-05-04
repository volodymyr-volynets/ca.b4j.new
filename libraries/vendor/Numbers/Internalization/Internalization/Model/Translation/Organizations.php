<?php

namespace Numbers\Internalization\Internalization\Model\Translation;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'IN';
	public $title = 'IN Translation Organizations';
	public $name = 'in_translation_organizations';
	public $pk = ['in_translorg_tenant_id', 'in_translorg_translation_id', 'in_translorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'in_translorg_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'in_translorg_';
	public $columns = [
		'in_translorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'in_translorg_id' => ['name' => '#', 'type' => 'bigserial'],
		'in_translorg_translation_id' => ['name' => 'Translation #', 'domain' => 'big_id'],
		'in_translorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'in_translorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'in_translation_organizations_pk' => ['type' => 'pk', 'columns' => ['in_translorg_tenant_id', 'in_translorg_translation_id', 'in_translorg_organization_id']],
		'in_translorg_translation_id_fk' => [
			'type' => 'fk',
			'columns' => ['in_translorg_tenant_id', 'in_translorg_translation_id'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Translations',
			'foreign_columns' => ['in_translation_tenant_id', 'in_translation_id']
		],
		'in_translorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['in_translorg_tenant_id', 'in_translorg_organization_id'],
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
		'classification' => 'public',
		'protection' => 2,
		'scope' => 'global'
	];
}