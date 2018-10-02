<?php

class Numbers_Backend_Db_Common_Migration_Template_20181001_200744_394700__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_columns', 10, 'b4_counselors.b4_counselor_period_code', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_period_code','data'=>[],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('new_columns', 10, 'b4_counselors.b4_counselor_period_code', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_period_code','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>10]);
	}
}