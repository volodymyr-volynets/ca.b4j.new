<?php

namespace Numbers\Countries\Countries\Data\Features\Countries;
class Canada extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Countries\Data\Features\Import\Countries([
			'cm_country_code' => 'CA'
		]);
		return $import->process();
	}
}