<?php

namespace Numbers\Users\Users\Form\Account;
class Calendar extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_account_calendar';
	public $module_code = 'UM';
	public $title = 'U/M Account Calendar Form';
	public $options = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'fas fa-calendar-alt'],
				'title' => 'View Calendar:'
			]
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 1000],
		'calendar' => ['default_row_type' => 'grid', 'order' => 2000, 'custom_renderer' => '\Numbers\Users\Users\Form\Account\Calendar::renderCalendar']
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'panel' => [
				'today' => ['order' => 1, 'row_order' => 100, 'label_name' => null, 'percent' => 20, 'class' => 'btn-block', 'value' => 'Today', 'method' => 'button2'],
				'previous' => ['order' => 2, 'label_name' => null, 'percent' => 5, 'class' => 'btn-block', 'value' => '', 'icon' => 'fas fa-arrow-alt-circle-left', 'method' => 'button2', 'type' => 'info'],
				'next' => ['order' => 3, 'label_name' => null, 'percent' => 5, 'class' => 'btn-block', 'value' => '', 'icon' => 'fas fa-arrow-alt-circle-right', 'method' => 'button2', 'type' => 'info'],
				'dates' => ['order' => 4, 'label_name' => null, 'percent' => 55, 'method' => 'div'],
				'date_hidden' => ['order' => 5, 'label_name' => null, 'type' => 'date', 'method' => 'hidden'],
				'date1' => ['order' => 5, 'label_name' => null, 'type' => 'date', 'method' => 'hidden'],
				'date2' => ['order' => 5, 'label_name' => null, 'type' => 'date', 'method' => 'hidden'],
				'select' => ['order' => 6, 'label_name' => null, 'domain' => 'type_id', 'default' => 20, 'percent' => 20, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Users\Users\Controller\Account\Calendar\Types', 'options_options' => ['i18n' => 'skip_sorting'], 'onchange' => 'this.form.submit();'],
			],
			'search' => [
				// todo add layers
				'search' => ['order' => 1, 'row_order' => 200, 'label_name' => null, 'percent' => 85, 'placeholder' => 'Search', 'method' => 'input'],
				'submit' => ['order' => 2, 'label_name' => null, 'percent' => 15, 'value' => 'Submit', 'method' => 'button2', 'class' => 'btn-block'],
			]
		]
	];

	public function refresh(& $form) {
		if (empty($form->values['date_hidden']) || !empty($form->values['today'])) {
			$form->values['date_hidden'] = \Format::now('date');
		}
		$dates = '';
		switch ($form->values['select']) {
			case 10: // day
				if ($form->values['previous']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('-1 day');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				if ($form->values['next']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('+1 day');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				$dates = \Format::date($form->values['date_hidden']);
				$form->values['date1'] = $form->values['date2'] = $form->values['date_hidden'];
				break;
			case 30: // month
				if ($form->values['previous']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('-1 month');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				if ($form->values['next']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('+1 month');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				$date1 = new \DateTime($form->values['date_hidden']);
				$date1->modify('first day of this month');
				$form->values['date1'] = $date1->format('Y-m-d');
				$date2 = new \DateTime($form->values['date_hidden']);
				$date2->modify('last day of this month');
				$form->values['date2'] = $date2->format('Y-m-d');
				$dates = \Format::date($date1) . ' &mdash; ' . \Format::date($date2);
				break;
			case 40: // year
			case 50: // schedule
				if ($form->values['previous']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('-1 year');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				if ($form->values['next']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('+1 year');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				$date1 = new \DateTime($form->values['date_hidden']);
				$date1->modify('first day of this month');
				$form->values['date1'] = $date1->format('Y-m-d');
				$date2 = new \DateTime($form->values['date_hidden']);
				$date2->modify('last day of this month next year');
				$form->values['date2'] = $date2->format('Y-m-d');
				$dates = \Format::date($date1) . ' &mdash; ' . \Format::date($date2);
				break;
			case 20: // week
			default:
				if ($form->values['previous']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('-1 week');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				if ($form->values['next']) {
					$date1 = new \DateTime($form->values['date_hidden']);
					$date1->modify('+1 week');
					$form->values['date_hidden'] = $date1->format('Y-m-d');
				}
				$date1 = new \DateTime($form->values['date_hidden']);
				if ($date1->format('N') == 7) {
					$date1->modify('this Sunday');
				} else {
					$date1->modify('last Sunday');
				}
				$form->values['date1'] = $date1->format('Y-m-d');
				$date2 = new \DateTime($form->values['date_hidden']);
				$date2->modify('next Saturday');
				$form->values['date2'] = $date2->format('Y-m-d');
				$dates = \Format::date($date1) . ' &mdash; ' . \Format::date($date2);
		}
		$form->values['dates'] = '<h4>' . $dates . '</h4>';
	}

	/**
	 * Render calendar
	 *
	 * @param object $form
	 * @return string
	 */
	public function renderCalendar(& $form) {
		// load data
		$query = \Numbers\Users\Users\Model\Scheduling\Intervals::queryBuilderStatic()->select();
		$query->where('AND', ['um_schedinterval_user_id', '=', \User::id()]);
		$query->where('AND', function (& $query) use (& $form) {
			$query->where('AND', [$query->db_object->cast('a.um_schedinterval_work_starts', 'date'), '<=', $form->values['date2']]);
			$query->where('AND', [$query->db_object->cast('a.um_schedinterval_work_ends', 'date'), '>=', $form->values['date1']]);
		});
		$query->where('AND', ['um_schedinterval_inactive', '=', 0]);
		$query->orderby(['um_schedinterval_work_starts' => SORT_ASC, 'um_schedinterval_work_ends' => SORT_ASC, 'um_schedinterval_name' => SORT_ASC, 'um_schedinterval_hash_name' => SORT_ASC]);
		$data = $query->query();
		// load holidays
		$query = \Numbers\Users\Users\Model\Scheduling\Holidays::queryBuilderStatic()->select();
		$query->where('AND', function (& $query) use (& $form) {
			$query->where('AND', ['a.um_schedholi_date', '<=', $form->values['date2']]);
			$query->where('AND', ['a.um_schedholi_date', '>=', $form->values['date1']]);
		});
		$query->where('AND', ['um_schedholi_inactive', '=', 0]);
		$holidays = $query->query();
		// render
		\Layout::addCss('/numbers/media_submodules/Numbers_Users_Users_Media_CSS_Base.css', 10000);
		switch ($form->values['select']) {
			case 20: // week
				return $this->renderWeek($form, $data['rows'], $holidays['rows']);
			case 30: // month
				return $this->renderMonth($form, $data['rows'], $holidays['rows']);
			default:
				Throw new \Exception('Type?');
		}
	}

	/**
	 * Render schedule
	 *
	 * @param object $form
	 * @param array $data
	 * @param array $holidays
	 * @return string
	 */
	private function renderMonth(& $form, $data, $holidays) {
		$result = '';
		$result.= '<table class="numbers_account_calendar_holder" width="100%">';
		$week_days = \Numbers\Users\Users\Model\Scheduling\Interval\WeekDays2::getStatic();
		$date1 = new \DateTime($form->values['date1']);
		$date2 = clone $date1;
		$date1->modify('last Sunday');
		$date2->modify('first day of next month');
		$next_month = $date2->format('Y-m-d');
		$now = \Format::now('date');
		// rearrange
		$data_arranged = [
			'holidays' => [],
			'multiple_days' => [],
			'single_day' => []
		];
		$data_slot_counter = 0;
		$data_slot_lock = [];
		foreach ($holidays as $k => $v) {
			$name = $v['um_schedholi_name'];
			if (strpos($name, ' - ') !== false) {
				$temp = explode(' - ', $name);
				$name = array_pop($temp);
			}
			$v['slot_name'] = $name;
			$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($name);
			$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
			$data_arranged['holidays'][$v['um_schedholi_date']][$k] = $v;
		}
		foreach ($data as $k => $v) {
			$date1a = new \DateTime(\Format::readDate($v['um_schedinterval_work_starts'], 'datetime'));
			$date2a = new \DateTime(\Format::readDate($v['um_schedinterval_work_ends'], 'datetime'));
			// multi days intervals
			if ($date1a->format('Y-m-d') != $date2a->format('Y-m-d')) {
				$data_slot_counter++;
				while ($date1a->format('Y-m-d') != $date2a->format('Y-m-d')) {
					$v['slot_counter'] = $data_slot_counter;
					$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($v['um_schedinterval_name']);
					$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
					$data_arranged['multiple_days'][$date1a->format('Y-m-d')][$data_slot_counter] = $v;
					$date1a->modify('+1 day');
				}
			} else { // single day intervals
				$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($v['um_schedinterval_name']);
				$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
				$data_arranged['single_day'][$date1a->format('Y-m-d')][$k] = $v;
			}
		}
		for ($i = 1; $i <= 6; $i++) {
			$result.= '<tr>';
				foreach ($week_days as $k => $v) {
					if ($date1->format('Y-m-d') == $now) {
						$result.= '<td class="numbers_account_calendar_td numbers_account_calendar_month_cell numbers_account_calendar_current">';
					} else {
						$result.= '<td class="numbers_account_calendar_td numbers_account_calendar_month_cell">';
					}
						$result.= '<div class="numbers_account_calendar_weekday_name">';
							if ($i == 1) {
								$month = null;
								if ($date1->format('j') == 1) {
									$month = ' / ' . i18n(null, $date1->format('F'));
								}
								$result.= '<h5>' . i18n(null, $date1->format('l')) . $month . '</h5>';
							} else if ($date1->format('j') == 1) {
								$result.= '<h5>' . i18n(null, $date1->format('F')) . '</h5>';
							}
							$result.= '<h5>' . \Format::id($date1->format('j')) . '</h5>';
						$result.= '</div>';
						// render holidays first
						$date1h = $date1->format('Y-m-d');
						if (!empty($data_arranged['holidays'][$date1h])) {
							foreach ($data_arranged['holidays'][$date1h] as $k2 => $v2) {
								$result.= '<div class="numbers_account_calendar_multiday_cell">';
									$result.= '<div class="numbers_account_calendar_multiday_interval" style="color: ' . $v2['slot_text_color']  . '; background-color: ' . $v2['slot_color'] . ';">';
										$result.= $v2['slot_name'];
									$result.= '</div>';
								$result.= '</div>';
							}
						}
						// render multi days
						if (!empty($data_arranged['multiple_days'][$date1h])) {
							foreach ($data_arranged['multiple_days'][$date1h] as $k2 => $v2) {
								$result.= '<div class="numbers_account_calendar_multiday_cell">';
									$result.= '<div class="numbers_account_calendar_multiday_interval" style="color: ' . $v2['slot_text_color']  . '; background-color: ' . $v2['slot_color'] . ';">';
										$result.= $v2['um_schedinterval_name'];
									$result.= '</div>';
								$result.= '</div>';
							}
						}
						// single day last
						if (!empty($data_arranged['single_day'][$date1h])) {
							foreach ($data_arranged['single_day'][$date1h] as $k2 => $v2) {
								$result.= '<div class="numbers_account_calendar_multiday_cell">';
									$result.= '<div class="numbers_account_calendar_multiday_interval" style="color: ' . $v2['slot_text_color']  . '; background-color: ' . $v2['slot_color'] . ';">';
										$result.= $v2['um_schedinterval_name'];
									$result.= '</div>';
								$result.= '</div>';
							}
						}
					$result.= '</td>';
					// add one day
					$date1->modify('+1 day');
				}
			$result.= '</tr>';
			// we need to end a loop
			if ($date1->format('Y-m-d') > $next_month) break;
		}
		$result.= '</table>';
		return $result;
	}

	/**
	 * Render week
	 *
	 * @param object $form
	 * @param array $data
	 * @return string
	 */
	private function renderWeek(& $form, $data, $holidays) {
		// rearrange
		$data_arranged = [
			'holidays' => [],
			'multiple_days' => [],
			'single_day' => []
		];
		$data_slot_counter = 0;
		$data_slot_lock = [];
		foreach ($holidays as $k => $v) {
			$data_slot_counter++;
			$name = $v['um_schedholi_name'];
			if (strpos($name, ' - ') !== false) {
				$temp = explode(' - ', $name);
				$name = array_pop($temp);
			}
			$v['slot_name'] = $name;
			$v['slot_counter'] = $data_slot_counter;
			$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($name);
			$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
			$data_arranged['holidays'][$v['um_schedholi_date']][$data_slot_counter] = $v;
		}
		foreach ($data as $k => $v) {
			$date1 = new \DateTime(\Format::readDate($v['um_schedinterval_work_starts'], 'datetime'));
			$date2 = new \DateTime(\Format::readDate($v['um_schedinterval_work_ends'], 'datetime'));
			// multi days intervals
			if ($date1->format('Y-m-d') != $date2->format('Y-m-d')) {
				$data_slot_counter++;
				while ($date1->format('Y-m-d') != $date2->format('Y-m-d')) {
					$v['slot_counter'] = $data_slot_counter;
					$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($v['um_schedinterval_name'] . '::' . $v['um_schedinterval_hash_name']);
					$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
					$data_arranged['multiple_days'][$date1->format('Y-m-d')][$data_slot_counter] = $v;
					$date1->modify('+1 day');
				}
			} else { // single day intervals
				$v['slot_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::colorFromString($v['um_schedinterval_name'] . '::' . $v['um_schedinterval_hash_name']);
				$v['slot_text_color'] = \Numbers\Frontend\HTML\Renderers\Common\Colors::determineTextColor($v['slot_color']);
				$data_arranged['single_day'][$date1->format('w')][$date1->format('G')][$k] = $v;
			}
		}
		$result = '';
		$result.= '<table class="numbers_account_calendar_holder" width="100%">';
			// header
			$result.= '<tr>';
				$result.= '<td class="numbers_account_calendar_ampm">&nbsp;</td>';
				$week_days = \Numbers\Users\Users\Model\Scheduling\Interval\WeekDays2::getStatic();
				$date1 = new \DateTime($form->values['date1']);
				$current_date = \Format::now('date');
				$current_week_day = null;
				foreach ($week_days as $k => $v) {
					if ($date1->format('Y-m-d') == $current_date) {
						$result.= '<td class="numbers_account_calendar_td numbers_account_calendar_current">';
						$current_week_day = $k;
					} else {
						$result.= '<td class="numbers_account_calendar_td">';
					}
						$result.= '<div class="numbers_account_calendar_weekday_name">';
							$result.= i18n(null, $v['um_schedweekday_name']);
							$result.= '<br/>';
							$result.= '<h5>' . \Format::date($date1->format('Y-m-d')) . '</h5>';
						$result.= '</div>';
						// add holidays
						$date1h = $date1->format('Y-m-d');
						if (isset($data_arranged['holidays'][$date1h])) {
							foreach ($data_arranged['holidays'][$date1h] as $k2 => $v2) {
								$result.= '<div class="numbers_account_calendar_multiday_cell">';
									$result.= '<div class="numbers_account_calendar_multiday_interval" style="color: ' . $v2['slot_text_color']  . '; background-color: ' . $v2['slot_color'] . ';">';
										$result.= $v2['slot_name'];
									$result.= '</div>';
								$result.= '</div>';
							}
						}
						//
						$date1->modify('+1 day');
						// multi day intervals
						$date1a = $date1->format('Y-m-d');
						if (!empty($data_arranged['multiple_days'][$date1a])) {
							for ($i = 1; $i <= $data_slot_counter; $i++) {
								if (!empty($data_arranged['holidays'][$date1h][$i])) continue;
								$result.= '<div class="numbers_account_calendar_multiday_cell">';
									if (!empty($data_arranged['multiple_days'][$date1a][$i])) {
										$result.= '<div class="numbers_account_calendar_multiday_interval" style="color: ' . $data_arranged['multiple_days'][$date1a][$i]['slot_text_color']  . '; background-color: ' . $data_arranged['multiple_days'][$date1a][$i]['slot_color'] . ';">';
											if (!empty($data_slot_lock[$i])) {
												$result.= '&nbsp;';
											} else {
												$result.= $data_arranged['multiple_days'][$date1a][$i]['um_schedinterval_name'];
												$data_slot_lock[$i] = true;
											}
										$result.= '</div>';
									} else {
										$result.= '&nbsp;';
									}
								$result.= '</div>';
							}
						}
					$result.= '</td>';
				}
			$result.= '</tr>';
			// cells
			$data_single_day_lock = [];
			for ($i = 0; $i <= 23; $i++) {
				$result.= '<tr>';
					if ($i == 0) {
						$time = '';
					} else if ($i == 12) {
						$time = $i . i18n(null, 'pm');
					} else if ($i > 12) {
						$time = ($i - 12) . i18n(null, 'pm');
					} else {
						$time = $i . i18n(null, 'am');
					}
					$result.= '<td class="numbers_account_calendar_label_holder">';
						$result.= '<div class="numbers_account_calendar_label">' . \Format::id($time) . '</div>';
					$result.= '</td>';
					foreach ($week_days as $k => $v) {
						if (isset($current_week_day) && $current_week_day == $k) {
							$result.= '<td class="numbers_account_calendar_cell numbers_account_calendar_current">';
						} else {
							$result.= '<td class="numbers_account_calendar_cell">';
						}
							if (!empty($data_arranged['single_day'][$k][$i])) {
								$zindex = 1;
								$width = 100;
								foreach ($data_arranged['single_day'][$k][$i] as $k2 => $v2) {
									$date1 = new \DateTime(\Format::readDate($v2['um_schedinterval_work_starts'], 'datetime'));
									$date2 = new \DateTime(\Format::readDate($v2['um_schedinterval_work_ends'], 'datetime'));
									$top = (int) $date1->format('i');
									$height = (int) ($date2->getTimestamp() - $date1->getTimestamp()) / 60;
									// see if we have overlaps
									if (!empty($data_single_day_lock[$k])) {
										foreach ($data_single_day_lock[$k] as $v3) {
											if (($date1 >= $v3['start'] && $date1 <= $v3['end']) || $date2 <= $v3['end']) {
												$width-= 5;
											}
										}
									}
									$result.= '<div class="numbers_account_calendar_singleday_interval" style="top: ' . $top . 'px; height: ' . $height . 'px; width: ' . $width . '%; z-index: ' . $zindex . '; color: ' . $v2['slot_text_color']  . '; background-color: ' . $v2['slot_color'] . ';">';
										$result.= $v2['um_schedinterval_name'];
									$result.= '</div>';
									$zindex++;
									// push
									if (!isset($data_single_day_lock[$k])) $data_single_day_lock[$k] = [];
									$data_single_day_lock[$k][$date1->getTimestamp()] = [
										'start' => $date1,
										'end' => $date2,
									];
								}
							} else {
								$result.= '&nbsp;';
							}
						$result.= '</td>';
					}
				$result.= '</tr>';
			}
		$result.= '</table>';
		$result = '<div class="numbers_frontend_form_list_table_wrapper_outer"><div class="numbers_frontend_form_list_table_wrapper_inner">' . $result . '</div></div>';
		return $result;
	}
}