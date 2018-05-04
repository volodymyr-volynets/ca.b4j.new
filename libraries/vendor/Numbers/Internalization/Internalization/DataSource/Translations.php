<?php

namespace Numbers\Internalization\Internalization\DataSource;
class Translations extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $tenant = true;
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Internalization\Internalization\Model\Translations';
	public $parameters = [
		'from_language' => ['name' => 'From Language', 'domain' => 'language_code', 'required' => true],
		'to_language' => ['name' => 'To Language', 'domain' => 'language_code', 'required' => true],
		'organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'javascript' => ['name' => 'Javascript', 'type' => 'boolean']
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'id' => 'a.in_translation_id',
			'i18n_id' => 'a.in_translation_i18n_id',
			'from_text' => 'a.in_translation_from_text',
			'to_text' => 'a.in_translation_to_text'
		]);
		// where
		$this->query->where('AND', ['a.in_translation_inactive', '=', 0]);
		$this->query->where('AND', ['a.in_translation_from_language_code', '=', $parameters['from_language']]);
		$this->query->where('AND', ['a.in_translation_to_language_code', '=', $parameters['to_language']]);
		if (!empty($parameters['javascript'])) {
			$this->query->where('AND', ['a.in_translation_javascript', '=', 1]);
		}
		$this->query->where('AND NOT', function (& $query) use ($parameters) {
			$query = \Numbers\Internalization\Internalization\Model\Translation\Organizations::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns(1);
			$query->where('AND', ['inner_a.in_translorg_translation_id', '=', 'a.in_translation_id', true]);
		}, true);
		// if we have organization
		if (!empty($parameters['organization_id'])) {
			$this->query->union('UNION', function (& $query) use ($parameters) {
				$query = \Numbers\Internalization\Internalization\Model\Translations::queryBuilderStatic(['alias' => 'union_a'])->select();
				// columns
				$query->columns([
					'id' => 'union_a.in_translation_id',
					'i18n_id' => 'union_a.in_translation_i18n_id',
					'from_text' => 'union_a.in_translation_from_text',
					'to_text' => 'union_a.in_translation_to_text'
				]);
				// join
				$query->join('INNER', new \Numbers\Internalization\Internalization\Model\Translation\Organizations(), 'union_b', 'ON', [
					['AND', ['union_a.in_translation_id', '=', 'union_b.in_translorg_translation_id', true], false],
					['AND', ['union_b.in_translorg_organization_id', '=', $parameters['organization_id'], false], false]
				]);
				// where
				$query->where('AND', ['union_a.in_translation_inactive', '=', 0]);
				$query->where('AND', ['union_a.in_translation_from_language_code', '=', $parameters['from_language']]);
				$query->where('AND', ['union_a.in_translation_to_language_code', '=', $parameters['to_language']]);
				if (!empty($parameters['javascript'])) {
					$query->where('AND', ['union_a.in_translation_javascript', '=', 1]);
				}
			});
		}
	}

	public function process($data, $options = []) {
		$result = [];
		foreach ($data as $v) {
			if (!empty($v['i18n_id'])) {
				$result['i18n::id::' . $v['i18n_id']] = $v['to_text'];
			} else {
				if (strlen($v['from_text']) > 40) {
					$result[sha1($v['from_text'])] = $v['to_text'];
				} else {
					$result[$v['from_text']] = $v['to_text'];
				}
			}
		}
		return $result;
	}
}