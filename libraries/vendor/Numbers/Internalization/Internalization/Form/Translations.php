<?php

namespace Numbers\Internalization\Internalization\Form;
class Translations extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_translations';
	public $module_code = 'IN';
	public $title = 'I/N Translations Form';
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
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 3,
			'details_key' => '\Numbers\Internalization\Internalization\Model\Translation\Organizations',
			'details_pk' => ['in_translorg_organization_id'],
			'required' => false,
			'order' => 35000
		]
	];
	public $rows = [
		'top' => [
			'in_translation_id' => ['order' => 100]
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'organizations' => ['order' => 150, 'label_name' => 'Organizations']
		]
	];
	public $elements = [
		'top' => [
			'in_translation_id' => [
				'in_translation_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 95, 'required' => false, 'navigation' => true],
				'in_translation_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100],
			]
		],
		'general_container' => [
			'in_translation_from_language_code' => [
				'in_translation_from_language_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'From Language', 'domain' => 'language_code', 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translation_from_text' => ['order' => 2, 'label_name' => 'From Text', 'type' => 'varchar', 'length' => 2500, 'method' => 'textarea', 'required' => true, 'percent' => 75],
			],
			'in_translation_to_language_code' => [
				'in_translation_to_language_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'To Language', 'domain' => 'language_code', 'required' => true, 'percent' => 25, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translation_to_text' => ['order' => 2, 'label_name' => 'To Text', 'type' => 'varchar', 'length' => 2500, 'method' => 'textarea', 'required' => true, 'percent' => 75],
			],
			'in_translation_i18n_id' => [
				'in_translation_i18n_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'I18n #', 'domain' => 'group_id', 'null' => true, 'percent' => 50],
				'in_translation_javascript' => ['order' => 2, 'label_name' => 'Javascript', 'type' => 'boolean', 'percent' => 50],
			]
		],
		'organizations_container' => [
			'row1' => [
				'in_translorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'in_translorg_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Translations',
		'model' => '\Numbers\Internalization\Internalization\Model\Translations',
		'details' => [
			'\Numbers\Internalization\Internalization\Model\Translation\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['in_translorg_tenant_id', 'in_translorg_translation_id', 'in_translorg_organization_id'],
				'type' => '1M',
				'map' => ['in_translation_tenant_id' => 'in_translorg_tenant_id', 'in_translation_id' => 'in_translorg_translation_id']
			]
		]
	];

	public function finalize(& $form) {
		// remove translation from missing
		if (!$form->hasErrors()) {
			$query = \Numbers\Internalization\Internalization\Model\Translation\Missing::queryBuilderStatic()->delete();
			$query->whereMultiple('AND', [
				'in_translmiss_from_language_code' => $form->values['in_translation_from_language_code'],
				'in_translmiss_from_text' => $form->values['in_translation_from_text'],
				'in_translmiss_to_language_code' => $form->values['in_translation_to_language_code']
			]);
			$query->query();
		}
	}
}