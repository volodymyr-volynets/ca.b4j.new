<?php

namespace Numbers\Users\Users\Model\User\Assignment;
class GeoAreas extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Geo Areas';
	public $name = 'um_user_assignment_geo_areas';
	public $pk = ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_user_id', 'um_usrassgeoarea_id'];
	public $tenant = true;
	public $orderby = [
		'um_usrassgeoarea_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrassgeoarea_';
	public $columns = [
		'um_usrassgeoarea_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassgeoarea_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_usrassgeoarea_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassgeoarea_id' => ['name' => 'Detail #', 'domain' => 'group_id'],
		'um_usrassgeoarea_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_usrassgeoarea_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_usrassgeoarea_brand_id' => ['name' => 'Brand #', 'domain' => 'brand_id'],
		'um_usrassgeoarea_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'um_usrassgeoarea_polygon' => ['name' => 'Polygon', 'type' => 'geometry'],
		'um_usrassgeoarea_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_assignment_geo_areas_pk' => ['type' => 'pk', 'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_user_id', 'um_usrassgeoarea_id']],
		'um_usrassgeoarea_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrassgeoarea_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		],
		'um_usrassgeoarea_service_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_service_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Services',
			'foreign_columns' => ['on_service_tenant_id', 'on_service_id']
		],
		'um_usrassgeoarea_brand_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_brand_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Brands',
			'foreign_columns' => ['on_brand_tenant_id', 'on_brand_id']
		],
		'um_usrassgeoarea_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_location_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Locations',
			'foreign_columns' => ['on_location_tenant_id', 'on_location_id']
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

	public $acl = ['Numbers.Backend.Db.Extension.PostgreSQL.PostGIS'];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}