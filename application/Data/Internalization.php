<?php

namespace Data;
class Internalization extends \Object\Import {
	public $data = [
		'language_codes' => [
			'options' => [
				'pk' => ['in_language_tenant_id', 'in_language_code'],
				'model' => '\Numbers\Internalization\Internalization\Model\Language\Codes',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'in_language_tenant_id' => null,
					'in_language_code' => 'ukr',
					'in_language_code2' => 'uk',
					'in_language_name' => 'Ukrainian',
					'in_language_native_name' => 'Українська',
					'in_language_rtl' => 0,
					'in_language_family_name' => 'East Slavic',
					'in_language_inactive' => 0
				]
			]
		],
		'locales' => [
			'options' => [
				'pk' => ['in_locale_tenant_id', 'in_locale_code'],
				'model' => '\Numbers\Internalization\Internalization\Model\Locales',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'in_locale_tenant_id' => null,
					'in_locale_code' => 'uk_UA.UTF-8',
					'in_locale_name' => 'uk_UA.UTF-8',
					'in_locale_inactive' => 0
				]
			]
		],
		'groups' => [
			'options' => [
				'pk' => ['in_group_tenant_id', 'in_group_name'],
				'model' => '\Numbers\Internalization\Internalization\Model\Groups',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'in_group_tenant_id' => null,
					'in_group_name' => 'Ukrainian',
					'in_group_language_code' => 'ukr',
					'in_group_locale_code' => 'uk_UA.UTF-8',
					'in_group_timezone_code' => 'America/Toronto',
					'in_group_organization_id' => null,
					'in_group_inactive' => 0,
					'in_group_format_date' => 'm/d/Y',
					'in_group_format_time' => 'g:i:s a',
					'in_group_format_datetime' => 'm/d/Y g:i:s a',
					'in_group_format_timestamp' => 'm/d/Y g:i:s.u a',
					'in_group_format_amount_frm' => 10,
					'in_group_format_amount_fs' => 30
				]
			]
		]
	];
}