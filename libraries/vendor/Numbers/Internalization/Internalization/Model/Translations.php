<?php

namespace Numbers\Internalization\Internalization\Model;
class Translations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'IN';
	public $title = 'I/N Tranlsations';
	public $name = 'in_translations';
	public $pk = ['in_translation_tenant_id', 'in_translation_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'in_translation_';
	public $columns = [
		'in_translation_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'in_translation_id' => ['name' => 'Translation #', 'domain' => 'big_id_sequence'],
		'in_translation_i18n_id' => ['name' => 'I18n #', 'domain' => 'group_id', 'null' => true],
		'in_translation_from_language_code' => ['name' => 'From Language Code', 'domain' => 'language_code'],
		'in_translation_from_text' => ['name' => 'From Text', 'type' => 'varchar', 'length' => 2500],
		'in_translation_to_language_code' => ['name' => 'To Language Code', 'domain' => 'language_code'],
		'in_translation_to_text' => ['name' => 'To Text', 'type' => 'varchar', 'length' => 2500],
		'in_translation_javascript' => ['name' => 'Javascript', 'type' => 'boolean'],
		'in_translation_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'in_translations_pk' => ['type' => 'pk', 'columns' => ['in_translation_tenant_id', 'in_translation_id']],
		'in_translations_un' => ['type' => 'unique', 'columns' => ['in_translation_tenant_id', 'in_translation_i18n_id', 'in_translation_from_language_code', 'in_translation_to_language_code']],
		'in_translation_from_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['in_translation_tenant_id', 'in_translation_from_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
		'in_translation_to_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['in_translation_tenant_id', 'in_translation_to_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		]
	];
	public $indexes = [
		'in_translations_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['in_translation_from_text', 'in_translation_to_text']]
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