<?php

namespace Numbers\Users\Organizations\Form;
class Districts extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_districts';
	public $module_code = 'ON';
	public $title = 'O/N Districts Form';
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
			'on_district_id' => ['order' => 100],
			'on_district_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_district_id' => [
				'on_district_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'District #', 'domain' => 'district_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_district_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_district_name' => [
				'on_district_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_district_organization_id' => [
				'on_district_organization_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
				'on_district_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Districts',
		'model' => '\Numbers\Users\Organizations\Model\Districts'
	];
}