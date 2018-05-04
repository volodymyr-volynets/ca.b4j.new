<?php

namespace Numbers\Internalization\Internalization\Model\Translation;
class Missing extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'IN';
	public $title = 'I/N Tranlsation Missing';
	public $name = 'in_translation_missing';
	public $pk = ['in_translmiss_tenant_id', 'in_translmiss_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'in_translmiss_';
	public $columns = [
		'in_translmiss_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'in_translmiss_id' => ['name' => 'Translation #', 'domain' => 'big_id_sequence'],
		'in_translmiss_from_language_code' => ['name' => 'From Language Code', 'domain' => 'language_code'],
		'in_translmiss_from_text' => ['name' => 'System Text', 'type' => 'varchar', 'length' => 2500],
		'in_translmiss_to_language_code' => ['name' => 'To Language Code', 'domain' => 'language_code'],
		'in_translmiss_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'null' => true],
		'in_translmiss_javascript' => ['name' => 'Javascript', 'type' => 'boolean'],
		'in_translmiss_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'in_translation_missing_pk' => ['type' => 'pk', 'columns' => ['in_translmiss_tenant_id', 'in_translmiss_id']],
		'in_translmiss_from_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['in_translmiss_tenant_id', 'in_translmiss_from_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
		'in_translmiss_to_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['in_translmiss_tenant_id', 'in_translmiss_to_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
		'in_translmiss_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['in_translmiss_tenant_id', 'in_translmiss_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [
		'in_translation_missing_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['in_translmiss_from_text']]
	];
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
		'protection' => 0,
		'scope' => 'global'
	];
}