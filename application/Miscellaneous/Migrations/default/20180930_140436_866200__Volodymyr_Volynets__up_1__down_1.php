<?php

class Numbers_Backend_Db_Common_Migration_Template_20180930_140436_866200__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'sm_modules.sm_module_reset_model', ['type'=>'column_new','schema'=>'','table'=>'sm_modules','name'=>'sm_module_reset_model','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'sm_modules','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'sm_modules.sm_module_reset_model', ['type'=>'column_delete','schema'=>'','table'=>'sm_modules','name'=>'sm_module_reset_model','data'=>[],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'sm_modules','migration_id'=>10]);
	}
}