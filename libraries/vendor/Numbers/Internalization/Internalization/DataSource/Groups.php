<?php

namespace Numbers\Internalization\Internalization\DataSource;
class Groups extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['group_id'];
	public $tenant = true;
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'group_name' => 'name'
	];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Internalization\Internalization\Model\Groups';
	public $parameters = [];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'group_id' => 'a.in_group_id',
			'group_name' => 'a.in_group_name',
			'language_code' => 'a.in_group_language_code',
			'locale_code' => 'a.in_group_locale_code',
			'timezone_code' => 'a.in_group_timezone_code',
			'organization_id' => 'a.in_group_organization_id',
			'format_date' => 'a.in_group_format_date',
			'format_time' => 'a.in_group_format_time',
			'format_datetime' => 'a.in_group_format_datetime',
			'format_timestamp' => 'a.in_group_format_timestamp',
			'format_amount_frm' => 'a.in_group_format_amount_frm',
			'format_amount_fs' => 'a.in_group_format_amount_fs',
			'format_uom' => 'a.in_group_format_uom',
			'rtl' => 'b.in_language_rtl'
		]);
		// join
		$this->query->join('INNER', new \Numbers\Internalization\Internalization\Model\Language\Codes(), 'b', 'ON', [
			['AND', ['a.in_group_language_code', '=', 'b.in_language_code', true], false]
		]);
		// where
		$this->query->where('AND', ['a.in_group_inactive', '=', 0]);
	}
}