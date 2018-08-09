<?php

namespace Numbers\Users\Users\Model;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Users';
	public $schema;
	public $name = 'um_users';
	public $pk = ['um_user_tenant_id', 'um_user_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_user_';
	public $columns = [
		'um_user_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_user_id' => ['name' => 'User #', 'domain' => 'user_id_sequence'],
		'um_user_code' => ['name' => 'User Number', 'domain' => 'group_code', 'null' => true],
		'um_user_type_id' => ['name' => 'Type', 'domain' => 'type_id'],
		'um_user_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_user_company' => ['name' => 'Company', 'domain' => 'name', 'null' => true],
		// personal information
		'um_user_title' => ['name' => 'Title', 'domain' => 'personal_title', 'null' => true],
		'um_user_first_name' => ['name' => 'First Name', 'domain' => 'personal_name', 'null' => true],
		'um_user_last_name' => ['name' => 'Last Name', 'domain' => 'personal_name', 'null' => true],
		// contact
		'um_user_email' => ['name' => 'Primary Email', 'domain' => 'email', 'null' => true],
		'um_user_email2' => ['name' => 'Secondary Email', 'domain' => 'email', 'null' => true],
		'um_user_phone' => ['name' => 'Primary Phone', 'domain' => 'phone', 'null' => true],
		'um_user_numeric_phone' => ['name' => 'Primary Phone (Numeric)', 'domain' => 'numeric_phone', 'null' => true],
		'um_user_phone2' => ['name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true],
		'um_user_cell' => ['name' => 'Cell Phone', 'domain' => 'phone', 'null' => true],
		'um_user_fax' => ['name' => 'Fax', 'domain' => 'phone', 'null' => true],
		// login
		'um_user_login_enabled' => ['name' => 'Login Enabled', 'type' => 'boolean'],
		'um_user_login_username' => ['name' => 'Username', 'domain' => 'login', 'null' => true],
		'um_user_login_password' => ['name' => 'Password', 'domain' => 'password', 'null' => true],
		'um_user_login_last_set' => ['name' => 'Last Set', 'type' => 'date', 'null' => true],
		// photo
		'um_user_photo_file_id' => ['name' => 'Photo File #', 'domain' => 'file_id', 'null' => true],
		// operating country / province
		'um_user_operating_country_code' => ['name' => 'Operating Country Code', 'domain' => 'country_code', 'null' => true],
		'um_user_operating_province_code' => ['name' => 'Operating Province Code', 'domain' => 'province_code', 'null' => true],
		// inactive & hold
		'um_user_hold' => ['name' => 'Hold', 'type' => 'boolean'],
		'um_user_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_users_pk' => ['type' => 'pk', 'columns' => ['um_user_tenant_id', 'um_user_id']],
		'um_user_code_un' => ['type' => 'unique', 'columns' => ['um_user_tenant_id', 'um_user_code']],
		'um_user_email_un' => ['type' => 'unique', 'columns' => ['um_user_tenant_id', 'um_user_email']],
		'um_user_numeric_phone_un' => ['type' => 'unique', 'columns' => ['um_user_tenant_id', 'um_user_numeric_phone']],
		'um_user_login_username_un' => ['type' => 'unique', 'columns' => ['um_user_tenant_id', 'um_user_login_username']],
		'um_user_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_user_type_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Types',
			'foreign_columns' => ['um_usrtype_id']
		],
		'um_user_title_fk' => [
			'type' => 'fk',
			'columns' => ['um_user_tenant_id', 'um_user_title'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Titles',
			'foreign_columns' => ['um_usrtitle_tenant_id', 'um_usrtitle_name']
		],
	];
	public $indexes = [
		'um_users_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_user_code', 'um_user_name', 'um_user_phone', 'um_user_email', 'um_user_company', 'um_user_login_username']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_user_tenant_id' => 'wg_audit_tenant_id',
			'um_user_id' => 'wg_audit_user_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'um_user_name' => 'name',
		'um_user_company' => 'name',
		'um_user_photo_file_id' => 'photo_id',
		'um_user_inactive' => 'inactive'
	];
	public $options_active = [
		'um_user_inactive' => 0
	];
	public $options_skip_i18n = true;
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'um_user_id',
	];

	public $who = [
		'inserted' => true,
		'updated' => true
	];

	public $addresses = [
		'map' => [
			'um_user_tenant_id' => 'wg_address_tenant_id',
			'um_user_id' => 'wg_address_user_id'
		]
	];

	public $attributes = [
		'map' => [
			'um_user_tenant_id' => 'wg_attribute_tenant_id',
			'um_user_id' => 'wg_attribute_user_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	public $triggers = [
		'update_direct_postal_code_actuals' => '\Numbers\Users\Users\Model\User\Assignment\PostalCode\Actuals::triggerUpdateActuals',
		'update_direct_postal_code_details' => '\Numbers\Users\Users\Model\User\Assignment\PostalCode\Details::triggerUpdateDetails',
		'update_territory_postal_details' => '\Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode\Details::triggerUpdateDetails',
		'update_territory_county_details' => '\Numbers\Users\Users\Model\User\Assignment\Territory\County\Details::triggerUpdateDetails'
	];
}