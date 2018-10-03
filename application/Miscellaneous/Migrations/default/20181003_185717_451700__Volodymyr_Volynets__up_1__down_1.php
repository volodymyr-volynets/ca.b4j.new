<?php

class Numbers_Backend_Db_Common_Migration_Template_20181003_185717_451700__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'tm_policy_folders.tm_polfolder_counter', ['type'=>'column_new','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_polfolder_counter','data'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_policy_folders','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'tm_policy_folders.tm_polfolder_counter', ['type'=>'column_delete','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_polfolder_counter','data'=>[],'data_old'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_policy_folders','migration_id'=>10]);
	}
}