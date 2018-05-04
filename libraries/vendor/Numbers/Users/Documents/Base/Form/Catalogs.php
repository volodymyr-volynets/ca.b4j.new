<?php

namespace Numbers\Users\Documents\Base\Form;
class Catalogs extends \Object\Form\Wrapper\Base {
	public $form_link = 'dt_catalogs';
	public $module_code = 'DT';
	public $title = 'D/T Catalogs Form';
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
			'dt_catalog_code' => [
				'dt_catalog_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'group_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'dt_catalog_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'dt_catalog_name' => [
				'dt_catalog_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'dt_catalog_storage_id' => [
				'dt_catalog_storage_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Storage', 'domain' => 'type_id', 'persistent' => 'if_set', 'required' => true, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Documents\Base\Model\Storages'],
				'dt_catalog_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'persistent' => 'if_set', 'required' => true, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			],
			'dt_catalog_readonly' => [
				'dt_catalog_readonly' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Readonly', 'type' => 'boolean', 'percent' => 25],
				'dt_catalog_temporary' => ['order' => 2, 'label_name' => 'Temporary', 'type' => 'boolean', 'percent' => 25],
				'dt_catalog_primary' => ['order' => 3, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 25],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Catalogs',
		'model' => '\Numbers\Users\Documents\Base\Model\Catalogs'
	];

	public function validate(& $form) {
		if (!empty($form->values['dt_catalog_primary'])) {
			$primary = \Numbers\Users\Documents\Base\Model\Catalogs::getStatic([
				'where' => [
					'dt_catalog_organization_id' => $form->values['dt_catalog_organization_id'],
					'dt_catalog_primary' => 1,
				],
				'pk' => ['dt_catalog_code']
			]);
			unset($primary[$form->values['dt_catalog_code']]);
			if (!empty($primary)) {
				$form->error(DANGER, 'Only one catalog can be primary!', 'dt_catalog_primary');
			}
		}
	}
}