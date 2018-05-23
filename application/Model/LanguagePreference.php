<?php

namespace Model;
class LanguagePreference extends \Object\Data {
	public $column_key = 'no_data_lang_pref_id';
	public $column_prefix = 'no_data_lang_pref_';
	public $columns = [
		'no_data_lang_pref_id' => ['name' => '#', 'type' => 'smallint'],
		'no_data_lang_pref_name' => ['name' => 'Name', 'type' => 'text'],
	];
	public $options_map = [
		'no_data_lang_pref_name' => 'name'
	];
	public $orderby = [
		'no_data_lang_pref_id' => SORT_ASC
	];
	public $data = [
		5 => ['no_data_lang_pref_name' => 'No Preference'],
		10 => ['no_data_lang_pref_name' => 'English'],
		20 => ['no_data_lang_pref_name' => 'Ukrainian']
	];
}