<?php

namespace Numbers\Users\Organizations\Form\Service;
class ServiceScripts extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_service_scripts';
	public $module_code = 'ON';
	public $title = 'O/N Service Scripts Form';
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
		'questions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'details_pk' => ['on_servquestion_id'],
			'details_autoincrement' => ['on_servquestion_id'],
			'required' => true,
			'order' => 34000
		],
		'description_container' => [
			'label_name' => 'Description',
			'type' => 'subdetails',
			'details_11' => true,
			'details_rendering_type' => 'grid_with_label',
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Description',
			'details_pk' => ['on_servquesdesc_question_id'],
			'order' => 34000
		],
		'answers_container' => [
			'label_name' => 'Answers',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 2,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers',
			'details_pk' => ['on_servquesanswer_name'],
			'order' => 34000
		],
		'channels_container' => [
			'label_name' => 'Channels',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Channels',
			'details_pk' => ['on_servqueschan_channel_id'],
			'order' => 34000
		],
		'regions_container' => [
			'label_name' => 'Regions',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'details_key' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Regions',
			'details_pk' => ['on_servquesregion_region_id'],
			'order' => 34001
		]
	];

	public $rows = [
		'top' => [
			'on_servscript_id' => ['order' => 100],
			'on_servscript_name' => ['order' => 200],
		],
		'tabs' => [
			'questions' => ['order' => 200, 'label_name' => 'Questions'],
		]
	];
	public $elements = [
		'top' => [
			'on_servscript_id' => [
				'on_servscript_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Service Script #', 'domain' => 'service_script_id_sequence', 'percent' => 50, 'required' => false, 'navigation' => true],
				'on_servscript_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 45, 'navigation' => true],
				'on_servscript_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_servscript_name' => [
				'on_servscript_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			self::HIDDEN => [
				'on_servscript_versioned' => ['label_name' => 'Versioned', 'type' => 'boolean', 'method' => 'hidden'],
				'on_servscript_version_service_script_id' => ['label_name' => 'Version Service Script', 'domain' => 'service_script_id', 'null' => true, 'method' => 'hidden'],
				'on_servscript_version_code' => ['label_name' => 'Version Code', 'domain' => 'version_code', 'null' => true, 'method' => 'hidden'],
				'on_servscript_version_name' => ['label_name' => 'Version Name', 'domain' => 'name', 'null' => true, 'method' => 'hidden'],
			]
		],
		'tabs' => [
			'questions' => [
				'questions' => ['container' => 'questions_container', 'order' => 100],
			],
		],
		'questions_container' => [
			'row1' => [
				'on_servquestion_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Question', 'domain' => 'name', 'null' => true, 'required' => true, 'placeholder' => 'Question', 'percent' => 95],
				'on_servquestion_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'on_servquestion_order' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Order', 'domain' => 'order', 'null' => true, 'required' => true, 'percent' => 25],
				'on_servquestion_type_code' => ['order' => 2, 'label_name' => 'Type', 'domain' => 'type_code', 'null' => true, 'required' => true, 'percent' => 30, 'validator_method' => '', 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Types', 'onchange' => 'this.form.submit();'],
				'on_servquestion_required' => ['order' => 3, 'label_name' => 'Required', 'type' => 'boolean', 'percent' => 15],
				'on_servquestion_all_regions' => ['order' => 4, 'label_name' => 'All Regions', 'type' => 'boolean', 'default' => 1, 'percent' => 15, 'onchange' => 'this.form.submit();'],
				'on_servquestion_all_channels' => ['order' => 5, 'label_name' => 'All Channels', 'type' => 'boolean', 'default' => 1, 'percent' => 15, 'onchange' => 'this.form.submit();'],
			],
			'row3' => [
				'on_servquestion_model_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Model', 'domain' => 'group_id', 'null' => true, 'required' => 'c', 'percent' => 100, 'placeholder' => 'Model', 'method' => 'select', 'options_model' => '\Numbers\Backend\Db\Common\Model\Models', 'options_params' => ['sm_model_relation_enabled' => 1], 'onchange' => 'this.form.submit();']
			],
			self::HIDDEN => [
				'on_servquestion_id' => ['label_name' => 'Question #', 'domain' => 'question_id', 'method' => 'hidden'],
			]
		],
		'description_container' => [
			'row1' => [
				'on_servquesdesc_description' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Description', 'domain' => 'description', 'null' => true, 'required' => 'c', 'percent' => 100, 'method' => 'wysiwyg'],
			],
		],
		'answers_container' => [
			'row1' => [
				'on_servquesanswer_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Answer', 'domain' => 'name', 'null' => true, 'placeholder' => 'Answer', 'onblur' => 'this.form.submit();'],
			]
		],
		'channels_container' => [
			'row1' => [
				'on_servqueschan_channel_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Channel', 'domain' => 'channel_id', 'null' => true, 'percent' => 85, 'details_unique_select' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Channels::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_servqueschan_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			]
		],
		'regions_container' => [
			'row1' => [
				'on_servquesregion_region_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Region', 'domain' => 'region_id', 'null' => true, 'percent' => 85, 'details_unique_select' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Regions::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_servquesregion_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Service Scripts',
		'model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions' => [
				'name' => 'Service Script Questions',
				'pk' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id'],
				'type' => '1M',
				'map' => ['on_servscript_tenant_id' => 'on_servquestion_tenant_id', 'on_servscript_id' => 'on_servquestion_service_script_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers' => [
						'name' => 'Service Script Answers',
						'pk' => ['on_servquesanswer_tenant_id', 'on_servquesanswer_service_script_id', 'on_servquesanswer_question_id', 'on_servquesanswer_name'],
						'type' => '1M',
						'map' => ['on_servquestion_tenant_id' => 'on_servquesanswer_tenant_id', 'on_servquestion_service_script_id' => 'on_servquesanswer_service_script_id', 'on_servquestion_id' => 'on_servquesanswer_question_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Description' => [
						'name' => 'Service Script Description',
						'pk' => ['on_servquesdesc_tenant_id', 'on_servquesdesc_service_script_id', 'on_servquesdesc_question_id'],
						'type' => '11',
						'map' => ['on_servquestion_tenant_id' => 'on_servquesdesc_tenant_id', 'on_servquestion_service_script_id' => 'on_servquesdesc_service_script_id', 'on_servquestion_id' => 'on_servquesdesc_question_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Channels' => [
						'name' => 'Service Script Channels',
						'pk' => ['on_servqueschan_tenant_id', 'on_servqueschan_service_script_id', 'on_servqueschan_question_id', 'on_servqueschan_channel_id'],
						'type' => '1M',
						'map' => ['on_servquestion_tenant_id' => 'on_servqueschan_tenant_id', 'on_servquestion_service_script_id' => 'on_servqueschan_service_script_id', 'on_servquestion_id' => 'on_servqueschan_question_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Regions' => [
						'name' => 'Service Script Regions',
						'pk' => ['on_servquesregion_tenant_id', 'on_servquesregion_service_script_id', 'on_servquesregion_question_id', 'on_servquesregion_region_id'],
						'type' => '1M',
						'map' => ['on_servquestion_tenant_id' => 'on_servquesregion_tenant_id', 'on_servquestion_service_script_id' => 'on_servquesregion_service_script_id', 'on_servquestion_id' => 'on_servquesregion_question_id'],
					]
				]
			]
		]
	];

	public function validate(& $form) {
		// validate questions
		foreach ($form->values['\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions'] as $k => $v) {
			// informtion must have description
			if ($v['on_servquestion_type_code'] == 'information') {
				if (empty($v['\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Description']['on_servquesdesc_description'])) {
					$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions[{$k}][\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Description][on_servquesdesc_description]");
				}
			}
			// selects must have answers or model
			if ($v['on_servquestion_type_code'] == 'select' || $v['on_servquestion_type_code'] == 'multiselect') {
				if (empty($v['on_servquestion_model_id']) && empty($v['\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers'])) {
					$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions[{$k}][on_servquestion_model_id]");
					$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions[{$k}][\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers][1][on_servquesanswer_name]");
				}
			}
		}
	}

	public function refresh(& $form) {
		if (!empty($form->values['on_servscript_versioned'])) {
			$form->misc_settings['global']['readonly'] = true;
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'on_servquestion_model_id') {
			if (!in_array($neighbouring_values['on_servquestion_type_code'] ?? '', ['select', 'multiselect'])) {
				$options['options']['row_class'] = 'grid_row_hidden';
			}
		}
	}

	public function overrideTabs(& $form, & $tab_options, & $tab_name, & $neighbouring_values = []) {
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Answers') {
			if (in_array($neighbouring_values['on_servquestion_type_code'] ?? '', ['information', 'input', 'textarea', 'boolean', 'calendar_date', 'calendar_datetime', 'calendar_time'])) {
				return ['hidden' => true];
			}
		}
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Channels') {
			if (!empty($neighbouring_values['on_servquestion_all_channels'])) {
				return ['hidden' => true];
			}
		}
		if ($tab_name == '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Regions') {
			if (!empty($neighbouring_values['on_servquestion_all_regions'])) {
				return ['hidden' => true];
			}
		}
	}
}