<?php

namespace Numbers\Users\Chat\DataSource;
class Groups extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['ct_group_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $options_active =[];
	public $column_prefix = 'ct_group_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Chat\Model\Groups';
	public $parameters = [
		'only_this_group_id' => ['name' => 'Only This Group #', 'domain' => 'group_id'],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'a.*',
			'b.user_ids',
			'b.user_names',
			'b.photos'
		]);
		// join
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Chat\Model\Group\Users::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.ct_grpuser_group_id',
				'user_ids' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.ct_grpuser_user_id)", 'delimiter' => ';;']),
				'user_names' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_b.um_user_name)", 'delimiter' => ';;']),
				'photos' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', COALESCE(inner_b.um_user_photo_file_id, -1))", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Users\Model\Users(), 'inner_b', 'ON', [
				['AND', ['inner_a.ct_grpuser_user_id', '=', 'inner_b.um_user_id', true], false]
			]);
			$query->where('AND', ['inner_a.ct_grpuser_user_id', '<>', \User::id()]);
			$query->groupby(['inner_a.ct_grpuser_group_id']);
		}, 'b', 'ON', [
			['AND', ['a.ct_group_id', '=', 'b.ct_grpuser_group_id', true], false]
		]);
		// where
		$this->query->where('AND', function (& $query) {
			$query = \Numbers\Users\Chat\Model\Group\Users::queryBuilderStatic(['alias' => 'exists_a'])->select();
			$query->columns(['exists_a.ct_grpuser_user_id']);
			$query->where('AND', ['exists_a.ct_grpuser_group_id', '=', 'a.ct_group_id', true]);
			$query->where('AND', ['exists_a.ct_grpuser_user_id', '=', \User::id(), false]);
		}, 'EXISTS');
		if (!empty($parameters['only_this_group_id'])) {
			$this->query->where('AND', ['a.ct_group_id', '=', $parameters['only_this_group_id']]);
		}
	}

	public function process($data, $options = []) {
		foreach ($data as $k => $v) {
			// user_ids
			if (!empty($v['user_ids'])) {
				$data[$k]['user_ids'] = explode(';;', $v['user_ids']);
			} else {
				$data[$k]['user_ids'] = [];
			}
			// user_ids
			if (!empty($v['user_names'])) {
				$data[$k]['user_names'] = explode(';;', $v['user_names']);
			} else {
				$data[$k]['user_names'] = [];
			}
			// photos
			if (!empty($v['photos'])) {
				$data[$k]['photos'] = explode(';;', $v['photos']);
				foreach ($data[$k]['photos'] as $k2 => $v2) {
					$data[$k]['photos'][$k2] = (int) $v2;
				}
			} else {
				$data[$k]['photos'] = [];
			}
		}
		return $data;
	}
}