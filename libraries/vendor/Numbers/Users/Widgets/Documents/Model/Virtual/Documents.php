<?php

namespace Numbers\Users\Widgets\Documents\Model\Virtual;
class Documents extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $name = null;
	public $pk = ['wg_document_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'wg_document_'; // must not change it
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

	public $relation; // must not change it
	public $attributes = false; // must not change it

	public $who = [
		'inserted' => true
	];

	/**
	 * Constructor
	 */
	public function __construct($class, $virtual_class_name, $options = []) {
		// add regular columns
		$this->columns['wg_document_tenant_id'] = ['name' => 'Tenant #', 'domain' => 'tenant_id'];
		$this->columns['wg_document_id'] = ['name' => 'Document #', 'domain' => 'big_id_sequence'];
		$this->determineModelMap($class, 'documents', $virtual_class_name, $options);
		$this->columns['wg_document_file_id'] = ['name' => 'File', 'domain' => 'file_id'];
		$this->columns['wg_document_important'] = ['name' => 'Important', 'type' => 'boolean'];
		$this->columns['wg_document_catalog_code'] = ['name' => 'Catalog', 'domain' => 'group_code'];
		// add constraints
		$this->constraints[$this->name . '_pk'] = [
			'type' => 'pk',
			'columns' => ['wg_document_tenant_id', 'wg_document_id']
		];
		$this->constraints[$this->name . '_parent_fk'] = [
			'type' => 'fk',
			'columns' => array_values($this->map),
			'foreign_model' => $class,
			'foreign_columns' => array_keys($this->map)
		];
		// construct table
		parent::__construct($options);
	}

	/**
	 * Merge
	 *
	 * @param array $data
	 * @param array $options
	 * @return array
	 */
	public function merge($data, $options = []) {
		$this->processWhoColumns(['inserted'], $data);
		$data['wg_document_id'] = $this->sequence('wg_document_id');
		$data['wg_document_tenant_id'] = \Tenant::id();
		return $this->db_object->insert($this->full_table_name, [$data]);
	}
}