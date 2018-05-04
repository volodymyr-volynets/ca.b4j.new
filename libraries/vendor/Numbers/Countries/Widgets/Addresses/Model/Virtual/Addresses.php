<?php

namespace Numbers\Countries\Widgets\Addresses\Model\Virtual;
class Addresses extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $name = null;
	public $pk = [];
	public $tenant = true;
	public $orderby = [
		'wg_address_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'wg_address_';
	public $columns = [];
	public $constraints = [];
	public $indexes = [];
	public $history = false;
	public $audit = false; // must not change it
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $attributes = true;
	public $details_pk = ['wg_address_type_code'];

	/**
	 * Constructor
	 */
	public function __construct($class, $virtual_class_name, $options = []) {
		$this->determineModelMap($class, 'addresses', $virtual_class_name, $options);
		// add regular columns
		$this->columns['wg_address_tenant_id'] = ['name' => 'Tenant #', 'domain' => 'tenant_id'];
		$this->columns['wg_address_id'] = ['name' => 'Detail #', 'domain' => 'big_id_sequence'];
		$this->columns['wg_address_type_code'] = ['name' => 'Type', 'domain' => 'type_code'];
		$this->columns['wg_address_name'] = ['name' => 'Name', 'domain' => 'name', 'null' => true];
		$this->columns['wg_address_address1'] = ['name' => 'Address Line 1', 'domain' => 'name', 'null' => true];
		$this->columns['wg_address_address2'] = ['name' => 'Address Line 2', 'domain' => 'name', 'null' => true];
		$this->columns['wg_address_city'] = ['name' => 'City', 'domain' => 'name', 'null' => true];
		$this->columns['wg_address_province_code'] = ['name' => 'Province', 'domain' => 'province_code', 'null' => true];
		$this->columns['wg_address_country_code'] = ['name' => 'Country', 'domain' => 'country_code', 'null' => true];
		$this->columns['wg_address_postal_code'] = ['name' => 'Postal Code', 'domain' => 'postal_code', 'null' => true];
		$this->columns['wg_address_phone'] = ['name' => 'Phone', 'domain' => 'phone', 'null' => true];
		$this->columns['wg_address_fax'] = ['name' => 'Fax', 'domain' => 'phone', 'null' => true];
		$this->columns['wg_address_email'] = ['name' => 'Email', 'domain' => 'email', 'null' => true];
		$this->columns['wg_address_inactive'] = ['name' => 'Inactive', 'type' => 'boolean'];
		$this->pk = array_merge(array_values($this->map), $this->details_pk);
		// add constraints
		$this->constraints[$this->name . '_pk'] = [
			'type' => 'pk',
			'columns' => $this->pk
		];
		$this->constraints[$this->name . '_parent_fk'] = [
			'type' => 'fk',
			'columns' => array_values($this->map),
			'foreign_model' => $class,
			'foreign_columns' => array_keys($this->map)
		];
		$this->constraints[$this->name . '_type_code_fk'] = [
			'type' => 'fk',
			'columns' => ['wg_address_tenant_id', 'wg_address_type_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Address\Types',
			'foreign_columns' => ['cm_addrtype_tenant_id', 'cm_addrtype_code']
		];
		$this->constraints[$this->name . '_country_code_fk'] = [
			'type' => 'fk',
			'columns' => ['wg_address_tenant_id', 'wg_address_country_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Countries',
			'foreign_columns' => ['cm_country_tenant_id', 'cm_country_code']
		];
		$this->constraints[$this->name . '_province_code_fk'] = [
			'type' => 'fk',
			'columns' => ['wg_address_tenant_id', 'wg_address_country_code', 'wg_address_province_code'],
			'foreign_model' => '\Numbers\Countries\Countries\Model\Provinces',
			'foreign_columns' => ['cm_province_tenant_id', 'cm_province_country_code', 'cm_province_province_code']
		];
		$this->indexes[$this->name . '_parent_idx'] = ['type' => 'btree', 'columns' => array_values($this->map)];
		// construct table
		parent::__construct($options);
		// we need to fix attribute model
		if (!empty($this->attributes)) {
			$this->attributes = [
				'map' => []
			];
			foreach ($this->map as $k => $v) {
				$this->attributes['map'][$v] = str_replace('wg_address_', 'wg_attribute_', $v);
			}
			foreach ($this->details_pk as $k => $v) {
				$this->attributes['map'][$v] = str_replace('wg_address_', 'wg_attribute_', $v);
			}
			$this->attributes_model = $class . '\0Virtual0\Widgets\Addresses\0Virtual0\Widgets\Attributes';
		}
	}

	/**
	 * Process widget (form)
	 *
	 * @param object $form
	 * @param array $options
	 */
	public function formProcessWidget(& $form, $options) {
		// create a container
		$new_container_link = ($options['container_link'] ?? '') . '_' . ($options['row_link'] ?? '') . '__container';
		$form->container($new_container_link, [
			'type' => 'details',
			'details_rendering_type' => 'grid_with_label',
			'details_new_rows' => 1,
			'details_key' => $this->virtual_class_name,
			'details_pk' => $this->details_pk,
			'details_collection_key' => ['details', $this->virtual_class_name],
			'details_process_widget_data' => method_exists($this, 'formProcessWidgetData'),
			'order' => 35000,
			'required' => false
		]);
		// get global settings
		$global_options = \Application::get('flag.global.widgets.addresses.options');
		// add elements
		$elements = [
			'row1' => [
				'wg_address_type_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Address Type', 'domain' => 'type_code', 'null' => true, 'percent' => 40, 'required' => true, 'persistent' => true, 'details_unique_select' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Address\Types::optionsActive', 'onchange' => 'this.form.submit();'],
				'wg_address_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'null' => true, 'percent' => 55],
				'wg_address_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'wg_address_address1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Address Line 1', 'domain' => 'name', 'null' => true, 'percent' => 50, 'required' => true],
				'wg_address_address2' => ['order' => 2, 'label_name' => 'Address Line 2', 'domain' => 'name', 'null' => true, 'percent' => 50]
			],
			'row3' => [
				'wg_address_city' => ['order' => 1, 'row_order' => 300, 'label_name' => 'City', 'domain' => 'name', 'null' => true, 'percent' => 50],
				'wg_address_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'null' => true, 'percent' => 50]
			],
			'row4' => [
				'wg_address_country_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'wg_address_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'wg_address_country_code']]
			],
			'row5' => [
				'wg_address_phone' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50],
				'wg_address_fax' => ['order' => 2, 'label_name' => 'Fax', 'domain' => 'phone', 'null' => true, 'percent' => 50]
			],
			'row6' => [
				'wg_address_email' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Email', 'domain' => 'email', 'null' => true, 'percent' => 100]
			]
		];
		// add elements to the form
		foreach ($elements as $k => $v) {
			foreach ($v as $k2 => $v2) {
				// handle field settings
				if (!empty($global_options['fields'][$k2])) {
					$v2 = array_merge_hard($v2, $global_options['fields'][$k2]);
				}
				$form->element($new_container_link, $k, $k2, $v2);
			}
		}
		// link containers
		if ($options['type'] == 'tabs') {
			$form->element($options['container_link'], $options['row_link'], $options['row_link'], ['container' => $new_container_link, 'order' => 1]);
		}
		// collection
		array_key_set($form->collection['details'], $this->virtual_class_name, [
			'name' => 'Addresses',
			'pk' => $this->pk,
			'type' => '1M',
			'map' => $this->map,
			'addresses' => true
		]);
		$form->updateCollectionObject();
		// attributes
		if ($this->attributes) {
			$form->container($new_container_link . '__attributes', [
				'widget' => 'detail_attributes',
				'type' => 'subdetails',
				'label_name' => 'Attributes',
				'details_rendering_type' => 'table',
				'details_new_rows' => 1,
				'details_parent_key' => $this->virtual_class_name,
				'details_key' => $this->attributes_model,
				'details_pk' => ['wg_attribute_attribute_id'],
				'order' => PHP_INT_MAX - 1000,
				'required' => false
			]);
		}
		return true;
	}
}