<?php

namespace Numbers\Internalization\Internalization\Form;
class Locales extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_locales';
	public $module_code = 'IN';
	public $title = 'I/N Locales Form';
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
			'in_locale_code' => [
				'in_locale_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'locale_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'in_locale_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'in_locale_name' => [
				'in_locale_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Locales',
		'model' => '\Numbers\Internalization\Internalization\Model\Locales'
	];

	public function validate(& $form) {
		// we need to see if new locale is valid
		if (!empty($form->values['in_locale_code'])) {
			$current_locale = setlocale(LC_ALL, 0);
			$new_locale = setlocale(LC_ALL, $form->values['in_locale_code']);
			if ($new_locale != $form->values['in_locale_code']) {
				$form->error('danger', 'Provided locale is not supported!', 'in_locale_code');
			}
			setlocale(LC_ALL, $current_locale);
		}
	}
}