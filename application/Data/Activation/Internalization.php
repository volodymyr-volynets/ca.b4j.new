<?php

namespace Data\Activation;
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
		'timezones' => [
			'options' => [
				'pk' => ['in_timezone_tenant_id', 'in_timezone_code'],
				'model' => '\Numbers\Internalization\Internalization\Model\Timezones',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'in_timezone_tenant_id' => null,
					'in_timezone_code' => 'America/Toronto',
					'in_timezone_name' => 'America/Toronto',
					'in_timezone_inactive' => 0
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
		],
		'periods' => [
			'options' => [
				'pk' => ['b4_period_tenant_id', 'b4_period_code'],
				'model' => '\Model\Periods',
				'method' => 'save_insert_new'
			],
			'data' => [
				[
					'b4_period_tenant_id' => null,
					'b4_period_code' => 'B4JTEST',
					'b4_period_name' => 'Break for Jesus -  Test',
					'b4_period_start_date' => '2018-01-11 8:00:00',
					'b4_period_end_date' => '2018-12-31 23:00:00',
					'b4_period_camp_start_date' => '2019-03-10 17:00:00',
					'b4_period_camp_end_date' => '2019-03-16 10:00:00',
					'b4_period_additional_info_date' => '2018-11-18',
					'b4_period_counselor_start_date' => '2018-10-08 00:00:00',
					'b4_period_counselor_end_date' => '2018-11-15 23:59:59',
					'b4_period_counselor_accepted_date' => '2018-12-15',
					'b4_period_training_start_date' => '2019-03-09 08:00:00',
					'b4_period_current' => null,
					'b4_period_inactive' => 0
				],
				[
					'b4_period_tenant_id' => null,
					'b4_period_code' => 'B4J2019',
					'b4_period_name' => 'Break for Jesus - 2019',
					'b4_period_start_date' => '2018-11-11 14:00:00',
					'b4_period_end_date' => '2018-12-11 14:00:00',
					'b4_period_camp_start_date' => '2019-03-10 17:00:00',
					'b4_period_camp_end_date' => '2019-03-16 10:00:00',
					'b4_period_additional_info_date' => '2018-11-18',
					'b4_period_counselor_start_date' => '2018-10-08 00:00:00',
					'b4_period_counselor_end_date' => '2018-11-15 23:59:59',
					'b4_period_counselor_accepted_date' => '2018-12-15',
					'b4_period_training_start_date' => '2019-03-09 08:00:00',
					'b4_period_current' => 1,
					'b4_period_inactive' => 0
				],
				[
					'b4_period_tenant_id' => null,
					'b4_period_code' => 'B4J2019-VOL',
					'b4_period_name' => 'Break for Jesus - 2019 (Volunteer)',
					'b4_period_start_date' => '2018-11-10 00:00:00',
					'b4_period_end_date' => '2018-12-11 14:00:00',
					'b4_period_camp_start_date' => '2019-03-10 17:00:00',
					'b4_period_camp_end_date' => '2019-03-16 10:00:00',
					'b4_period_additional_info_date' => '2018-11-18',
					'b4_period_counselor_start_date' => '2018-10-08 00:00:00',
					'b4_period_counselor_end_date' => '2018-11-15 23:59:59',
					'b4_period_counselor_accepted_date' => '2018-12-15',
					'b4_period_training_start_date' => '2019-03-09 08:00:00',
					'b4_period_current' => null,
					'b4_period_inactive' => 0
				],
			]
		]
	];
}