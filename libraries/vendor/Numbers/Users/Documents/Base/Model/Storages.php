<?php

namespace Numbers\Users\Documents\Base\Model;
class Storages extends \Object\Data {
	public $column_key = 'id';
	public $column_prefix = '';
	public $orderby;
	public $columns = [
		'id' => ['name' => '#', 'domain' => 'type_id'],
		'name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [];

	/**
	 * Get
	 *
	 * @param array $options
	 * @return array
	 */
	public function get($options = []) {
		$storages = \Application::get('documents.storages');
		if (empty($storages)) {
			return [];
		} else {
			return $storages;
		}
	}
}