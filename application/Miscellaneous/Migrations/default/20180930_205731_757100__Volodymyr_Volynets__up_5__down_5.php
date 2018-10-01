<?php

class Numbers_Backend_Db_Common_Migration_Template_20180930_205731_757100__Volodymyr_Volynets__up_5__down_5 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_counselors.b4_counselor_declartion_police_check_submitted', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_police_check_submitted','data'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_counselors.b4_counselor_declartion_signed_at', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signed_at','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_counselors.b4_counselor_declartion_last_police_check', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_last_police_check','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_counselors.b4_counselor_declartion_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>40]);
		$this->process('new_columns', 50, 'b4_counselors.b4_counselor_declartion_signing_date', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signing_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>50]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_counselors.b4_counselor_declartion_police_check_submitted', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_police_check_submitted','data'=>[],'data_old'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_counselors.b4_counselor_declartion_signed_at', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signed_at','data'=>[],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>20]);
		$this->process('delete_columns', 30, 'b4_counselors.b4_counselor_declartion_last_police_check', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_last_police_check','data'=>[],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_counselors.b4_counselor_declartion_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>40]);
		$this->process('delete_columns', 50, 'b4_counselors.b4_counselor_declartion_signing_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_declartion_signing_date','data'=>[],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>50]);
	}
}