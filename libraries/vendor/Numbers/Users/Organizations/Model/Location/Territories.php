<?php

namespace Numbers\Users\Organizations\Model\Location;
class Territories extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Territories';
	public $schema;
	public $name = 'on_territories';
	public $pk = ['on_territory_tenant_id', 'on_territory_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_territory_';
	public $columns = [
		'on_territory_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_territory_id' => ['name' => 'Territory #', 'domain' => 'territory_id_sequence'],
		'on_territory_code' => ['name' => 'Code', 'domain' => 'group_code', 'null' => true],
		'on_territory_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_territory_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_territory_node_type_id' => ['name' => 'Node Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territory\NodeTypes'],
		'on_territory_parent_territory_id' => ['name' => 'Parent Territory #', 'domain' => 'territory_id', 'null' => true],
		'on_territory_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territory\Types'],
		'on_territory_postal_codes' => ['name' => 'Postal Codes', 'domain' => 'postal_codes', 'null' => true],
		'on_territory_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'on_territory_province_code' => ['name' => 'Province Code', 'domain' => 'province_code', 'null' => true],
		'on_territory_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_territories_pk' => ['type' => 'pk', 'columns' => ['on_territory_tenant_id', 'on_territory_id']],
		'on_territory_parent_territory_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_territory_tenant_id', 'on_territory_parent_territory_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Location\Territories',
			'foreign_columns' => ['on_territory_tenant_id', 'on_territory_id']
		]
	];
	public $indexes = [
		'on_territories_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_territory_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_territory_tenant_id' => 'wg_audit_tenant_id',
			'on_territory_id' => 'wg_audit_territory_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_territory_name' => 'name',
		'on_territory_parent_territory_id' => 'parent',
		'on_territory_node_type_id' => 'node_type_id',
		'on_territory_inactive' => 'inactive'
	];
	public $options_active = [
		'on_territory_inactive' => 0
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

	public $triggers = [
		'update_postal_codes' => '\Numbers\Users\Organizations\Model\Location\Territory\PostalCodes::triggerUpdatePostalCodesFromTerritory',
		'update_territory_postal_details' => '\Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode\Details::triggerUpdateDetails',
		'update_territory_county_details' => '\Numbers\Users\Users\Model\User\Assignment\Territory\County\Details::triggerUpdateDetails'
	];

	/**
	 * @see $this->options()
	 */
	public function optionsGroupped(array $options = []) {
		$options['i18n'] = false;
		$result = $this->optionsActive($options);
		if (!empty($result)) {
			foreach ($result as $k => $v) {
				if ($v['node_type_id'] != 30) {
					$result[$k]['disabled'] = true;
				}
			}
			$converted = \Helper\Tree::convertByParent($result, 'parent', ['disable_parents' => true]);
			$result = [];
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name'], $result);
		}
		return $result;
	}
}