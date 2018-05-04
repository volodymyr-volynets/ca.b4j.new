<?php

namespace Numbers\Users\Users\Form\System;
class Senders extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_senders';
	public $module_code = 'UM';
	public $title = 'U/M System Senders Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\Message\Sender\Organizations',
			'details_pk' => ['um_senderorg_organization_id'],
			'order' => 800
		],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'um_sendercmn_from_email' => [
				'um_sendercmn_from_email' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sender Email', 'domain' => 'email', 'percent' => 50, 'required' => true],
				'um_sendercmn_from_name' => ['order' => 2, 'label_name' => 'Sender Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
			]
		],
		'organizations_container' => [
			'row1' => [
				'um_senderorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_senderorg_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'um_senderorg_from_email' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Sender Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => true],
				'um_senderorg_from_name' => ['order' => 2, 'label_name' => 'Sender Name', 'domain' => 'name', 'null' => true, 'percent' => 50, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];
	public $collection = [
		'model' => '\Numbers\Users\Users\Model\Message\Sender\Common',
		'details' => [
			'\Numbers\Users\Users\Model\Message\Sender\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['um_senderorg_tenant_id', 'um_senderorg_organization_id'],
				'type' => '1M',
				'map' => ['um_sendercmn_tenant_id' => 'um_senderorg_tenant_id']
			]
		]
	];
}