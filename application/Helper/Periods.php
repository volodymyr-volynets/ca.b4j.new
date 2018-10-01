<?php

namespace Helper;
class Periods {

	/**
	 * Cached period
	 *
	 * @var array
	 */
	public static $cached_period;

	public static function get(string $column) {
		// fetch period information
		if (!isset(self::$cached_period[$column])) {
			$temp = \Model\Periods::getStatic([
				'where' => [
					'b4_period_current' => 1,
				],
				'pk' => null
			]);
			if (empty($temp)) {
				Throw new \Exception('Unable to find current period!');
			}
			self::$cached_period = $temp[0];
		}
		return self::$cached_period[$column];
	}
}