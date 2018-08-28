<?php

class Numbers_Backend_Db_Common_Migration_Template_20180822_185746_025700__Volodymyr_Volynets__up_5__down_5 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_register.b4_register_datetime', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_datetime','data'=>['type'=>'timestamp','default'=>'now()','null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_register.b4_register_parents_name', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_name','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_register.b4_register_parents_phone', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_phone','data'=>['domain'=>'phone','type'=>'varchar','length'=>50,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_register.b4_register_parents_email', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_email','data'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>40]);
		$this->process('new_columns', 50, 'b4_register.b4_register_status_id', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_status_id','data'=>['domain'=>'status_id','type'=>'smallint','default'=>10,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>50]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_register.b4_register_datetime', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_datetime','data'=>[],'data_old'=>['type'=>'timestamp','default'=>'now()','null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_register.b4_register_parents_name', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_name','data'=>[],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>20]);
		$this->process('delete_columns', 30, 'b4_register.b4_register_parents_phone', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_phone','data'=>[],'data_old'=>['domain'=>'phone','type'=>'varchar','length'=>50,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_register.b4_register_parents_email', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_parents_email','data'=>[],'data_old'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>40]);
		$this->process('delete_columns', 50, 'b4_register.b4_register_status_id', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_status_id','data'=>[],'data_old'=>['domain'=>'status_id','type'=>'smallint','default'=>10,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>50]);
	}
}