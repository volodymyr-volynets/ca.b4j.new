<?php

namespace Helper\Register;
class Finish {

	/**
	 * Complete registration
	 *
	 * @param int $register_id
	 * @return array
	 */
	public static function complete(int $register_id) : array {
		$result = [
			'success' =>false,
			'error' => [],
			'registration_id' => []
		];
		// convert
		do {
			$model = new \Model\Registrations();
			$model->db_object->begin();
			$data = [];
			\Object\Table\Complementary::jsonPreloadData(
				new \Model\Register(),
				[
					'b4_register_id' => $register_id
				],
				['b4_register_step1', 'b4_register_step2', 'b4_register_step3', 'b4_register_status_id'],
				$data
			);
			if ($data['b4_register_status_id'] != 10) {
				$result['error'][] = \Helper\Messages::REGISTRATION_NOT_FOUND_OR_ALREADY_CONFIRMED;
				break;
			}
			$data2 = $data;
			foreach ($data2 as $k => $v) {
				if (empty($model->columns[$k])) unset($data2[$k]);
			}
			$data2['b4_registration_register_id'] = $register_id;
			// loop through children
			foreach ($data['\Model\Register\Details'] as $v) {
				$data2['b4_registration_child_name'] = $v['b4_registration_child_name'];
				$data2['b4_registration_date_of_birth'] = $v['b4_registration_date_of_birth'];
				$data2['b4_registration_first_time'] = $v['b4_registration_first_time'];
				$data2['b4_registration_gender_id'] = $v['b4_registration_gender_id'];
				$temp = \Model\Registrations::collectionStatic()->merge($data2);
				if ($temp['success']) {
					$result['registration_id'][] = $temp['new_serials']['b4_registration_id'];
				} else {
					$result['error'] = $temp['error'];
					$model->db_object->rollback();
					return $result;
				}
			}
			// update registration
			$temp = \Model\Register::collectionStatic()->merge([
				'b4_register_id' => $register_id,
				'b4_register_status_id' => 20
			]);
			if (!$temp['success']) {
				$result['error'] = $temp['error'];
				$model->db_object->rollback();
				return $result;
			}
			// update counter
			$temp = \Model\Periods::queryBuilderStatic()->update()->set(['b4_period_confirmed_registrations;=;~~' => 'b4_period_confirmed_registrations + 1'])->query();
			if (!$temp['success']) {
				$result['error'] = $temp['error'];
				$model->db_object->rollback();
				return $result;
			}
			// success
			$result['success'] = true;
			$model->db_object->commit();
		} while(0);
		return $result;
	}
}