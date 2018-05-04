<?php

namespace Numbers\Users\Organizations\Form;
class Services extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_services';
	public $module_code = 'ON';
	public $title = 'O/N Services Form';
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
		'channel_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Organizations\Model\Service\Channel\Map',
			'details_pk' => ['on_servmap_channel_id'],
			'order' => 35000
		],
	];
	public $rows = [
		'top' => [
			'on_service_id' => ['order' => 100],
			'on_service_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'channels' => ['order' => 200, 'label_name' => 'Channels'],
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		]
	];
	public $elements = [
		'top' => [
			'on_service_id' => [
				'on_service_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Service #', 'domain' => 'service_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_service_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 45, 'required' => true, 'navigation' => true],
				'on_service_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean']
			],
			'on_service_name' => [
				'on_service_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			],
			'channels' => [
				'channels' => ['container' => 'channel_container', 'order' => 100],
			]
		],
		'general_container' => [
			'on_service_organization_id' => [
				'on_service_assignment_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Assignment Type', 'domain' => 'type_id', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Assignment\Types'],
				'on_service_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			'on_service_category_id' => [
				'on_service_category_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Category', 'domain' => 'category_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Categories::optionsActive', 'options_depends' => ['on_servcategory_organization_id' => 'on_service_organization_id']],
				'on_service_icon' => ['order' => 2, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
			'on_service_type_id' => [
				'on_service_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Types'],
				'on_service_queue_type_id' => ['order' => 2, 'label_name' => 'Queue Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Types'],
			],
			'on_service_workflow_id' => [
				'on_service_workflow_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Workflow', 'domain' => 'workflow_id', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Workflows::optionsActive', 'options_params' => ['on_workflow_versioned' => 1, 'on_workflow_type_id' => 10], 'options_options' => ['i18n' => 'skip_sorting']],
			],
			'on_service_service_script_id' => [
				'on_service_service_script_id' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Service Script', 'domain' => 'service_script_id', 'null' => true, 'percent' => 75, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts::optionsActive', 'options_params' => ['on_servscript_versioned' => 1], 'options_options' => ['i18n' => 'skip_sorting']],
				'on_service_appointments' => ['order' => 2, 'label_name' => 'Appointments', 'type' => 'boolean', 'percent' => 25],
			]
		],
		'channel_container' => [
			'row1' => [
				'on_servmap_channel_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Channel', 'domain' => 'channel_id', 'null' => true, 'required' => true, 'details_unique_select' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Channels::optionsActive', 'onchange' => 'this.form.submit();'],
				'on_servmap_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Services',
		'model' => '\Numbers\Users\Organizations\Model\Services',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\Channel\Map' => [
				'name' => 'Channels',
				'pk' => ['on_servmap_tenant_id', 'on_servmap_service_id', 'on_servmap_channel_id'],
				'type' => '1M',
				'map' => ['on_service_tenant_id' => 'on_servmap_tenant_id', 'on_service_id' => 'on_servmap_service_id']
			],
		]
	];
}