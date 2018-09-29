<?php

namespace Numbers\Backend\System\Modules\Model;
class Resources extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'SM';
	public $title = 'S/M Resources';
	public $name = 'sm_resources';
	public $pk = ['sm_resource_id'];
	public $tenant = false;
	public $orderby;
	public $limit;
	public $column_prefix = 'sm_resource_';
	public $columns = [
		'sm_resource_id' => ['name' => 'Resource #', 'domain' => 'resource_id_sequence'],
		'sm_resource_code' => ['name' => 'Code', 'domain' => 'code'],
		'sm_resource_type' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Backend\System\Modules\Model\Resource\Types'],
		'sm_resource_classification' => ['name' => 'Classification', 'domain' => 'name', 'null' => true],
		'sm_resource_name' => ['name' => 'Name', 'domain' => 'name'],
		'sm_resource_description' => ['name' => 'Description', 'domain' => 'description', 'null' => true],
		'sm_resource_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'sm_resource_module_code' => ['name' => 'Module Code', 'domain' => 'module_code'],
		'sm_resource_group1_name' => ['name' => 'Group 1', 'domain' => 'name', 'null' => true],
		'sm_resource_group2_name' => ['name' => 'Group 2', 'domain' => 'name', 'null' => true],
		'sm_resource_group3_name' => ['name' => 'Group 3', 'domain' => 'name', 'null' => true],
		'sm_resource_group4_name' => ['name' => 'Group 4', 'domain' => 'name', 'null' => true],
		'sm_resource_group5_name' => ['name' => 'Group 5', 'domain' => 'name', 'null' => true],
		'sm_resource_group6_name' => ['name' => 'Group 6', 'domain' => 'name', 'null' => true],
		'sm_resource_group7_name' => ['name' => 'Group 7', 'domain' => 'name', 'null' => true],
		'sm_resource_group8_name' => ['name' => 'Group 8', 'domain' => 'name', 'null' => true],
		'sm_resource_group9_name' => ['name' => 'Group 9', 'domain' => 'name', 'null' => true],
		// acl
		'sm_resource_acl_public' => ['name' => 'Acl Public', 'type' => 'boolean'],
		'sm_resource_acl_authorized' => ['name' => 'Acl Authorized', 'type' => 'boolean'],
		'sm_resource_acl_permission' => ['name' => 'Acl Permission', 'type' => 'boolean'],
		// menu
		'sm_resource_menu_acl_resource_id' => ['name' => 'Acl Resource #', 'domain' => 'resource_id', 'null' => true], // used by menu resources
		'sm_resource_menu_acl_method_code' => ['name' => 'Acl Action Code', 'domain' => 'code', 'null' => true], // used by menu resources
		'sm_resource_menu_acl_action_id' => ['name' => 'Acl Action #', 'domain' => 'action_id', 'null' => true], // used by menu resources
		'sm_resource_menu_url' => ['name' => 'URL', 'type' => 'text', 'null' => true],
		'sm_resource_menu_options_generator' => ['name' => 'Options Generator', 'type' => 'text', 'null' => true],
		'sm_resource_menu_name_generator' => ['name' => 'Name Generator', 'type' => 'text', 'null' => true],
		'sm_resource_menu_child_ordered' => ['name' => 'Child Ordered', 'type' => 'boolean'],
		'sm_resource_menu_order' => ['name' => 'Order', 'type' => 'integer', 'default' => 0],
		'sm_resource_menu_separator' => ['name' => 'Separator', 'type' => 'boolean'],
		'sm_resource_menu_class' => ['name' => 'Class', 'type' => 'text', 'null' => true],
		// other
		'sm_resource_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'sm_resources_pk' => ['type' => 'pk', 'columns' => ['sm_resource_id']],
		'sm_resource_code_un' => ['type' => 'unique', 'columns' => ['sm_resource_code']],
		'sm_resource_module_code_fk' => [
			'type' => 'fk',
			'columns' => ['sm_resource_module_code'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Modules',
			'foreign_columns' => ['sm_module_code']
		],
		'sm_resource_menu_acl_resource_id_fk' => [
			'type' => 'fk',
			'columns' => ['sm_resource_menu_acl_resource_id'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Resources',
			'foreign_columns' => ['sm_resource_id']
		],
		'sm_resource_menu_acl_action_id_fk' => [
			'type' => 'fk',
			'columns' => ['sm_resource_menu_acl_action_id'],
			'foreign_model' => '\Numbers\Backend\System\Modules\Model\Resource\Actions',
			'foreign_columns' => ['sm_action_id']
		],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
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
		'protection' => 1,
		'scope' => 'global'
	];
}