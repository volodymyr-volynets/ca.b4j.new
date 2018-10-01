<?php

namespace Form\Medical;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'b4_medical_collection';
	const GLOBAL_WIZARD = [
		'model' => '\Object\Form\Wrapper\Wizard',
		'options' => [
			'segment' => null,
			'percent' => 100,
			'wizard' => [
				'type' => 'primary',
				'options' => [
					1 => ['name' => 'Medical'],
					2 => ['name' => 'Emergency Contact'],
					3 => ['name' => 'T-Shirt'],
					4 => ['name' => 'Complete']
				]
			]
		],
		'order' => 1
	];
	const GLOBAL_OPTIONS = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'fab fa-firstdraft'],
				'title' => 'Medical and additional information:'
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
						'medical_step1' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_medical_step1' => [
							'model' => '\Form\Medical\Step1',
							'bypass_values' => ['__wizard_step', 'b4_registration_id'],
							'options' => [
								'segment' => null,
								'percent' => 100,
								'bypass_hidden_from_input' => ['token']
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
						'medical_step2' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_medical_step2' => [
							'model' => '\Form\Medical\Step2',
							'bypass_values' => ['__wizard_step', 'b4_registration_id'],
							'options' => [
								'segment' => null,
								'percent' => 100,
								'bypass_hidden_from_input' => ['token']
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
						'medical_step3' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_medical_step3' => [
							'model' => '\Form\Medical\Step3',
							'bypass_values' => ['__wizard_step', 'b4_registration_id'],
							'options' => [
								'segment' => null,
								'percent' => 100,
								'bypass_hidden_from_input' => ['token']
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step4' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2001,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'medical_step4' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_medical_step4' => [
							'model' => '\Form\Medical\Step4',
							'options' => [
								'segment' => null,
								'percent' => 100,
							],
							'order' => 1
						]
					]
				]
			]
		],
	];

	public function distribute() {
		$this->values['__wizard_step'] = (int) ($this->values['__wizard_step'] ?? 1);
		if (empty($this->values['__wizard_step'])) $this->values['__wizard_step'] = 1;
		$this->collection_screen_link = 'step' . $this->values['__wizard_step'];
		// make everything look success
		if ($this->values['__wizard_step'] == 4) {
			$this->data['step4'][$this::ROWS][self::HEADER_ROW][$this::FORMS]['medical_step4']['options']['wizard']['type'] = 'success';
			$this->data['step4']['options']['segment']['type'] = 'success';
		}
	}
}