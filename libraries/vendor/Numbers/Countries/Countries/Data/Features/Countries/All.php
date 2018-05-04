<?php

namespace Numbers\Countries\Countries\Data\Features\Countries;
class All extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Countries\Data\Features\Import\Countries($options);
		return $import->process();
	}
}