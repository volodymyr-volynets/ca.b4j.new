<?php

namespace Numbers\Users\Users\Form\Registration\Tenant;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'um_tenant_registration_collection';
	const GLOBAL_WIZARD = [
		'model' => '\Object\Form\Wrapper\Wizard',
		'options' => [
			'segment' => null,
			'percent' => 100,
			'wizard' => [
				'type' => 'primary',
				'options' => [
					1 => ['name' => 'Fill Out The Form'],
					2 => ['name' => 'Email Confirmation'],
					3 => ['name' => 'Set Password'],
					4 => ['name' => 'Registration Complete']
				]
			]
		],
		'order' => 1
	];
	const GLOBAL_OPTIONS = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'pencil-square-o'],
				'title' => 'Register New Tenant:'
			]
		]
	];
	public $data = [
		'step1' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 1000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'tenant_registration_step1_wizzard' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'tenant_registration_step1' => [
							'model' => '\Numbers\Users\Users\Form\Registration\Tenant\Step1',
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step2' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'tenant_registration_step2_wizzard' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'tenant_registration_step2' => [
							'model' => '\Numbers\Users\Users\Form\Registration\Tenant\Step2',
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step3' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'tenant_registration_step2_wizzard' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'tenant_registration_step3' => [
							'model' => '\Numbers\Users\Users\Form\Registration\Tenant\Step3',
							'bypass_input' => ['__wizard_step', 'token'],
							'options' => [
								'segment' => null,
								'percent' => 100,
								'bypass_hidden_from_input' => ['__wizard_step', 'token']
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step4' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'tenant_registration_step4_wizzard' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'tenant_registration_step4' => [
							'model' => '\Numbers\Users\Users\Form\Registration\Tenant\Step4',
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		]
	];

	public function distribute() {
		$this->values['__wizard_step'] = (int) ($this->values['__wizard_step'] ?? 1);
		if (empty($this->values['__wizard_step'])) $this->values['__wizard_step'] = 1;
		$this->collection_screen_link = 'step' . $this->values['__wizard_step'];
		// make everything look success
		if ($this->values['__wizard_step'] == 4) {
			$this->data['step4'][$this::ROWS][self::HEADER_ROW][$this::FORMS]['tenant_registration_step4_wizzard']['options']['wizard']['type'] = 'success';
			$this->data['step4']['options']['segment']['type'] = 'success';
		}
	}
}