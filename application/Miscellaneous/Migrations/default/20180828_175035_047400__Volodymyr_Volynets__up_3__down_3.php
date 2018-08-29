<?php

class Numbers_Backend_Db_Common_Migration_Template_20180828_175035_047400__Volodymyr_Volynets__up_3__down_3 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('change_columns', 10, 'b4_registrations.b4_registration_medical_signing_date', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_signing_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>10]);
		$this->process('change_columns', 20, 'b4_registrations.b4_registration_medical_health_card_number', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_health_card_number','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>20]);
		$this->process('change_columns', 30, 'b4_registrations.b4_registration_tshirt_size', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_tshirt_size','data'=>['type'=>'smallint','default'=>0,'null'=>true,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>30]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('change_columns', 10, 'b4_registrations.b4_registration_medical_signing_date', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_signing_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>10]);
		$this->process('change_columns', 20, 'b4_registrations.b4_registration_medical_health_card_number', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_health_card_number','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>20]);
		$this->process('change_columns', 30, 'b4_registrations.b4_registration_tshirt_size', ['type'=>'column_change','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_tshirt_size','data'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'smallint','default'=>0,'null'=>true,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>30]);
	}
}