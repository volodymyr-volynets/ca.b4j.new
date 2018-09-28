<?php

class Numbers_Backend_Db_Common_Migration_Template_20180927_231139_291400__Volodymyr_Volynets__up_9__down_3 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_tables', 10, 'tm_assignments', ['type'=>'table_new','schema'=>'','name'=>'tm_assignments','data'=>['columns'=>['tm_assignment_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assignment_id'=>['domain'=>'assignment_id_sequence','type'=>'serial','sequence'=>1,'is_numeric_key'=>1],'tm_assignment_code'=>['domain'=>'group_code','type'=>'varchar','length'=>30],'tm_assignment_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_assignment_inactive'=>['type'=>'boolean','default'=>0,'null'=>0],'tm_assignment_optimistic_lock'=>['domain'=>'optimistic_lock','type'=>'timestamp','default'=>'now()','null'=>false]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_assignments'],'migration_id'=>10]);
		$this->process('new_tables', 20, 'tm_assignment_details', ['type'=>'table_new','schema'=>'','name'=>'tm_assignment_details','data'=>['columns'=>['tm_assigndet_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_timestamp'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false],'tm_assigndet_assignment_id'=>['domain'=>'assignment_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_abacattr_id'=>['domain'=>'attribute_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>20]);
		$this->process('new_sequences', 90, 'tm_assignments_tm_assignment_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'tm_assignments_tm_assignment_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_assignments_tm_assignment_id_seq','full_table_name'=>'tm_assignments','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>90]);
		$this->process('new_constraints', 30, 'tm_assignments.tm_assignments_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignments','name'=>'tm_assignments_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assignment_tenant_id',1=>'tm_assignment_id'],'full_table_name'=>'tm_assignments'],'migration_id'=>30]);
		$this->process('new_constraints', 40, 'tm_assignments.tm_assignment_code_un', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignments','name'=>'tm_assignment_code_un','data'=>['type'=>'unique','columns'=>[0=>'tm_assignment_tenant_id',1=>'tm_assignment_code'],'full_table_name'=>'tm_assignments'],'migration_id'=>40]);
		$this->process('new_constraints', 50, 'tm_assignment_details.tm_assignment_details_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assignment_details_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id',2=>'tm_assigndet_abacattr_id'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>50]);
		$this->process('new_constraints', 60, 'tm_assignment_details.tm_assigndet_assignment_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_assignment_id_fk','data'=>['type'=>'fk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id'],'foreign_model'=>'\\Numbers\\Tenants\\Tenants\\Model\\Assignments','foreign_columns'=>[0=>'tm_assignment_tenant_id',1=>'tm_assignment_id'],'full_table_name'=>'tm_assignment_details','foreign_table'=>'tm_assignments','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>60]);
		$this->process('new_constraints', 70, 'tm_assignment_details.tm_assigndet_abacattr_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_abacattr_id_fk','data'=>['type'=>'fk','columns'=>[0=>'tm_assigndet_abacattr_id'],'foreign_model'=>'\\Numbers\\Backend\\ABAC\\Model\\Attributes','foreign_columns'=>[0=>'sm_abacattr_id'],'full_table_name'=>'tm_assignment_details','foreign_table'=>'sm_abac_attributes','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>70]);
		$this->process('new_indexes', 80, 'tm_assignments.tm_assignments_fulltext_idx', ['type'=>'index_new','schema'=>'','table'=>'tm_assignments','name'=>'tm_assignments_fulltext_idx','data'=>['type'=>'fulltext','columns'=>[0=>'tm_assignment_code',1=>'tm_assignment_name'],'full_table_name'=>'tm_assignments'],'migration_id'=>80]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_sequences', 90, 'tm_assignments_tm_assignment_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'tm_assignments_tm_assignment_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_assignments_tm_assignment_id_seq','full_table_name'=>'tm_assignments','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>90]);
		$this->process('delete_tables', 10, 'tm_assignments', ['type'=>'table_delete','schema'=>'','name'=>'tm_assignments','data'=>['columns'=>['tm_assignment_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assignment_id'=>['domain'=>'assignment_id_sequence','type'=>'serial','sequence'=>1,'is_numeric_key'=>1],'tm_assignment_code'=>['domain'=>'group_code','type'=>'varchar','length'=>30],'tm_assignment_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_assignment_inactive'=>['type'=>'boolean','default'=>0,'null'=>0],'tm_assignment_optimistic_lock'=>['domain'=>'optimistic_lock','type'=>'timestamp','default'=>'now()','null'=>false]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_assignments'],'migration_id'=>10]);
		$this->process('delete_tables', 20, 'tm_assignment_details', ['type'=>'table_delete','schema'=>'','name'=>'tm_assignment_details','data'=>['columns'=>['tm_assigndet_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_timestamp'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false],'tm_assigndet_assignment_id'=>['domain'=>'assignment_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_abacattr_id'=>['domain'=>'attribute_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_assigndet_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>20]);
	}
}