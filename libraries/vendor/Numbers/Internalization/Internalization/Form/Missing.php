<?php

namespace Numbers\Internalization\Internalization\Form;
class Missing extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_missing';
	public $module_code = 'IN';
	public $title = 'I/N Missing Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'general_container' => ['default_row_type' => 'grid', 'order' => 500],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [
		'top' => [
			'in_translmiss_id' => ['order' => 100]
		]
	];
	public $elements = [
		'top' => [
			'in_translmiss_id' => [
				'in_translmiss_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Missing #', 'domain' => 'big_id_sequence', 'percent' => 95, 'required' => false, 'navigation' => true],
				'in_translmiss_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'general_container' => [
			'in_translmiss_from_language_code' => [
				'in_translmiss_from_language_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'From Language', 'domain' => 'language_code', 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translmiss_to_language_code' => ['order' => 2, 'label_name' => 'To Language', 'domain' => 'language_code', 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
			],
			'in_translmiss_from_text' => [
				'in_translmiss_from_text' => ['order' => 1, 'row_order' => 300, 'label_name' => 'From Text', 'type' => 'varchar', 'length' => 2500, 'method' => 'textarea', 'required' => true, 'percent' => 100]
			],
			'in_translmiss_javascript' => [
				'in_translmiss_organization_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations'],
				'in_translmiss_javascript' => ['order' => 2, 'label_name' => 'Javascript', 'type' => 'boolean', 'percent' => 50],
			],
			'url' => [
				'url' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Create Translation', 'custom_renderer' => 'Numbers\Internalization\Internalization\Form\Missing::renderLink'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'model' => '\Numbers\Internalization\Internalization\Model\Translation\Missing',
	];

	public function renderLink(& $form, & $options, & $value, & $neighbouring_values) {
		$params = [
			'in_translation_from_language_code' => $form->values['in_translmiss_from_language_code'],
			'in_translation_from_text' => $form->values['in_translmiss_from_text'],
			'in_translation_to_language_code' => $form->values['in_translmiss_to_language_code'],
			'in_translation_to_text' => '',
			'in_translation_javascript' => $form->values['in_translmiss_javascript'],
			'\Numbers\Internalization\Internalization\Model\Translation\Organizations' => [
				1 => [
					'in_translorg_organization_id' => $form->values['in_translmiss_organization_id']
				]
			]
		];
		return '<a class="form-control form-control-no-border" href="/Numbers/Internalization/Internalization/Controller/Translations/_Edit?' . http_build_query2($params) . '">Click to Create Translation</a>';
	}
}