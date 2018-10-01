<?php

namespace Numbers\Tenants\Tenants\Form\Activation;
class ResetFeature extends \Object\Form\Wrapper\Base {
	public $form_link = 'tm_feature_reset';
	public $module_code = 'TM';
	public $title = 'T/M Reset Features Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'cog'],
				'title' => 'Reset Feature:'
			]
		],
		'actions' => [
			'refresh' => true,
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'default' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'default' => [
			'module_id' => [
				'module_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Module', 'domain' => 'module_id', 'percent' => 100, 'required' => true, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\DataSource\Activation\Feature\Modules', 'onchange' => 'this.form.submit();'],
			],
			'feature_code' => [
				'feature_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Feature', 'domain' => 'feature_code', 'percent' => 100, 'required' => true, 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\DataSource\Activation\Feature\Features', 'options_params' => ['flag_have_reset_model' => true], 'options_depends' => ['tm_feature_module_id' => 'module_id']],
			],
			'reactivate' => [
				'delete' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Type "delete" to confirm.', 'type' => 'varchar', 'length' => 6, 'percent' => 50, 'required' => true, 'empty_value' => true],
				'reactivate' => ['order' => 2, 'label_name' => 'Reactivate', 'type' => 'boolean', 'percent' => 50],
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function validate(& $form) {
		if ($form->values['delete'] != 'delete') {
			$form->error(DANGER, 'You must type "delete"!', 'delete');
		}
	}

	public function save(& $form) {
		// need to disable debug
		\Application::set('debug.debug', 0);
		// execution limit is 1 hour
		set_time_limit(3600);
		$feature_model = new \Numbers\Backend\System\Modules\Model\Module\Features();
		$feature = $feature_model->get([
		    'where' => [
			'sm_feature_code' => $form->values['feature_code']
		    ],
		    'pk' => null,
		    'single_row' => true
		]);
		//module_code
		$reset_class = $feature['sm_feature_reset_model'];
		$model = new $reset_class($feature_model->db_link, $form->values['module_id'], [
			'module_code' => $feature['sm_feature_module_code'],
			'feature_code' => $form->values['feature_code'],
			'activation_model' => (!empty($form->values['reactivate']) ? $feature['sm_feature_activation_model'] : null),
		]);
		$result = $model->process();
		if ($result['success']) {
			$form->error(SUCCESS, 'Feature has been reset!');
			return true;
		} else {
			$form->error(DANGER, $result['error']);
			return false;
		}
	}
}