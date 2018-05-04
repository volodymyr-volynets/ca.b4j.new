<?php

namespace Numbers\Users\Monitoring\Model;
class SessionSequence extends \Object\Sequence {
	public $db_link;
	public $db_link_flag;
	public $schema;
	public $name = 'sm_monitoring_session_id_seq';
	public $type = 'tenant_simple';
}