<?php

class Numbers_Backend_Db_Common_Migration_Template_20180821_201514_184900__Volodymyr_Volynets__up_4__down_4 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_periods.b4_period_camp_start_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_camp_start_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_periods.b4_period_camp_end_date', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_camp_end_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_periods.b4_period_max_registrations', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_max_registrations','data'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_periods.b4_period_confirmed_registrations', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_confirmed_registrations','data'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>40]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_periods.b4_period_camp_start_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_camp_start_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_periods.b4_period_camp_end_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_camp_end_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>20]);
		$this->process('delete_columns', 30, 'b4_periods.b4_period_max_registrations', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_max_registrations','data'=>[],'data_old'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_periods.b4_period_confirmed_registrations', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_confirmed_registrations','data'=>[],'data_old'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>40]);
	}
}