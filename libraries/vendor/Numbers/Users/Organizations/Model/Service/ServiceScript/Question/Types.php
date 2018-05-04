<?php

namespace Numbers\Users\Organizations\Model\Service\ServiceScript\Question;
class Types extends \Object\Data {
	public $column_key = 'sm_servquestype_code';
	public $column_prefix = 'sm_servquestype_';
	public $columns = [
		'sm_servquestype_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'sm_servquestype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $options_map = [
		'sm_servquestype_name' => 'name'
	];
	public $orderby = [
		'sm_servquestype_name' => SORT_ASC
	];
	public $data = [
		'input' => ['sm_servquestype_name' => 'Text (Short)'],
		'textarea' => ['sm_servquestype_name' => 'Text (Long)'],
		'boolean' => ['sm_servquestype_name' => 'Boolean'],
		'select' => ['sm_servquestype_name' => 'Select'],
		'multiselect' => ['sm_servquestype_name' => 'Select (Multiple)'],
		'checkbox' => ['sm_servquestype_name' => 'Checkboxes'],
		'radiobox' => ['sm_servquestype_name' => 'Radioboxes'],
		'information' => ['sm_servquestype_name' => 'Information'],
		// calendars
		'cal_date' => ['sm_servquestype_name' => 'Calendar Date'],
		'cal_datetime' => ['sm_servquestype_name' => 'Calendar Datetime'],
		'cal_time' => ['sm_servquestype_name' => 'Calendar Time'],
	];
}