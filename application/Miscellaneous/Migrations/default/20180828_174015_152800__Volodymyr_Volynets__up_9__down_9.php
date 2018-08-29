<?php

class Numbers_Backend_Db_Common_Migration_Template_20180828_174015_152800__Volodymyr_Volynets__up_9__down_9 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_columns', 30, 'b4_registrations.b4_registration_waiver_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_registrations.b4_registration_waiver_signing_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_signing_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>40]);
		$this->process('delete_columns', 50, 'b4_registrations.b4_registration_waiver_child_name', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_child_name','data'=>[],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>50]);
		$this->process('delete_columns', 60, 'b4_registrations.b4_registration_medical_period_start', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_period_start','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>60]);
		$this->process('delete_columns', 70, 'b4_registrations.b4_registration_medical_period_end', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_period_end','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>70]);
		$this->process('delete_columns', 80, 'b4_registrations.b4_registration_first_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>80]);
		$this->process('delete_columns', 90, 'b4_registrations.b4_registration_first_signing_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signing_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>90]);
		$this->process('new_columns', 10, 'b4_registrations.b4_registration_emergency_line1', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line1','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_registrations.b4_registration_emergency_line2', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line2','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>20]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_registrations.b4_registration_emergency_line1', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line1','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_registrations.b4_registration_emergency_line2', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line2','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_registrations.b4_registration_waiver_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_registrations.b4_registration_waiver_signing_date', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_signing_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>40]);
		$this->process('new_columns', 50, 'b4_registrations.b4_registration_waiver_child_name', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_waiver_child_name','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>50]);
		$this->process('new_columns', 60, 'b4_registrations.b4_registration_medical_period_start', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_period_start','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>60]);
		$this->process('new_columns', 70, 'b4_registrations.b4_registration_medical_period_end', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_medical_period_end','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>70]);
		$this->process('new_columns', 80, 'b4_registrations.b4_registration_first_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>80]);
		$this->process('new_columns', 90, 'b4_registrations.b4_registration_first_signing_date', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signing_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>90]);
	}
}