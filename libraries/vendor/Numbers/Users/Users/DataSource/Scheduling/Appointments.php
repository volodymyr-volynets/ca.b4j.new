<?php

namespace Numbers\Users\Users\DataSource\Scheduling;
class Appointments extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_schedinterval_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [];
	public $options_active = [];
	public $column_prefix = '';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Users\Model\Scheduling\Intervals';
	public $parameters = [
		'selected_organizations' => ['name' => 'Selected Organizations', 'domain' => 'organization_id', 'multiple_column' => true, 'required' => true],
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'service_id' => ['name' => 'Service', 'domain' => 'service_id', 'multiple_column' => true, 'required' => true],
		'location_id' => ['name' => 'Location', 'domain' => 'location_id', 'multiple_column' => true, 'required' => true],
		'user_id' => ['name' => 'User', 'domain' => 'user_id', 'multiple_column' => true, 'required' => true],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'um_schedinterval_id' => 'MIN(a.um_schedinterval_id)',
			'um_schedinterval_work_starts' => 'a.um_schedinterval_work_starts'
		]);
		$this->query->where('AND', function(& $query) use ($parameters) {
			if (!empty($parameters['existing_values'])) {
				$query->where('OR', ['a.um_schedinterval_id', '=', $parameters['existing_values']]);
			}
			$query->where('OR', function(& $query) use ($parameters) {
				$query->where('AND', ['a.um_schedinterval_type_id', '=', 3000]);
				$query->where('AND', ['a.um_schedinterval_organization_id', '=', $parameters['selected_organizations']]);
				$query->where('AND', ['a.um_schedinterval_location_id', '=', $parameters['location_id']]);
				$query->where('AND', ['a.um_schedinterval_service_id', '=', $parameters['service_id']]);
				$query->where('AND', ['a.um_schedinterval_user_id', '=', $parameters['user_id']]);
				$query->where('AND', ['a.um_schedinterval_work_starts', '>', \Format::now('timestamp')]);
			});
		});
		$this->query->groupby(['um_schedinterval_work_starts']);
		$this->query->orderby(['um_schedinterval_work_starts' => SORT_ASC]);
	}

	/**
	 * @see $this->options()
	 */
	public function optionsGroupped(array $options = []) {
		$options['options_map'] = [
			'um_schedinterval_id' => 'name',
			'um_schedinterval_work_starts' => 'start_date'
		];
		$options['i18n'] = 'skip_sorting';
		$result = $this->options($options);
		if (!empty($result)) {
			$week_days = \Numbers\Users\Users\Model\Scheduling\Interval\WeekDays::optionsStatic();
			$result2 = $result;
			foreach ($result as $k => $v) {
				$date = new \DateTime($v['start_date']);
				$parent = \Format::date($v['start_date']);
				$result2[$parent] = ['name' => \Format::date($v['start_date']) . \Format::$symbol_semicolon . ' ' . i18n(null, $week_days[(int) $date->format('N')]['name']), 'disabled' => true, 'parent' => null];
				$result2[$k]['name'] = \Format::time($v['start_date']);
				$result2[$k]['__selected_name'] = \Format::datetime($v['start_date']);
				$result2[$k]['parent'] = $parent;
			}
			$converted = \Helper\Tree::convertByParent($result2, 'parent');
			$result = [];
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name', 'i18n' => 'skip_sorting'], $result);
		}
		return $result;
	}
}