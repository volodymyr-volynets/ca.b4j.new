<?php

namespace Numbers\Users\Users\Model\User;
class Internalization extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Internalization';
	public $name = 'um_user_internalization';
	public $pk = ['um_usri18n_tenant_id', 'um_usri18n_user_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'um_usri18n_';
	public $columns = [
		'um_usri18n_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usri18n_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		// i18n settings
		'um_usri18n_group_id' => ['name' => 'Group #', 'domain' => 'group_id', 'null' => true],
		'um_usri18n_language_code' => ['name' => 'Language Code', 'domain' => 'language_code', 'null' => true],
		'um_usri18n_locale_code' => ['name' => 'Locale Code', 'domain' => 'locale_code', 'null' => true],
		'um_usri18n_timezone_code' => ['name' => 'Timezone Code', 'domain' => 'timezone_code', 'null' => true],
		'um_usri18n_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id', 'null' => true],
		// format settings, if not set would be inherited from application settings
		'um_usri18n_format_date' => ['name' => 'Date Format', 'domain' => 'code', 'null' => true],
		'um_usri18n_format_time' => ['name' => 'Time Format', 'domain' => 'code', 'null' => true],
		'um_usri18n_format_datetime' => ['name' => 'Datetime Format', 'domain' => 'code', 'null' => true],
		'um_usri18n_format_timestamp' => ['name' => 'Timestamp Format', 'domain' => 'code', 'null' => true],
		'um_usri18n_format_amount_frm' => ['name' => 'Amounts In Forms', 'domain' => 'type_id', 'null' => true, 'options_model' => '\Object\Format\Amounts'],
		'um_usri18n_format_amount_fs' => ['name' => 'Amounts In Financial Statement', 'domain' => 'type_id', 'null' => true, 'options_model' => '\Object\Format\Amounts'],
		'um_usri18n_format_uom' => ['name' => 'Unit of Measures', 'domain' => 'group_code', 'null' => true, 'default' => 'METRIC', 'options_model' => '\Object\Format\UoM'],
		// print
		'um_usri18n_print_format' => ['name' => 'Print Format', 'domain' => 'code', 'null' => true],
		'um_usri18n_print_font' => ['name' => 'Print Font', 'domain' => 'code', 'null' => true],
	];
	public $constraints = [
		'um_user_internalization_pk' => ['type' => 'pk', 'columns' => ['um_usri18n_tenant_id', 'um_usri18n_user_id']],
		'um_usri18n_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usri18n_locale_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_locale_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Locales',
			'foreign_columns' => ['in_locale_tenant_id', 'in_locale_code']
		],
		'um_usri18n_timezone_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_timezone_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Timezones',
			'foreign_columns' => ['in_timezone_tenant_id', 'in_timezone_code']
		],
		'um_usri18n_language_code_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_language_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
			'foreign_columns' => ['in_language_tenant_id', 'in_language_code']
		],
		'um_usri18n_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'um_usri18n_group_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usri18n_tenant_id', 'um_usri18n_group_id'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Groups',
			'foreign_columns' => ['in_group_tenant_id', 'in_group_id']
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