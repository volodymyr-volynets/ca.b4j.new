<?php

namespace Numbers\Users\Widgets\Comments\Model\Virtual;
class Comments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $name = null;
	public $pk = ['wg_comment_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'wg_comment_'; // must not change it
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
		$this->columns['wg_comment_tenant_id'] = ['name' => 'Tenant #', 'domain' => 'tenant_id'];
		$this->columns['wg_comment_id'] = ['name' => 'Comment #', 'domain' => 'big_id_sequence'];
		$this->determineModelMap($class, 'comments', $virtual_class_name, $options);
		$this->columns['wg_comment_value'] = ['name' => 'Comment', 'domain' => 'comment'];
		$this->columns['wg_comment_important'] = ['name' => 'Inportant', 'type' => 'boolean'];
		$this->columns['wg_comment_file_1'] = ['name' => 'File 1', 'domain' => 'file_id', 'null' => true];
		// add constraints
		$this->constraints[$this->name . '_pk'] = [
			'type' => 'pk',
			'columns' => ['wg_comment_tenant_id', 'wg_comment_id']
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
		$data['wg_comment_id'] = $this->sequence('wg_comment_id');
		$data['wg_comment_tenant_id'] = \Tenant::id();
		return $this->db_object->insert($this->full_table_name, [$data]);
	}
}