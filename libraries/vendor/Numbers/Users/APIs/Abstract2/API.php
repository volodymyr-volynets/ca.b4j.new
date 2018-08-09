<?php

namespace Numbers\Users\APIs\Abstract2;
abstract class API {

	/**
	 * Authorized
	 *
	 * @var boolean
	 */
	public $authorized = false;

	/**
	 * Aliases
	 *
	 * @var array
	 */
	public $aliases = [
		//'alias' => 'function'
	];

	/**
	 * Aliases
	 *
	 * @var array
	 */
	public $aliases_default = [
		'get' => 'read',
		'put' => 'update',
		'post' => 'create',
		'delete' => 'delete'
	];

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = []) {
		// permissions
		
		
		// process instructions
		foreach ($this->instructions as $k => $v) {
			foreach ($v as $k2 => $v2) {
				$this->instructions[$k][$k2] = \Object\Data\Common::processDomainsAndTypes($this->instructions[$k][$k2]);
				// todo: convert to SOAP types
			}
		}
		// merge aliases
		if (!empty($this->aliases)) {
			$this->aliases = array_merge($this->aliases_default, $this->aliases);
		} else {
			$this->aliases = $this->aliases_default;
		}
	}
}