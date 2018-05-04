<?php

namespace Numbers\Users\Organizations\Helper;
class BusinessHours {

	/**
	 * Cached business hours
	 *
	 * @var array
	 */
	private static $cached_business_hours = [];

	/**
	 * Cached holidays
	 *
	 * @var array
	 */
	private static $cached_holidays = [];

	/**
	 * Find nearest datetime
	 *
	 * @param int $organization_id
	 * @param string $start_date
	 * @param string $timezone_code
	 * @param int $interval_minutes
	 * @return \DateTime
	 */
	public static function findNearestDatetime(int $organization_id, string $start_date, string $timezone_code, int $interval_minutes) : \DateTime {
		if (!isset(self::$cached_business_hours[$organization_id])) {
			self::$cached_business_hours[$organization_id] = \Numbers\Users\Organizations\Model\Organization\BusinessHours::getStatic([
				'where' => [
					'on_orgbhour_organization_id' => $organization_id
				],
				'pk' => ['on_orgbhour_day_id']
			]);
			self::$cached_holidays[$organization_id] = [];
			// fetch organization
			$organization = \Numbers\Users\Organizations\Model\Organizations::loadById($organization_id);
			// fetch holidays
			$query = \Numbers\Users\Users\Model\Scheduling\Holidays::queryBuilderStatic()->select();
			$query->columns([
				'um_schedholi_date',
				'um_schedholi_name'
			]);
			$query->where('AND', function (& $query) use ($organization) {
				$query->where('OR', ['a.um_schedholi_organization_id', '=', $organization_id]);
				if (!empty($organization['on_organization_operating_province_code'])) {
					$query->where('OR', function (& $query) use ($organization) {
						$query->where('AND', ['a.um_schedholi_country_code', '=', $organization['on_organization_operating_country_code']]);
						$query->where('AND', ['a.um_schedholi_province_code', '=', $organization['on_organization_operating_province_code']]);
					});
				}
			});
			$query->where('AND', ['a.um_schedholi_date', '>=', \Format::now('timestamp')]);
			$data = $query->query(['um_schedholi_date']);
			self::$cached_holidays[$organization_id] = $data['rows'];
		}
		// if we do not have bussiness hours for selected organization we treat it as regular hours
		$future_date = new \DateTime($start_date, new \DateTimeZone($timezone_code));
		if (empty(self::$cached_business_hours[$organization_id])) {
			$future_date->add(date_interval_create_from_date_string($interval_minutes . ' minutes'));
			return $future_date;
		}
		// process today
		$counter = 1;
		while($interval_minutes != 0) {
			self::processOneDay($organization_id, $future_date, $interval_minutes);
			if ($counter == 10000) break;
		}
		return $future_date;
	}

	/**
	 * Process one day
	 *
	 * @param int $organization_id
	 * @param \DateTime $future_date
	 * @param int $interval_minutes
	 * @return boolean
	 */
	private static function processOneDay(int $organization_id, \DateTime & $future_date, int & $interval_minutes) {
		$day = $future_date->format('N');
		// off time and holidays
		while (empty(self::$cached_business_hours[$organization_id][$day]) || !empty(self::$cached_holidays[$organization_id][$future_date->format('Y-m-d')])) {
			$future_date->add(date_interval_create_from_date_string('1 day'));
			$day = $future_date->format('N');
		}
		// in the middle of a day
		$start_date = $future_date->format('Y-m-d') . ' ' . self::$cached_business_hours[$organization_id][$day]['on_orgbhour_start_time'];
		$end_date = $future_date->format('Y-m-d') . ' ' . self::$cached_business_hours[$organization_id][$day]['on_orgbhour_end_time'];
		$start_datetime = new \DateTime($start_date, new \DateTimeZone(self::$cached_business_hours[$organization_id][$day]['on_orgbhour_timezone_code']));
		$end_datetime = new \DateTime($end_date, new \DateTimeZone(self::$cached_business_hours[$organization_id][$day]['on_orgbhour_timezone_code']));
		$start_interval = $start_datetime->diff($future_date);
		// determine minutes from start
		$minutes_from_start = ((int) $start_interval->format('%R%H') * 60 + (int) $start_interval->format('%R%I'));
		if ($minutes_from_start >= $interval_minutes) {
			$future_date->sub(date_interval_create_from_date_string($minutes_from_start . ' minutes'));
			$future_date->add(date_interval_create_from_date_string($interval_minutes . ' minutes'));
			$interval_minutes = 0;
			return true;
		} else {
			// make future day beginning of a day
			$during_interval = $start_datetime->diff($end_datetime);
			$minutes_during_day = ((int) $during_interval->format('%R%H') * 60 + (int) $during_interval->format('%R%I'));
			$end_of_day = $minutes_during_day - $minutes_from_start;
			if ($end_of_day >= $interval_minutes) {
				$future_date->add(date_interval_create_from_date_string($interval_minutes . ' minutes'));
				$interval_minutes = 0;
				return true;
			} else {
				// at this point we need to go to another day
				$future_date->add(date_interval_create_from_date_string('1 day'));
				$interval_minutes-= 24 * 60;
				return true;
			}
		}
	}
}