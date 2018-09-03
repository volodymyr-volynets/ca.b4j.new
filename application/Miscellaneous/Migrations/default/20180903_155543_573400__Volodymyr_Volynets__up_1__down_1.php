<?php

class Numbers_Backend_Db_Common_Migration_Template_20180903_155543_573400__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_registrations.b4_registration_gender_id', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_gender_id','data'=>['domain'=>'status_id','type'=>'smallint','default'=>10,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_registrations.b4_registration_gender_id', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_gender_id','data'=>[],'data_old'=>['domain'=>'status_id','type'=>'smallint','default'=>10,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>10]);
	}
}