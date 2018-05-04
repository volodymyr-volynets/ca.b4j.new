<?php

namespace Numbers\Countries\Countries\Data\Features\PostalCodes;
class Canada extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Countries\Data\Features\Import\PostalCodes([
			'cm_postal_country_code' => 'CA'
		]);
		return $import->process();
	}
}