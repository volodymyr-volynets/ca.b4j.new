<?php

namespace Form\Register;
class Step1 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step1';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 1 Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'b4_registration_period_code' => [
				'b4_registration_period_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'code', 'null' => true, 'percent' => 100, 'required' => true, 'validator_method' => '\Object\Validator\UpperCase::validate'],
			],
			'b4_registration_in_group_id' => [
				'b4_registration_in_group_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Language', 'domain' => 'group_id', 'placeholder' => 'Language', 'null' => true, 'default' => NUMBERS_FLAG_GLOBAL___IN_GROUP_ID ?? NUMBERS_FLAG_GLOBAL_I18N_GROUP_ID, 'required' => true, 'percent' => 100, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::optionsActive', 'onchange' => 'this.form.submit();'],
			],
			self::HIDDEN => [
				'b4_register_id' => ['label_name' => 'Register #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden', 'validate_through_session' => true],
				'b4_registration_period_id' => ['label_name' => 'Period #', 'domain' => 'group_id', 'null' => true, 'method' => 'hidden'],
				'__wizard_step' => ['label_name' => 'Wizzard Step', 'domain' => 'type_id', 'null' => true, 'method' => 'hidden']
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

	public $tmp_period_dates = '';

	public function refresh(& $form) {
		// change language
		if (in_array($form->misc_settings['__form_onchange_field_values_key'][0] ?? '', ['b4_registration_in_group_id'])) {
			if (!empty($form->values['b4_registration_in_group_id'])) {
				\I18n::changeGroup($form->values['b4_registration_in_group_id']);
			}
		}
		$form->values['__wizard_step'] = 1;
		// preload data
		if (empty($form->is_ajax_reload)) {
			if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
				\Object\Table\Complementary::jsonPreloadData(
					new \Model\Register(),
					[
						'b4_register_id' => $form->values['b4_register_id']
					],
					['b4_register_step1'],
					$form->values
				);
			}
		}
	}

	public function validate(& $form) {
		// code must be present and with valid period
		if (!empty($form->values['b4_registration_period_code'])) {
			$period = \Model\Periods::getStatic([
				'where' => [
					'b4_period_code' => $form->values['b4_registration_period_code']
				],
				'pk' => null
			]);
			if (empty($period[0])) {
				$form->error(DANGER, \Helper\Messages::INVALID_CODE, 'b4_registration_period_code');
				return;
			} else {
				if (!\Helper\Date::between(\Format::now('datetime'), $period[0]['b4_period_start_date'], $period[0]['b4_period_end_date'])) {
					$form->error(DANGER,  \Helper\Messages::NO_LONGER_ACCEPT_REGISTRATIONS, 'b4_registration_period_code');
					return;
				}
				if (!empty($period[0]['b4_period_max_registrations']) && $period[0]['b4_period_confirmed_registrations'] > $period[0]['b4_period_max_registrations']) {
					$form->error(DANGER, \Helper\Messages::NO_LONGER_ACCEPT_REGISTRATIONS, 'b4_registration_period_code');
					return;
				}
			}
			$this->tmp_period_dates = \Format::date($period[0]['b4_period_camp_start_date']) . ' - ' . \Format::date($period[0]['b4_period_camp_end_date']);
			$form->values['b4_registration_period_id'] = $period[0]['b4_period_id'];
		}
	}

	public function save(& $form) {
		// write data
		$model = new \Model\Periods();
		$model->db_object->begin();
		$result = \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 1,
				'b4_register_step1' => json_encode($form->values),
				'b4_register_period' => $this->tmp_period_dates,
				'b4_register_period_id' => $form->values['b4_registration_period_id'],
			],
			$form,
			'b4_register_id'
		);
		// update counter
		if ($result) {
			\Model\Periods::queryBuilderStatic()->update()->set(['b4_period_new_registrations;=;~~' => 'b4_period_new_registrations + 1'])->where('AND', ['b4_period_id', '=', $form->values['b4_registration_period_id']])->query();
			$model->db_object->commit();
		} else {
			$model->db_object->rollback();
		}
		return $result;
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}