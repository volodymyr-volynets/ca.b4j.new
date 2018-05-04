<?php

namespace Numbers\Users\Organizations\Model\Service\Assignment;
class Types extends \Object\Data {
	public $column_key = 'on_servasstype_id';
	public $column_prefix = 'on_servasstype_';
	public $columns = [
		'on_servasstype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'on_servasstype_parent' => ['name' => 'Parent Type #', 'domain' => 'type_id'],
		'on_servasstype_name' => ['name' => 'Name', 'type' => 'text'],
		'on_servasstype_icon' => ['name' => 'Icon', 'type' => 'text'],
		'on_servasstype_disabled' => ['name' => 'Disabled', 'type' => 'boolean']
	];
	public $options_map = [
		'on_servasstype_name' => 'name',
		'on_servasstype_icon' => 'icon_class',
		'on_servasstype_parent' => 'parent',
		'on_servasstype_disabled' => 'disabled'
	];
	public $data = [
		10 => ['on_servasstype_name' => 'Territories', 'on_servasstype_icon' => 'far fa-square', 'on_servasstype_disabled' => 1],
		13 => ['on_servasstype_name' => 'Postal Codes', 'on_servasstype_icon' => 'far fa-compass', 'on_servasstype_parent' => 10],
		17 => ['on_servasstype_name' => 'Counties', 'on_servasstype_icon' => 'fab fa-shirtsinbulk', 'on_servasstype_parent' => 10],
		20 => ['on_servasstype_name' => 'Postal Codes', 'on_servasstype_icon' => 'far fa-compass'],
		30 => ['on_servasstype_name' => 'Locations', 'on_servasstype_icon' => 'fas fa-coffee'],
		40 => ['on_servasstype_name' => 'Geo Areas', 'on_servasstype_icon' => 'fas fa-images'],
		// todo
		50 => ['on_servasstype_name' => 'No Assignment', 'on_servasstype_icon' => 'fas fa-leaf'],
	];

	public function options($options = []) {
		$data = parent::options($options);
		// see if territories has been activated
		if (!\Can::systemFeatureExists('ON::TERRITORIES')) {
			unset($data[10]);
			unset($data[13]);
			unset($data[17]);
		}
		// if we have postal codes
		if (!\Can::systemFeatureExists('CM::COUNTRIES')) {
			unset($data[20]);
		}
		// if we have geo extension
		if (!\Can::systemFeatureExists('SM::POSTGIS')) {
			unset($data[40]);
		}
		$converted = \Helper\Tree::convertByParent($data, 'parent');
		$result = [];
		\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name', 'i18n' => false], $result);
		return $result;
	}
}