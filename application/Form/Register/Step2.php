<?php

namespace Form\Register;
class Step2 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step2';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 2 Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'customer_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'address_container' => ['default_row_type' => 'grid', 'order' => 32001]
	];
	public $rows = [
		'tabs' => [
			'customer' => ['order' => 100, 'label_name' => 'Customer'],
			'address' => ['order' => 200, 'label_name' => 'Address'],
		]
	];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'__wizard_step' => ['label_name' => 'Wizzard Step', 'domain' => 'type_id', 'null' => true, 'method' => 'hidden'],
				'b4_register_id' => ['label_name' => 'Register #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden'],
			]
		],
		'tabs' => [
			'customer' => [
				'customer' => ['container' => 'customer_container', 'order' => 100],
			],
			'address' => [
				'address' => ['container' => 'address_container', 'order' => 100],
			],
		],
		'customer_container' => [
			'om_order_type_id' => [
				'om_order_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'percent' => 20, 'required' => true, 'no_choose' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Types'],
				'om_order_company' => ['order' => 2, 'label_name' => 'Company', 'domain' => 'name', 'null' => true, 'percent' => 80, 'required' => 'c'],
			],
			'om_order_title' => [
				'om_order_title' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Title', 'domain' => 'personal_title', 'null' => true, 'percent' => 20, 'required' => false, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Titles::optionsActive'],
				'om_order_first_name' => ['order' => 2, 'label_name' => 'First Name', 'domain' => 'personal_name', 'null' => true, 'percent' => 40, 'required' => 'c'],
				'om_order_last_name' => ['order' => 3, 'label_name' => 'Last Name', 'domain' => 'personal_name', 'null' => true, 'percent' => 40, 'required' => 'c'],
			],
			'separator_1' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 400, 'label_name' => 'Contact Information', 'icon' => 'far fa-envelope', 'percent' => 100],
			],
			'om_order_email' => [
				'om_order_email' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Email', 'domain' => 'email', 'null' => true, 'percent' => 100, 'required' => 'c'],
			],
			'om_order_phone' => [
				'om_order_phone' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Primary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => 'c'],
				'om_order_cell' => ['order' => 2, 'label_name' => 'Cell Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50],
			],
		],
		'address_container' => [
			'row1' => [
				'om_order_address1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Address Line 1', 'domain' => 'name', 'required' => true],
				'om_order_address2' => ['order' => 2, 'label_name' => 'Address Line 2', 'domain' => 'name', 'null' => true],
			],
			'row2' => [
				'om_order_city' => ['order' => 1, 'row_order' => 200, 'label_name' => 'City', 'domain' => 'name', 'required' => true],
				'om_order_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'required' => true, 'onblur' => 'this.form.submit();'],
			],
			'row3' => [
				'om_order_country_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'om_order_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'om_order_country_code']],
			]
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_CONTINUE => self::BUTTON_CONTINUE_DATA
			]
		]
	];
	public $collection = [
		'name' => 'B4 Register',
		'readonly' => true,
		'model' => '\Model\Register',
	];

	public function refresh(& $form) {
		$form->options['actions']['back'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=1&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 2;
		// preload data
		if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
			\Object\Table\Complementary::jsonPreloadData(
				new \Model\Register(),
				[
					'b4_register_id' => $form->values['b4_register_id']
				],
				['b4_register_step2', 'b4_register_step1'],
				$form->values
			);
		}
	}

	public function validate(& $form) {
		
	}

	public function save(& $form) {
		// write data
		return \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 2,
				'b4_register_step2' => json_encode($form->values)
			],
			$form,
			'b4_register_id'
		);
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=3&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}