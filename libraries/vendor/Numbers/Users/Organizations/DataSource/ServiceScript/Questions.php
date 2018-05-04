<?php

namespace Numbers\Users\Organizations\DataSource\ServiceScript;
class Questions extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_servquestion_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions';
	public $parameters = [
		'service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id', 'required' => true],
		'region_id' => ['name' => 'Region #', 'domain' => 'region_id', 'required' => true],
		'channel_code' => ['name' => 'Channel Code', 'domain' => 'code', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'on_servquestion_id',
			'on_servquestion_name',
			'on_servquestion_order',
			'on_servquestion_type_code',
			'on_servquestion_model_id',
			'on_servquestion_required',
			'description' => 'b.on_servquesdesc_description',
			'answers' => 'c.answers'
		]);
		// join
		$this->query->join('LEFT', new \Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Description(), 'b', 'ON', [
			['AND', ['a.on_servquestion_service_script_id', '=', 'b.on_servquesdesc_service_script_id', true], false],
			['AND', ['a.on_servquestion_id', '=', 'b.on_servquesdesc_question_id', true], false],
		]);
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers::queryBuilderStatic(['alias' => 'inner_c'])->select();
			$query->columns([
				'inner_c.on_servquesanswer_service_script_id',
				'inner_c.on_servquesanswer_question_id',
				'answers' => $query->db_object->sqlHelper('string_agg', ['expression' => 'inner_c.on_servquesanswer_name', 'delimiter' => ';;'])
			]);
			$query->groupby(['inner_c.on_servquesanswer_service_script_id', 'inner_c.on_servquesanswer_question_id']);
		}, 'c', 'ON', [
			['AND', ['a.on_servquestion_service_script_id', '=', 'c.on_servquesanswer_service_script_id', true], false],
			['AND', ['a.on_servquestion_id', '=', 'c.on_servquesanswer_question_id', true], false]
		]);
		// where
		$this->query->where('AND', ['a.on_servquestion_service_script_id', '=', $parameters['service_script_id'], false]);
		$this->query->where('AND', ['a.on_servquestion_inactive', '=', 0, false]);
		$this->query->where('AND', function (& $query) use ($parameters) {
			$query->where('OR', ['a.on_servquestion_all_regions', '=', 1]);
			$query->where('OR', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Regions::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns(['inner_a.on_servquesregion_region_id']);
				$query->where('AND', ['inner_a.on_servquesregion_service_script_id', '=', $parameters['service_script_id'], false]);
				$query->where('AND', ['inner_a.on_servquesregion_question_id', '=', 'a.on_servquestion_id', true]);
				$query->where('AND', ['inner_a.on_servquesregion_region_id', '=', $parameters['region_id'], false]);
				$query->where('AND', ['inner_a.on_servquesregion_inactive', '=', 0, false]);
			}, 'EXISTS');
		});
		$this->query->where('AND', function (& $query) use ($parameters) {
			$query->where('OR', ['a.on_servquestion_all_channels', '=', 1]);
			$query->where('OR', function (& $query) use ($parameters) {
				$query2 = \Numbers\Users\Organizations\Model\Service\Channels::queryBuilderStatic(['alias' => 'exists_b'])->select();
				$query2->columns(['exists_b.on_servchannel_id']);
				$query2->where('AND', ['exists_b.on_servchannel_code', '=', $parameters['channel_code'], false]);
				$query = \Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Channels::queryBuilderStatic(['alias' => 'inner_b'])->select();
				$query->columns(['inner_b.on_servqueschan_channel_id']);
				$query->where('AND', ['inner_b.on_servqueschan_service_script_id', '=', $parameters['service_script_id'], false]);
				$query->where('AND', ['inner_b.on_servqueschan_question_id', '=', 'a.on_servquestion_id', true]);
				$query->where('AND', ['inner_b.on_servqueschan_channel_id', 'IN', '(' . $query2->sql() . ')', true]);
				$query->where('AND', ['inner_b.on_servqueschan_inactive', '=', 0, false]);
			}, 'EXISTS');
		});
		$this->query->orderby(['on_servquestion_order' => SORT_ASC]);
	}

	public function process($data, $options = []) {
		foreach ($data as $k => $v) {
			if (empty($v['answers'])) {
				$data[$k]['answers'] = [];
			} else {
				$temp = explode(';;', $v['answers']);
				$data[$k]['answers'] = [];
				foreach ($temp as $v2) {
					$data[$k]['answers'][$v2] = ['name' => $v2];
				}
			}
		}
		return $data;
	}
}