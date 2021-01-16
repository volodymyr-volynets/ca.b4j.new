<?php

class Numbers_Backend_Db_Common_Migration_Template_20210116_182048_925600__Volodymyr_Volynets__up_3__down_3 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('change_columns', 10, 'b4_counselors.b4_counselor_badge_name', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_badge_name','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>10]);
		$this->process('change_columns', 20, 'b4_counselors.b4_counselor_medical_health_card_number', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_health_card_number','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>20]);
		$this->process('change_columns', 30, 'b4_counselors.b4_counselor_medical_doctors_info', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_doctors_info','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'text','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>30]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('change_columns', 10, 'b4_counselors.b4_counselor_badge_name', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_badge_name','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>10]);
		$this->process('change_columns', 20, 'b4_counselors.b4_counselor_medical_health_card_number', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_health_card_number','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>20]);
		$this->process('change_columns', 30, 'b4_counselors.b4_counselor_medical_doctors_info', ['type'=>'column_change','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_doctors_info','data'=>['type'=>'text','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>30]);
	}
}