<?php

namespace Numbers\Users\TaskScheduler\Helper;
class Expression {

	/**
	 * Parsed expression
	 *
	 * @var array
	 */
	public $parsed_expression = [];

	/**
	 * Add Expression
	 *
	 * @param string $expression
	 * @return array
	 */
	public function addExpression(string $expression) : array {
		$result = [
			'success' => true,
			'error' => []
		];
		$this->parsed_expression = [];
		$temp = self::parseStatic($expression);
		if ($temp['success']) {
			$this->parsed_expression = $temp['data_mapped'];
		} else {
			$result['error'][] = 'Expression?';
		}
		return $result;
	}

	/**
	 * Whether its a time to run
	 *
	 * @param date $datetime
	 * @return boolean
	 */
	public function isTime(string $datetime) : bool {
		if (empty($this->parsed_expression)) {
			Throw new Exception('Expression?');
		}
		$parts = \Format::datetimeParts($datetime);
		foreach ($this->parsed_expression as $k => $v) {
			if (in_array('*', $v, true)) {
				continue;
			} else if (in_array($parts[$k], $v)) {
				continue;
			} else {
				return false;
			}
		}
		return true;
	}

	/**
	 * Next run datetime
	 *
	 * @param mixed $datetime
	 * @return string
	 */
	public function nextRunDate($datetime = null) {
		$result = null;
		if (empty($datetime)) {
			$datetime = \Format::now('unix');
		} else if (!is_numeric($datetime)) {
			$datetime = strtotime($datetime);
		}
		$parts = \Format::datetimeParts($datetime);
		for ($year = $parts['year']; $year <= self::$slot_stats[6]['max']; $year++) {
			// check if we are in range
			if (!(in_array('*', $this->parsed_expression['year']) || in_array($year, $this->parsed_expression['year']))) {
				continue;
			}
			for ($month = 1; $month <= 12; $month++) {
				// check if we are in range
				if (!(in_array('*', $this->parsed_expression['month']) || in_array($month, $this->parsed_expression['month']))) {
					continue;
				}
				for ($day = 1; $day <= 31; $day++) {
					// check if we are in range
					if (!(in_array('*', $this->parsed_expression['day']) || in_array($day, $this->parsed_expression['day']))) {
						continue;
					}
					// check weekday
					$weekday = date('w', mktime(0, 0, 0, $month, $day, $year));
					if (!(in_array('*', $this->parsed_expression['weekday']) || in_array($weekday, $this->parsed_expression['weekday']))) {
						continue;
					}
					// loop through hours
					for ($hour = 0; $hour <= 23; $hour++) {
						// check if we are in range
						if (!(in_array('*', $this->parsed_expression['hour']) || in_array($hour, $this->parsed_expression['hour']))) {
							continue;
						}
						// loop though minutes
						for ($minute = 0; $minute <= 59; $minute++) {
							$date = mktime($hour, $minute, 0, $month, $day, $year);
							if ($date < $datetime) {
								continue;
							} else {
								// check if we are in range
								if (!(in_array('*', $this->parsed_expression['minute']) || in_array($minute, $this->parsed_expression['minute']))) {
									continue;
								}
								// check the rest
								$result = \Format::datetime($date);
								goto exit1;
							}
						}
					}
				}
			}
		}
exit1:
		return $result;
	}

	/**
	 * Slot stats
	 *
	 * @var array
	 */
	public static $slot_stats = [
		1 => ['min' => 0, 'max' => 59],
		2 => ['min' => 0, 'max' => 23],
		3 => ['min' => 1, 'max' => 31],
		4 => ['min' => 1, 'max' => 12],
		5 => ['min' => 0, 'max' => 6],
		6 => ['min' => 1900, 'max' => 3000]
	];

	/**
	 * Parse cron expression as static, based on following:
	 *
	 *		*    *    *    *    *    *
	 *		-    -    -    -    -    -
	 *		|    |    |    |    |    |
	 *		|    |    |    |    |    + year [optional]
	 *		|    |    |    |    +----- day of week (0 - 7) (Sunday=0 or 7)
	 *		|    |    |    +---------- month (1 - 12)
	 *		|    |    +--------------- day of month (1 - 31)
	 *		|    +-------------------- hour (0 - 23)
	 *		+------------------------- min (0 - 59)
	 *
	 *
	 * @param string $expression
	 * @return array
	 */
	public static function parseStatic($expression) {
		$result = [
			'success' => false,
			'error' => [],
			'data_raw' => [],
			'data_mapped' => []
		];
		$final = [];
		// explode on space and coma
		$parts = explode(' ', $expression);
		for ($i = 0; $i < 6; $i++) {
			$final[$i + 1] = explode(',', $parts[$i] ?? '*');
		}
		// process "-" and "/"
		foreach ($final as $k => $v) {
			foreach ($v as $k2 => $v2) {
				// if we have "-"
				if (strpos($v2, '-') !== false) {
					$temp = explode('-', $v2);
					for ($i = (int) $temp[0]; $i <= (int) $temp[1]; $i++) {
						if ($i >= self::$slot_stats[$k]['min'] && $i <= self::$slot_stats[$k]['max']) {
							$result['data_raw'][$k][] = $i;
						}
					}
				} else if (strpos($v2, '/') !== false) { // if we have "/"
					$temp = explode('/', $v2);
					if ($temp[0] == '*') {
						$temp[0] = 0;
					}
					for ($i = (int) $temp[0]; $i <= self::$slot_stats[$k]['max']; $i+= (int) $temp[1]) {
						if ($i >= self::$slot_stats[$k]['min'] && $i <= self::$slot_stats[$k]['max']) {
							$result['data_raw'][$k][] = $i;
						}
					}
				} else { // other values
					if ($v2 == '*') {
						$result['data_raw'][$k][] = $v2;
					} else if (is_numeric($v2)) {
						$v2 = (int) $v2;
						if ($v2 >= self::$slot_stats[$k]['min'] && $v2 <= self::$slot_stats[$k]['max']) {
							$result['data_raw'][$k][] = $v2;
						}
					} else {
						// unknown value
						$result['error'][] = 'Unknown value ' . $v2;
					}
				}
			}
			// fix asterisk
			if (in_array('*', $result['data_raw'][$k], true)) {
				$result['data_raw'][$k] = ['*'];
			} else if (empty($result['data_raw'][$k])) {
				$result['data_raw'][$k] = ['*'];
			} else {
				// we need to get unique values and sort it
				$result['data_raw'][$k] = array_unique($result['data_raw'][$k]);
				sort($result['data_raw'][$k]);
			}
		}
		if (empty($result['error'])) {
			// map fields
			foreach ([
				1 => 'minute',
				2 => 'hour',
				3 => 'day',
				4 => 'month',
				5 => 'weekday',
				6 => 'year'
			] as $k => $v) {
				$result['data_mapped'][$v] = $result['data_raw'][$k];
			}
			$result['success'] = true;
		}
		return $result;
	}

	/**
	 * Is valid one Cron expression
	 *
	 * @param string $expression
	 * @return bool
	 */
	public function isValidOneExpression(string $expression) : bool {
		$pattern = '/^(?:[1-9]?\d|\*)(?:(?:[\/-][1-9]?\d)|(?:,[1-9]?\d)+)?$/';
		$temp = explode(',', $expression);
		foreach ($temp as $v) {
			if (!preg_match($pattern, $v)) return false;
		}
		return true;
	}
}