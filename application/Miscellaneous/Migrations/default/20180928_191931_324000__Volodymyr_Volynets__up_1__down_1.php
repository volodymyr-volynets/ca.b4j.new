<?php

class Numbers_Backend_Db_Common_Migration_Template_20180928_191931_324000__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_columns', 10, 'sm_resources.sm_resource_menu_class', ['type'=>'column_new','schema'=>'','table'=>'sm_resources','name'=>'sm_resource_menu_class','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'sm_resources','migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_columns', 10, 'sm_resources.sm_resource_menu_class', ['type'=>'column_delete','schema'=>'','table'=>'sm_resources','name'=>'sm_resource_menu_class','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'sm_resources','migration_id'=>10]);
	}
}