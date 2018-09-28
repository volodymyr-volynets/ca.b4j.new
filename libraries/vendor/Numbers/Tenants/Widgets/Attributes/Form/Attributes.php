<?php

namespace Numbers\Tenants\Widgets\Attributes\Form;
class Attributes extends \Object\Form\Wrapper\Base {
	public $form_link = 'tm_attributes';
	public $module_code = 'TM';
	public $title = 'T/M Attributes Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'modules_models_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Tenants\Widgets\Attributes\Model\Attribute\Details',
			'details_pk' => ['tm_attrdetail_module_id', 'tm_attrdetail_model_id'],
			'required' => true,
			'order' => 33000
		],
	];
	public $rows = [
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'modules_models' => ['order' => 200, 'label_name' => 'Module / Models'],
		]
	];
	public $elements = [
		'top' => [
			'tm_attribute_id' => [
				'tm_attribute_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Attribute #', 'domain' => 'attribute_id_sequence', 'percent' => 45, 'navigation' => true],
				'tm_attribute_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'required' => true, 'percent' => 50, 'navigation' => true],
				'tm_attribute_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'tm_attribute_name' => [
				'tm_attribute_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100]
			],
			'modules_models' => [
				'modules_models' => ['container' => 'modules_models_container', 'order' => 100],
			]
		],
		'general_container' => [
			'tm_attribute_abacattr_id' => [
				'tm_attribute_abacattr_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'ABAC Attribute', 'domain' => 'attribute_id', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Backend\ABAC\Model\Attributes::optionsActive', 'options_params' => ['sm_abacattr_flag_attribute' => 1], 'onchange' => 'this.form.submit();']
			],
			'tm_attribute_method' => [
				'tm_attribute_method' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Method', 'domain' => 'code', 'percent' => 33, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Widgets\Attributes\Model\Methods'],
				'tm_attribute_domain' => ['order' => 2, 'label_name' => 'Domain', 'domain' => 'code', 'null' => true, 'percent' => 33, 'method' => 'select', 'searchable' => true, 'options_model' => '\Object\Data\Domains::optionsNoSequences', 'onchange' => 'this.form.submit();'],
				'tm_attribute_type' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'code', 'percent' => 34, 'required' => true, 'method' => 'select', 'searchable' => true, 'options_model' => '\Object\Data\Types::optionsNoSequences']
			]
		],
		'modules_models_container' => [
			'row1' => [
				'tm_attrdetail_model_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Module / Model', 'domain' => 'model_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Widgets\Attributes\DataSource\Models::optionsJson', 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'tm_attrdetail_module_id', 'model_id' => 'tm_attrdetail_model_id']],
				'tm_attrdetail_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'tm_attrdetail_module_id' => ['order' => 2, 'label_name' => 'Module #', 'domain' => 'module_id', 'required' => true, 'null' => true, 'method' => 'hidden'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Attributes',
		'model' => '\Numbers\Tenants\Widgets\Attributes\Model\Attributes',
		'details' => [
			'\Numbers\Tenants\Widgets\Attributes\Model\Attribute\Details' => [
				'name' => 'Details',
				'pk' => ['tm_attrdetail_tenant_id', 'tm_attrdetail_attribute_id', 'tm_attrdetail_module_id', 'tm_attrdetail_model_id'],
				'type' => '1M',
				'map' => ['tm_attribute_tenant_id' => 'tm_attrdetail_tenant_id', 'tm_attribute_id' => 'tm_attrdetail_attribute_id']
			]
		]
	];

	public function refresh(& $form) {
		if (!empty($form->values['tm_attribute_abacattr_id'])) {
			$model = \Numbers\Backend\ABAC\Model\Attributes::getStatic([
				'where' => [
					'sm_abacattr_id' => $form->values['tm_attribute_abacattr_id'],
					'sm_abacattr_flag_attribute' => 1
				],
				'single_row' => true,
				'no_cache' => true
			]);
			$form->values['tm_attribute_domain'] = $model['sm_abacattr_domain'];
			$form->values['tm_attribute_type'] = $model['sm_abacattr_type'];
		} else {
			// if we have domain we preset type
			if (!empty($form->values['tm_attribute_domain'])) {
				$domains = \Object\Data\Domains::getStatic();
				$form->values['tm_attribute_type'] = $domains[$form->values['tm_attribute_domain']]['type'];
			}
		}
	}

	public function validate(& $form) {
		// if we have domain we preset type
		if (!empty($form->values['tm_attribute_domain'])) {
			$domains = \Object\Data\Domains::getStatic();
			$form->values['tm_attribute_type'] = $domains[$form->values['tm_attribute_domain']]['type'];
		}
		if (!$form->hasErrors()) {
			if (!empty($form->values['tm_attribute_abacattr_id'])) {
				$model = \Numbers\Backend\ABAC\Model\Attributes::getStatic([
					'where' => [
						'sm_abacattr_id' => $form->values['tm_attribute_abacattr_id'],
						'sm_abacattr_flag_attribute' => 1
					],
					'single_row' => true,
					'no_cache' => true
				]);
				$form->values['tm_attribute_domain'] = $model['sm_abacattr_domain'];
				$form->values['tm_attribute_type'] = $model['sm_abacattr_type'];
				// method
				if (!in_array($form->values['tm_attribute_method'], ['select', 'multiselect', 'autocomplete', 'multiautocomplete'])) {
					$form->error('danger', 'You can only have Select(s) and Autocomplete(s) if model is selected!', 'tm_attribute_method');
				}
			} else {
				// method
				if (!in_array($form->values['tm_attribute_method'], ['input', 'boolean'])) {
					$form->error('danger', 'You can only have Text and Boolean!', 'tm_attribute_method');
				}
			}
		}
	}
}