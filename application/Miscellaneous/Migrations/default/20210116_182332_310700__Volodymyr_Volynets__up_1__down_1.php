<?php

class Numbers_Backend_Db_Common_Migration_Template_20210116_182332_310700__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_counselors.b4_counselor_parents_email', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_parents_email','data'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_counselors.b4_counselor_parents_email', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_parents_email','data'=>[],'data_old'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>10]);
	}
}