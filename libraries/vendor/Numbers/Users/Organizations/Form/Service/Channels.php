<?php

namespace Numbers\Users\Organizations\Form\Service;
class Channels extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_service_channels';
	public $module_code = 'ON';
	public $title = 'O/N Service Channels Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [
		'top' => [
			'on_servchannel_id' => ['order' => 100],
			'on_servchannel_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_servchannel_id' => [
				'on_servchannel_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Channel #', 'domain' => 'channel_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_servchannel_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_servchannel_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_servchannel_name' => [
				'on_servchannel_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_servchannel_icon' => [
				'on_servchannel_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Types'],
				'on_servchannel_icon' => ['order' => 2, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Channels',
		'model' => '\Numbers\Users\Organizations\Model\Service\Channels'
	];
}