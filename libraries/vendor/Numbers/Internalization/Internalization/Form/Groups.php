<?php

namespace Numbers\Internalization\Internalization\Form;
class Groups extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_groups';
	public $module_code = 'IN';
	public $title = 'I/N Groups Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'in_group_id' => [
				'in_group_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Group #', 'domain' => 'group_id_sequence', 'percent' => 95, 'required' => false, 'navigation' => true],
				'in_group_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'in_group_name' => [
				'in_group_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'in_group_language_code' => [
				'in_group_language_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Language', 'domain' => 'language_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_group_locale_code' => ['order' => 2, 'label_name' => 'Locale', 'domain' => 'locale_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Locales'],
			],
			'in_group_timezone_code' => [
				'in_group_timezone_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Timezone', 'domain' => 'timezone_code', 'percent' => 50, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Timezones'],
				'in_group_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations'],
			],
			'format' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 500, 'label_name' => 'Format', 'icon' => 'far fa-hourglass', 'percent' => 100],
			],
			'in_group_format_date' => [
				'in_group_format_date' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Date Format', 'domain' => 'code', 'percent' => 25, 'required' => true, 'method' => 'select', 'preset' => true, 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::presets', 'options_options' => ['columns' => 'in_group_format_date'], 'description' => 'Y - year, m - month, d - day'],
				'in_group_format_time' => ['order' => 2, 'label_name' => 'Time Format', 'domain' => 'code', 'percent' => 25, 'required' => true, 'method' => 'select', 'preset' => true, 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::presets', 'options_options' => ['columns' => 'in_group_format_time'], 'description' => 'H - hour, i - minute, s = second, g - short hour, a - am/pm'],
				'in_group_format_datetime' => ['order' => 3, 'label_name' => 'Datetime Format', 'domain' => 'code', 'percent' => 25, 'required' => true, 'method' => 'select', 'preset' => true, 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::presets', 'options_options' => ['columns' => 'in_group_format_datetime'], 'description' => 'Y - year, m - month, d - day, H - hour, i - minute, s = second, g - short hour, a - am/pm'],
				'in_group_format_timestamp' => ['order' => 4, 'label_name' => 'Timestamp Format', 'domain' => 'code', 'percent' => 25, 'required' => true, 'method' => 'select', 'preset' => true, 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::presets', 'options_options' => ['columns' => 'in_group_format_timestamp'], 'description' => 'Y - year, m - month, d - day, H - hour, i - minute, s = second, g - short hour, a - am/pm, u - miliseconds']
			],
			'in_group_format_uom' => [
				'in_group_format_uom' => ['order' => 1, 'row_order' => 650, 'label_name' => 'Unit of Measures', 'domain' => 'group_code', 'default' => 'METRIC', 'required' => true, 'method' => 'select', 'options_model' => '\Object\Format\UoM']
			],
			'in_group_format_amount_frm' => [
				'in_group_format_amount_frm' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Amounts In Forms', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Object\Format\Amounts'],
				'in_group_format_amount_fs' => ['order' => 2, 'label_name' => 'Amounts In Financial Statement', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Object\Format\Amounts']
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Groups',
		'model' => '\Numbers\Internalization\Internalization\Model\Groups'
	];
}