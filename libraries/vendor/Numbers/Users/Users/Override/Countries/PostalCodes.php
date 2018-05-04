<?php

namespace Numbers\Users\Users\Override\Countries;
class PostalCodes {
	// these triggers must be run everytime we update postal codes
	public $triggers = [
		'update_direct_postal_code_details' => '\Numbers\Users\Users\Model\User\Assignment\PostalCode\Details::triggerUpdateDetails',
		'update_territory_postal_details' => '\Numbers\Users\Users\Model\User\Assignment\Territory\PostalCode\Details::triggerUpdateDetails'
	];
}