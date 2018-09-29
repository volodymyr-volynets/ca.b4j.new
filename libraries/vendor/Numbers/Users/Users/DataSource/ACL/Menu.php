<?php

namespace Numbers\Users\Users\DataSource\ACL;
class Menu extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Backend\System\Modules\Model\Resources';
	public $parameters = [];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'id' => 'a.sm_resource_id',
			'type' => 'a.sm_resource_type',
			'name' => 'a.sm_resource_name',
			'description' => 'a.sm_resource_description',
			'icon' => 'a.sm_resource_icon',
			'url' => 'a.sm_resource_menu_url',
			'module_code' => 'a.sm_resource_module_code',
			'group1' => 'a.sm_resource_group1_name',
			'group2' => 'a.sm_resource_group2_name',
			'group3' => 'a.sm_resource_group3_name',
			'group4' => 'a.sm_resource_group4_name',
			'group5' => 'a.sm_resource_group5_name',
			'group6' => 'a.sm_resource_group6_name',
			'group7' => 'a.sm_resource_group7_name',
			'group8' => 'a.sm_resource_group8_name',
			'group9' => 'a.sm_resource_group9_name',
			'acl_public' => 'a.sm_resource_acl_public',
			'acl_authorized' => 'a.sm_resource_acl_authorized',
			'acl_permission' => 'a.sm_resource_acl_permission',
			'acl_resource_id' => 'a.sm_resource_menu_acl_resource_id',
			'acl_method_code' => 'a.sm_resource_menu_acl_method_code',
			'acl_action_id' => 'a.sm_resource_menu_acl_action_id',
			'child_ordered' => 'a.sm_resource_menu_child_ordered',
			'order' => 'a.sm_resource_menu_order',
			'separator' => 'a.sm_resource_menu_separator',
			'name_generator' => 'a.sm_resource_menu_name_generator',
			'class' => 'a.sm_resource_menu_class'
		]);
		// where
		$this->query->where('AND', ['a.sm_resource_type', '>=', 200]);
		$this->query->where('AND', ['a.sm_resource_type', '<', 300]);
		$this->query->where('AND', ['a.sm_resource_inactive', '=', 0]);
		// orderby
		$this->query->orderby(['a.sm_resource_type' => SORT_DESC]);
	}
}