<?php

class Numbers_Backend_Db_Common_Migration_Template_20180929_203940_547600__Volodymyr_Volynets__up_2__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_tables', 10, 'tm_registries', ['type'=>'table_new','schema'=>'','name'=>'tm_registries','data'=>['columns'=>['tm_registry_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_registry_code'=>['domain'=>'code','type'=>'varchar','length'=>255],'tm_registry_value'=>['type'=>'text'],'tm_registry_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_registries'],'migration_id'=>10]);
		$this->process('new_constraints', 20, 'tm_registries.tm_registries_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_registries','name'=>'tm_registries_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_registry_tenant_id',1=>'tm_registry_code'],'full_table_name'=>'tm_registries'],'migration_id'=>20]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_tables', 10, 'tm_registries', ['type'=>'table_delete','schema'=>'','name'=>'tm_registries','data'=>['columns'=>['tm_registry_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_registry_code'=>['domain'=>'code','type'=>'varchar','length'=>255],'tm_registry_value'=>['type'=>'text'],'tm_registry_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_registries'],'migration_id'=>10]);
	}
}