<?php

class Numbers_Backend_Db_Common_Migration_Template_20181001_225906_364200__Volodymyr_Volynets__up_8__down_8 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_columns', 60, 'b4_periods.b4_period_training_end_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_end_date','data'=>[],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>60]);
		$this->process('delete_columns', 70, 'b4_periods.b4_period_training_submit_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_submit_date','data'=>[],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>70]);
		$this->process('delete_columns', 80, 'b4_periods.b4_period_training_notification_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_notification_date','data'=>[],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>80]);
		$this->process('new_columns', 10, 'b4_periods.b4_period_additional_info_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_additional_info_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_periods.b4_period_counselor_start_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_start_date','data'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_periods.b4_period_counselor_end_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_end_date','data'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_periods.b4_period_counselor_accepted_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_accepted_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>40]);
		$this->process('change_columns', 50, 'b4_periods.b4_period_training_start_date', ['type'=>'column_change','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_start_date','data'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>50]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_periods.b4_period_additional_info_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_additional_info_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_periods.b4_period_counselor_start_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_start_date','data'=>[],'data_old'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>20]);
		$this->process('delete_columns', 30, 'b4_periods.b4_period_counselor_end_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_end_date','data'=>[],'data_old'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_periods.b4_period_counselor_accepted_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_counselor_accepted_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>40]);
		$this->process('new_columns', 60, 'b4_periods.b4_period_training_end_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_end_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>60]);
		$this->process('new_columns', 70, 'b4_periods.b4_period_training_submit_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_submit_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>70]);
		$this->process('new_columns', 80, 'b4_periods.b4_period_training_notification_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_notification_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>80]);
		$this->process('change_columns', 50, 'b4_periods.b4_period_training_start_date', ['type'=>'column_change','schema'=>'','table'=>'b4_periods','name'=>'b4_period_training_start_date','data'=>['type'=>'date','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>['type'=>'datetime','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>50]);
	}
}