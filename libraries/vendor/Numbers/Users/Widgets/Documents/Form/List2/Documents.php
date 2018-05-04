<?php

namespace Numbers\Users\Widgets\Documents\Form\List2;
class Documents extends \Object\Form\Wrapper\List2 {
	public $form_link = 'wg_documents';
	public $module_code = 'UM';
	public $title = 'U/M Documents List';
	public $options = [
		'segment' => null,
		'actions' => [
			'refresh' => true,
			'new' => ['onclick' => 'Numbers.Modal.show(\'form_wg_documents_modal_new_file_dialog\');', 'href' => 'javascript:void(0);', 'action_code' => 'Record_Add_Document'],
			'filter_sort' => ['value' => 'Filter/Sort', 'sort' => 32000, 'icon' => 'fas fa-filter', 'onclick' => 'Numbers.Form.listFilterSortToggle(this);']
		]
	];
	public $containers = [
		'tabs' => ['default_row_type' => 'grid', 'order' => 1000, 'type' => 'tabs', 'class' => 'numbers_form_filter_sort_container'],
		'filter' => ['default_row_type' => 'grid', 'order' => 1500],
		'sort' => self::LIST_SORT_CONTAINER,
		'new_file' => [
			'default_row_type' => 'grid',
			'order' => 32200,
			'type' => 'modal',
			'label_name' => 'Add new file'
		],
		self::LIST_CONTAINER => ['default_row_type' => 'grid', 'order' => PHP_INT_MAX],
	];
	public $rows = [
		'tabs' => [
			'sort' => ['order' => 200, 'label_name' => 'Sort'],
		]
	];
	public $elements = [
		'tabs' => [
			'sort' => [
				'sort' => ['container' => 'sort', 'order' => 100]
			]
		],
		'sort' => [
			'__sort' => [
				'__sort' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sort', 'domain' => 'code', 'details_unique_select' => true, 'percent' => 50, 'null' => true, 'method' => 'select', 'options' => self::LIST_SORT_OPTIONS, 'onchange' => 'this.form.submit();'],
				'__order' => ['order' => 2, 'label_name' => 'Order', 'type' => 'smallint', 'default' => SORT_ASC, 'percent' => 50, 'null' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Object\Data\Model\Order', 'onchange' => 'this.form.submit();'],
			]
		],
		'new_file' => [
			'new_file_catalog_code' => [
				'new_file_catalog_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Catalog', 'domain' => 'group_code', 'null' => true, 'percent' => 100, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Users\Documents\Base\Model\Catalogs::optionsActive']
			],
			'new_fileimportant' => [
				'new_file_important' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Important', 'type' => 'boolean', 'method' => 'checkbox', 'percent' => 50],
				'new_file_upload_1' => ['order' => 2, 'label_name' => 'File', 'type' => 'mixed', 'percent' => 50, 'required' => 'c', 'method' => 'file', 'validator_method' => '\Numbers\Users\Documents\Base\Validator\Files::validate', 'validator_params' => ['types' => ['images', 'audio', 'documents']], 'description' => 'Extensions: Images, Audio, Documents'],
			],
			'buttons' => [
				self::BUTTON_SUBMIT_OTHER => self::BUTTON_SUBMIT_OTHER_DATA + ['row_order' => 32000],
			]
		],
		self::LIST_BUTTONS => self::LIST_BUTTONS_DATA,
		self::LIST_CONTAINER => [
			'row1' => [
				'wg_document_id' => ['order' => 1, 'label_name' => '#', 'domain' => 'big_id', 'percent' => 10],
				'wg_document_important' => ['order' => 2, 'label_name' => 'Important', 'type' => 'boolean', 'percent' => 10],
				'wg_document_inserted_timestamp' => ['order' => 3, 'label_name' => 'Datetime', 'type' => 'timestamp', 'percent' => 10, 'format' => '\Format::niceTimestamp'],
				'wg_document_inserted_user_id' => ['order' => 4, 'label_name' => 'User', 'domain' => 'user_id', 'percent' => 15, 'options_model' => '\Numbers\Users\Users\Model\Users'],
				'wg_document_file_id' => ['order' => 5, 'label_name' => 'Document', 'domain' => 'file_id', 'percent' => 55, 'custom_renderer' => '\Numbers\Users\Widgets\Documents\Form\List2\Documents::renderDocumentField'],
			]
		]
	];
	public $query_primary_model;
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 10,
		'default_sort' => [
			'wg_document_id' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
		'wg_document_id' => ['name' => 'Document #'],
	];

	public function overrides(& $form) {
		if (!empty($form->__options['model_table'])) {
			$model = new $form->__options['model_table']();
			$form->collection = [
				'name' => 'Documents',
				'model' => $model->documents_model
			];
		}
	}

	public function validate(& $form) {
		// if we have new comment
		if (!empty($form->process_submit[self::BUTTON_SUBMIT_OTHER])) {
			if (empty($form->values['new_file_upload_1'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'new_file_upload_1');
			}
			if (empty($form->values['new_file_catalog_code'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, 'new_file_catalog_code');
			}
			if ($form->hasErrors()) return;
			// continue with logic
			$data = [];
			$model = new $form->options['model_table']();
			$model->db_object->begin();
			foreach ($model->documents['map'] as $k => $v) {
				if (isset($form->options['input'][$k])) {
					$data[$v] = (int) $form->options['input'][$k];
				}
			}
			// add file
			$form->values['new_file_upload_1']['__image_properties'] = $form->fields['new_file_upload_1']['options']['validator_params'] ?? [];
			$upload_model = new \Numbers\Users\Documents\Base\Base();
			// add file
			$catalog = $upload_model->fetchPrimaryCatalog(\User::get('organization_id'));
			if (empty($catalog)) {
				$form->error(DANGER, 'You must set primary catalog!');
				$model->db_object->rollback();
				return;
			}
			$result = $upload_model->upload($form->values['new_file_upload_1'], $catalog);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				$model->db_object->rollback();
				return;
			}
			$data['wg_document_catalog_code'] = $form->values['new_file_catalog_code'];
			$data['wg_document_file_id'] = $result['file_id'];
			$data['wg_document_important'] = !empty($form->values['new_file_important']) ? 1 : 0;
			$documents_result = \Factory::model($model->documents_model)->merge($data);
			if (!$documents_result['success']) {
				$form->error(DANGER, $documents_result['error']);
				$model->db_object->rollback();
				return;
			}
			$form->values['new_file_important'] = 0;
			$model->db_object->commit();
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		// hide module #
		if (in_array($options['options']['field_name'], ['__module_id', '__separator__module_id', '__format'])) {
			$options['options']['row_class'] = 'grid_row_hidden';
		}
	}

	public function listQuery(& $form) {
		$result = [
			'success' => false,
			'error' => [],
			'total' => 0,
			'rows' => []
		];
		$form->query = \Factory::model($form->options['model_table'] . '\0Virtual0\Widgets\Documents')->queryBuilder()->select();
		$form->processReportQueryFilter($form->query);
		// additional filter
		$parent_model = \Factory::model($form->options['model_table']);
		if (!empty($parent_model->documents['map'])) {
			foreach ($parent_model->documents['map'] as $k => $v) {
				if (isset($form->options['input'][$k])) {
					$form->query->where('AND', ['a.' . $v, '=', (int) $form->options['input'][$k]]);
				}
			}
		}
		// query #1 get counter
		$counter_query = clone $form->query;
		$counter_query->columns(['counter' => 'COUNT(*)'], ['empty_existing' => true]);
		$temp = $counter_query->query();
		if (!$temp['success']) {
			array_merge3($result['error'], $temp['error']);
			return $result;
		}
		$result['total'] = $temp['rows'][0]['counter'];
		// query #2 get rows
		$form->processListQueryOrderBy();
		$form->query->offset($form->values['__offset'] ?? 0);
		$form->query->limit($form->values['__limit']);
		$temp = $form->query->query();
		if (!$temp['success']) {
			array_merge3($result['error'], $temp['error']);
			return $result;
		}
		$result['rows'] = & $temp['rows'];
		$result['success'] = true;
		return $result;
	}

	public function renderDocumentField(& $form, & $options, & $value, & $neighbouring_values) {
		$result = '';
		if ($value) {
			$file = \Numbers\Users\Documents\Base\Model\Files::getStatic([
				'where' => [
					'dt_file_id' => $value
				],
				'pk' => null
			]);
			if (in_array($file[0]['dt_file_extension'], \Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['images'])) {
				$result.= '<div>' . \HTML::img(['src' => \Numbers\Users\Documents\Base\Base::generateURL($value)]) . '</div>';
			} else if (in_array($file[0]['dt_file_extension'], \Numbers\Users\Documents\Base\Helper\Validate::$validation_extensions['audio'])) {
				$result.= \HTML::audio(['src' => \Numbers\Users\Documents\Base\Base::generateURL($value), 'mime' => $file[0]['dt_file_mime']]);
			} else {
				$result.= \HTML::a(['href' => \Numbers\Users\Documents\Base\Base::generateURL($value), 'value' => i18n(null, 'Download')]);
			}
		}
		return $result;
	}
}