<?php

class Numbers_Backend_Db_Common_Migration_Template_20180928_195623_067500__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

	/**
	 * Db link
	 *
	 * @var string
	 */
	public $db_link = 'default';

	/**
	 * Developer
	 *
	 * @var string
	 */
	public $developer = 'Volodymyr Volynets';

	/**
	 * Migrate up
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function up() {
		$this->process('new_columns', 10, 'b4_registrations.b4_registration_payment_received', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_payment_received','data'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_registrations.b4_registration_payment_received', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_payment_received','data'=>[],'data_old'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>10]);
	}
}