<?php

namespace Numbers\Users\Organizations\DataSource\Service;
class QueueSettings extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_service_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row = true;
	public $single_value;
	public $column_prefix = 'on_service_';

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $options_map = [];
	public $options_active = [];

	public $primary_model = '\Numbers\Users\Organizations\Model\Services';
	public $parameters = [
		'service_id' => ['name' => 'Service #', 'domain' => 'service_id', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'on_service_id' => 'a.on_service_id',
			'on_service_queue_type_id' => 'a.on_service_queue_type_id',
			'on_quetype_method_id' => 'b.on_quetype_method_id'
		]);
		$this->query->join('INNER', new \Numbers\Users\Organizations\Model\Queue\Types(), 'b', 'ON', [
			['AND', ['a.on_service_queue_type_id', '=', 'b.on_quetype_id', true], false],
		]);
		$this->query->where('OR', ['a.on_service_id', '=', $parameters['service_id']]);
	}
}