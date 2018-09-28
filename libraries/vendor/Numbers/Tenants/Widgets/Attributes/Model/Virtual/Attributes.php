<?php

namespace Numbers\Tenants\Widgets\Attributes\Model\Virtual;
class Attributes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $name = null;
	public $pk = [];
	public $tenant = true;
	public $orderby = [
		'wg_attribute_inserted_date' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'wg_attribute_';
	public $columns = [];
	public $constraints = [];
	public $indexes = [];
	public $history = false;
	public $audit = false; // must not change it
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation; // must not change it
	public $attributes = false; // must not change it
	public $details_pk = ['wg_attribute_attribute_id'];
	public $attribute_all_fields;
	public $attribute_all_models;

	/**
	 * Constructor
	 */
	public function __construct($class, $virtual_class_name, $options = []) {
		$this->determineModelMap($class, 'attributes', $virtual_class_name, $options);
		// add regular columns
		$this->columns['wg_attribute_tenant_id'] = ['name' => 'Tenant #', 'domain' => 'tenant_id'];
		$this->columns['wg_attribute_attribute_id'] = ['name' => 'Attribute #', 'domain' => 'group_id'];
		$this->columns['wg_attribute_value'] = ['name' => 'Value', 'type' => 'json'];
		$this->columns['wg_attribute_inserted_date'] = ['name' => 'Inserted Date', 'type' => 'timestamp', 'default' => 'now()'];
		$this->pk = array_merge(array_values($this->map), ['wg_attribute_attribute_id']);
		// add constraints
		$this->constraints[$this->name . '_pk'] = [
			'type' => 'pk',
			'columns' => $this->pk
		];
		$this->constraints[$this->name . '_parent_fk'] = [
			'type' => 'fk',
			'columns' => array_values($this->map),
			'foreign_model' => $class,
			'foreign_columns' => array_keys($this->map)
		];
		$this->constraints[$this->name . '_attribute_fk'] = [
			'type' => 'fk',
			'columns' => ['wg_attribute_tenant_id', 'wg_attribute_attribute_id'],
			'foreign_model' => '\Numbers\Tenants\Widgets\Attributes\Model\Attributes',
			'foreign_columns' => ['tm_attribute_tenant_id', 'tm_attribute_id']
		];
		// construct table
		parent::__construct($options);
	}

	/**
	 * Pre-load model and fields
	 */
	public function preloadModelsAndFields() {
		// preload attributes
		if (!isset($this->attribute_all_fields)) {
			$model = new \Numbers\Tenants\Widgets\Attributes\Model\Attributes();
			$this->attribute_all_fields = $model->get([
				'pk' => ['tm_attribute_id']
			]);
		}
		// preload models
		if (!isset($this->attribute_all_models)) {
			$this->attribute_all_models = \Numbers\Backend\ABAC\DataSource\AttributesWithModels::getStatic();
		}
	}

	/**
	 * Process widget
	 *
	 * @param object $form
	 * @param array $options
	 */
	public function formProcessWidget(& $form, $options) {
		// create a container
		$new_container_link = ($options['container_link'] ?? '') . '_' . ($options['row_link'] ?? '') . '__container';
		// collection key
		if (!empty($options['details_parent_key'])) {
			$details_collection_key = ['details', $options['details_parent_key'], 'details', $this->virtual_class_name];
			$type = 'subdetails';
		} else {
			$details_collection_key = ['details', $this->virtual_class_name];
			$type = 'details';
		}
		// build a container
		$form->container($new_container_link, [
			'type' => $type,
			'label_name' => $options['label_name'] ?? '',
			'details_rendering_type' => $options['details_rendering_type'] ?? 'table',
			'details_new_rows' => $options['details_new_rows'] ?? 1,
			'details_parent_key' => $options['details_parent_key'] ?? null,
			'details_key' => $this->virtual_class_name,
			'details_pk' => $this->details_pk,
			'pk' => $this->pk,
			'details_collection_key' => $details_collection_key,
			'details_process_widget_data' => method_exists($this, 'formProcessWidgetData'),
			'details_convert_multiple_columns' => method_exists($this, 'convertMultipleColumns'),
			'order' => $options['order'] ?? 35000,
			'required' => $options['required'] ?? false
		]);
		// add elements
		$elements = [
			'row1' => [
				'wg_attribute_attribute_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Attribute', 'domain' => 'group_id', 'null' => true, 'percent' => 40, 'required' => true, 'placeholder' => 'Attribute', 'details_unique_select' => true, 'method' => 'select', 'onchange' => 'this.form.submit();', 'custom_renderer' => "{$this->virtual_class_name}::overrideFieldName"],
				'wg_attribute_value' => ['order' => 2, 'label_name' => 'Value', 'type' => 'mixed', 'required' => true, 'percent' => 60, 'custom_renderer' => "{$this->virtual_class_name}::overrideFieldValue"]
			]
		];
		foreach ($elements as $k => $v) {
			foreach ($v as $k2 => $v2) {
				$form->element($new_container_link, $k, $k2, $v2);
			}
		}
		// link containers if in tabs
		if ($options['type'] == 'tabs') {
			$form->element($options['container_link'], $options['row_link'], $options['row_link'], ['container' => $new_container_link, 'order' => 1]);
		}
		// collection
		array_key_set($form->collection, $details_collection_key, [
			'name' => 'Attributes',
			'pk' => $this->pk,
			'type' => '1M',
			'map' => $this->map,
			'attributes' => true
		]);
		$form->updateCollectionObject();
		return true;
	}

	/**
	 * Process widget data
	 *
	 * @param object $form
	 * @param array $parent_keys
	 * @param array $data
	 * @param array $parent_data
	 * @param array $fields
	 * @param array $options
	 * @return array
	 */
	public function formProcessWidgetData(& $form, $parent_keys, $data, $parent_data, $fields, $options) {
		$this->preloadModelsAndFields();
		$field_types = [];
		$result = [];
		// start processing of keys
		$detail_key_holder = [];
		$form->generateDetailsPrimaryKey($detail_key_holder, 'reset', $parent_data, $parent_keys, $options);
		foreach ($data as $k => $v) {
			// process pk
			$form->generateDetailsPrimaryKey($detail_key_holder, 'pk', $v, $parent_keys, $options);
			$error_name = $detail_key_holder['error_name'];
			$k2 = $detail_key_holder['pk'];
			// if we have no data
			if (($v['wg_attribute_attribute_id'] ?? '') == '' && ($v['wg_attribute_value'] ?? '') == '') continue;
			$id = (int) $v['wg_attribute_attribute_id'];
			if (empty($this->attribute_all_fields[$id])) {
				continue;
				//$form->error('danger', \Object\Content\Messages::INVALID_VALUES, "{$error_name}[wg_attribute_attribute_id]");
			} else {
				$field = $this->attribute_all_fields[$id];
				// process data types
				$type_options = [
					'options' => [
						'domain' => $field['tm_attribute_domain'],
						'type' => $field['tm_attribute_type'],
					]
				];
				$type_options = \Object\Data\Common::processDomainsAndTypes($type_options);
				$field_types[$id] = $type_options;
				$value = $v['wg_attribute_value'] ?? null;
				if (is_string($value)) {
					$value = trim($value, '"');
				}
				if (!is_null($value)) {
					if (in_array($field['tm_attribute_method'], ['multiselect', 'multiautocomplete'])) {
						if (is_json($value)) {
							$value = json_decode($value, true);
						}
						if (!is_array($value)) {
							$value = [$value];
						}
						foreach ($value as $k22 => $v22) {
							$temp = $form->validateDataTypesSingleValue('wg_attribute_value', $type_options, $v22, "{$error_name}[wg_attribute_value]");
							if (empty($temp['flag_error'])) {
								$value[$k22] = $temp['wg_attribute_value'];
							}
						}
					} else {
						$temp = $form->validateDataTypesSingleValue('wg_attribute_value', $type_options, $value, "{$error_name}[wg_attribute_value]");
						if (empty($temp['flag_error'])) {
							$value = $temp['wg_attribute_value'];
						}
					}
				}
			}
			// put everything back into values
			$result[$k2] = array_merge_hard($detail_key_holder['parent_pks'], [
				'wg_attribute_attribute_id' => $id,
				'wg_attribute_value' => $value
			]);
		}
		// validate required
		if (!empty($options['validate_required'])) {
			foreach ($result as $k => $v) {
				$temp = $field_types[$v['wg_attribute_attribute_id']];
				$temp['options']['values_key'] = array_merge($parent_keys, [$k, 'wg_attribute_value']);
				$temp['options']['required'] = true;
				// booleans can be empty
				if ($temp['options']['type'] != 'boolean') {
					$error_name = $form->parentKeysToErrorName($parent_keys) . "[{$k}]";
					$form->validateRequiredOneField($result[$k]['wg_attribute_value'], "{$error_name}[wg_attribute_value]", $temp);
				}
			}
		}
		// convert to json
		foreach ($result as $k => $v) {
			$result[$k]['wg_attribute_value'] = json_encode($v['wg_attribute_value']);
		}
		return $result;
	}

	/**
	 * Convert multiple column
	 *
	 * @param object $form
	 * @param mixed $values
	 */
	public function convertMultipleColumns(& $form, & $values) {
		foreach ($values as $k => $v) {
			$values[$k]['wg_attribute_value'] = json_decode($v['wg_attribute_value'], true);
		}
	}

	/**
	 * Override field name
	 *
	 * @param object $form
	 * @param array $options
	 * @param mixed $value
	 * @param array $neighbouring_values
	 */
	public function overrideFieldName(& $form, & $options, & $value, & $neighbouring_values) {
		// determine model
		$temp = explode('\0Virtual0\\', $this->virtual_class_name);
		array_pop($temp);
		$options['options']['options_model'] = '\Numbers\Tenants\Widgets\Attributes\DataSource\Attributes';
		$options['options']['options_params'] = [
			'model_name' => implode('\0Virtual0\\', $temp),
			'module_id' => \Application::$controller->module_id
		];
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		$this->preloadModelsAndFields();
		// if attribute is not set
		if (empty($neighbouring_values['wg_attribute_attribute_id']) || empty($this->attribute_all_fields[$neighbouring_values['wg_attribute_attribute_id']])) {
			$options['options']['method'] = 'span';
			$options['options']['value'] = '&nbsp;';
		} else {
			$field = $this->attribute_all_fields[$neighbouring_values['wg_attribute_attribute_id']];
			// domain and type
			$options['options']['domain'] = $field['tm_attribute_domain'];
			$options['options']['type'] = $field['tm_attribute_type'];
			$temp = \Object\Data\Common::processDomainsAndTypes(['options' => $options['options']]);
			$options['options'] = $temp['options'];
			// override options
			if ($field['tm_attribute_type'] == 'boolean') {
				$options['options']['method'] = 'checkbox';
				//$options['options']['options_model'] = '\Object\Data\Model\Inactive';
				//$options['options']['no_choose'] = true;
				if (empty($value)) $value = 0;
			} else if (in_array($field['tm_attribute_method'], ['select', 'multiselect', 'autocomplete', 'multiautocomplete'])) {
				$options['options']['method'] = $field['tm_attribute_method'];
				$options['options']['options_model'] = $this->attribute_all_models[$field['tm_attribute_abacattr_id']]['sm_model_code'];
				$options['options']['options_options']['pk'] = [$this->attribute_all_models[$field['tm_attribute_abacattr_id']]['sm_abacattr_code']];
				$options['options']['placeholder'] = $this->attribute_all_models[$field['tm_attribute_abacattr_id']]['sm_model_name'];
				$options['options']['searchable'] = true;
			} else { // custom field
				// date types
				if (in_array($field['tm_attribute_type'], ['date', 'datetime', 'time', 'timestamp'])) {
					$options['options']['method'] = 'calendar';
					$options['options']['calendar_type'] = $field['tm_attribute_type'];
					$options['options']['calendar_icon'] = 'right';
				} else {
					$options['options']['method'] = 'input';
				}
			}
		}
	}
}