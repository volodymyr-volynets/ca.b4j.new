<?php

namespace Numbers\Countries\Countries\Data\Features\Countries;
class US extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Countries\Data\Features\Import\Countries([
			'cm_country_code' => 'US'
		]);
		return $import->process();
	}
}