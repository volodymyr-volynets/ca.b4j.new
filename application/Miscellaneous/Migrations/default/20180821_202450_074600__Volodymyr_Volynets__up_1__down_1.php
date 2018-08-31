<?php

class Numbers_Backend_Db_Common_Migration_Template_20180821_202450_074600__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'b4_periods.b4_period_new_registrations', ['type'=>'column_new','schema'=>'','table'=>'b4_periods','name'=>'b4_period_new_registrations','data'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_periods','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'b4_periods.b4_period_new_registrations', ['type'=>'column_delete','schema'=>'','table'=>'b4_periods','name'=>'b4_period_new_registrations','data'=>[],'data_old'=>['domain'=>'counter','type'=>'integer','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_periods','migration_id'=>10]);
	}
}