<?php

namespace Numbers\Users\Organizations\Form\Service\Workflow;
class Fields extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_workflow_fields';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Fields Form';
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
			'on_workfield_id' => ['order' => 100],
			'on_workfield_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_workfield_id' => [
				'on_workfield_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Field #', 'domain' => 'field_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_workfield_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_workfield_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_workfield_name' => [
				'on_workfield_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_workfield_icon' => [
				'on_workfield_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
			'on_workfield_model_id' => [
				'on_workfield_model_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Model', 'domain' => 'group_id', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Backend\Db\Common\Model\Models', 'options_params' => ['sm_model_relation_enabled' => 1], 'onchange' => 'this.form.submit();']
			],
			'on_workfield_method' => [
				'on_workfield_method' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Method', 'domain' => 'code', 'percent' => 33, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Widgets\Attributes\Model\Methods'],
				'on_workfield_domain' => ['order' => 2, 'label_name' => 'Domain', 'domain' => 'code', 'null' => true, 'percent' => 33, 'method' => 'select', 'searchable' => true, 'options_model' => '\Object\Data\Domains::optionsNoSequences', 'onchange' => 'this.form.submit();'],
				'on_workfield_type' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'code', 'percent' => 34, 'required' => true, 'method' => 'select', 'searchable' => true, 'options_model' => '\Object\Data\Types']
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Workflow Fields',
		'model' => '\Numbers\Users\Organizations\Model\Service\Workflow\Fields'
	];

	public function refresh(& $form) {
		if (!empty($form->values['on_workfield_model_id'])) {
			$model = \Numbers\Backend\Db\Common\Model\Models::getStatic([
				'where' => [
					'sm_model_id' => $form->values['on_workfield_model_id'],
					'sm_model_relation_enabled' => 1
				],
				'single_row' => true,
				'no_cache' => true
			]);
			$form->values['on_workfield_domain'] = $model['sm_model_relation_domain'];
			$form->values['on_workfield_type'] = $model['sm_model_relation_type'];
		} else {
			// if we have domain we preset type
			if (!empty($form->values['on_workfield_domain'])) {
				$domains = \Object\Data\Domains::getStatic();
				$form->values['on_workfield_type'] = $domains[$form->values['on_workfield_domain']]['type'];
			}
		}
	}

	public function validate(& $form) {
		// if we have domain we preset type
		if (!empty($form->values['on_workfield_domain'])) {
			$domains = \Object\Data\Domains::getStatic();
			$form->values['on_workfield_type'] = $domains[$form->values['on_workfield_domain']]['type'];
		}
		if (!$form->hasErrors()) {
			if (!empty($form->values['on_workfield_model_id'])) {
				$model = \Numbers\Backend\Db\Common\Model\Models::getStatic([
					'where' => [
						'sm_model_id' => $form->values['on_workfield_model_id'],
						'sm_model_relation_enabled' => 1
					],
					'single_row' => true,
					'no_cache' => true
				]);
				$form->values['on_workfield_domain'] = $model['sm_model_relation_domain'];
				$form->values['on_workfield_type'] = $model['sm_model_relation_type'];
				// method
				if (!in_array($form->values['on_workfield_method'], ['select', 'multiselect', 'autocomplete', 'multiautocomplete'])) {
					$form->error('danger', 'You can only have Select(s) and Autocomplete(s) if model is selected!', 'on_workfield_method');
				}
			} else {
				// method
				if (!in_array($form->values['on_workfield_method'], ['input', 'boolean'])) {
					$form->error('danger', 'You can only have Input and Boolean!', 'on_workfield_method');
				}
			}
			// update type
			$types = \Object\Data\Types::getStatic();
			$form->values['on_workfield_php_type'] = $types[$form->values['on_workfield_type']]['php_type'];
		}
	}
}