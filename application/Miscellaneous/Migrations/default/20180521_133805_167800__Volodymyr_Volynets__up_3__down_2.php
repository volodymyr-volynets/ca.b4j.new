<?php

class Numbers_Backend_Db_Common_Migration_Template_20180521_133805_167800__Volodymyr_Volynets__up_3__down_2 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_tables', 10, 'b4_register', ['type'=>'table_new','schema'=>'','name'=>'b4_register','data'=>['columns'=>['b4_register_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL],'b4_register_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1],'b4_register_step_id'=>['domain'=>'type_id','type'=>'smallint','default'=>1],'b4_register_step1'=>['type'=>'json','null'=>true],'b4_register_step2'=>['type'=>'json','null'=>true],'b4_register_step3'=>['type'=>'json','null'=>true],'b4_register_step4'=>['type'=>'json','null'=>true],'b4_register_step5'=>['type'=>'json','null'=>true],'b4_register_step6'=>['type'=>'json','null'=>true],'b4_register_step7'=>['type'=>'json','null'=>true],'b4_register_step8'=>['type'=>'json','null'=>true],'b4_register_step9'=>['type'=>'json','null'=>true],'b4_register_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_register'],'migration_id'=>10]);
		$this->process('new_sequences', 30, 'b4_register_b4_register_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'b4_register_b4_register_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_register_b4_register_id_seq','full_table_name'=>'b4_register','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>30]);
		$this->process('new_constraints', 20, 'b4_register.b4_register_pk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_pk','data'=>['type'=>'pk','columns'=>[0=>'b4_register_tenant_id',1=>'b4_register_id'],'full_table_name'=>'b4_register'],'migration_id'=>20]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_sequences', 30, 'b4_register_b4_register_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'b4_register_b4_register_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_register_b4_register_id_seq','full_table_name'=>'b4_register','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>30]);
		$this->process('delete_tables', 10, 'b4_register', ['type'=>'table_delete','schema'=>'','name'=>'b4_register','data'=>['columns'=>['b4_register_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL],'b4_register_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1],'b4_register_step_id'=>['domain'=>'type_id','type'=>'smallint','default'=>1],'b4_register_step1'=>['type'=>'json','null'=>true],'b4_register_step2'=>['type'=>'json','null'=>true],'b4_register_step3'=>['type'=>'json','null'=>true],'b4_register_step4'=>['type'=>'json','null'=>true],'b4_register_step5'=>['type'=>'json','null'=>true],'b4_register_step6'=>['type'=>'json','null'=>true],'b4_register_step7'=>['type'=>'json','null'=>true],'b4_register_step8'=>['type'=>'json','null'=>true],'b4_register_step9'=>['type'=>'json','null'=>true],'b4_register_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_register'],'migration_id'=>10]);
	}
}