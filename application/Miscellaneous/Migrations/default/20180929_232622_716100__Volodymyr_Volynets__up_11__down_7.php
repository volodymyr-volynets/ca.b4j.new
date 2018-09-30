<?php

class Numbers_Backend_Db_Common_Migration_Template_20180929_232622_716100__Volodymyr_Volynets__up_11__down_7 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_columns', 50, 'b4_counselors.b4_counselor_medical_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>50]);
		$this->process('new_tables', 10, 'b4_registrations__audit', ['type'=>'table_new','schema'=>'','name'=>'b4_registrations__audit','data'=>['columns'=>['wg_audit_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'wg_audit_registration_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL,'is_numeric_key'=>1],'wg_audit_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1,'is_numeric_key'=>1],'wg_audit_changes'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1],'wg_audit_value'=>['type'=>'json'],'wg_audit_inserted_timestamp'=>['type'=>'timestamp','null'=>false],'wg_audit_inserted_user_id'=>['domain'=>'user_id','type'=>'bigint','default'=>NULL,'null'=>true,'is_numeric_key'=>1]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_registrations__audit'],'migration_id'=>10]);
		$this->process('new_tables', 20, 'b4_counselors__audit', ['type'=>'table_new','schema'=>'','name'=>'b4_counselors__audit','data'=>['columns'=>['wg_audit_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'wg_audit_counselor_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL,'is_numeric_key'=>1],'wg_audit_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1,'is_numeric_key'=>1],'wg_audit_changes'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1],'wg_audit_value'=>['type'=>'json'],'wg_audit_inserted_timestamp'=>['type'=>'timestamp','null'=>false],'wg_audit_inserted_user_id'=>['domain'=>'user_id','type'=>'bigint','default'=>NULL,'null'=>true,'is_numeric_key'=>1]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_counselors__audit'],'migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_counselors.b4_counselor_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_counselors.b4_counselor_signing_date', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_signing_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>40]);
		$this->process('new_sequences', 100, 'b4_registrations__audit_wg_audit_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'b4_registrations__audit_wg_audit_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_registrations__audit_wg_audit_id_seq','full_table_name'=>'b4_registrations__audit','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>100]);
		$this->process('new_sequences', 110, 'b4_counselors__audit_wg_audit_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'b4_counselors__audit_wg_audit_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_counselors__audit_wg_audit_id_seq','full_table_name'=>'b4_counselors__audit','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>110]);
		$this->process('new_constraints', 60, 'b4_registrations__audit.b4_registrations__audit_pk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_registrations__audit','name'=>'b4_registrations__audit_pk','data'=>['type'=>'pk','columns'=>[0=>'wg_audit_tenant_id',1=>'wg_audit_id'],'full_table_name'=>'b4_registrations__audit'],'migration_id'=>60]);
		$this->process('new_constraints', 70, 'b4_counselors__audit.b4_counselors__audit_pk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_counselors__audit','name'=>'b4_counselors__audit_pk','data'=>['type'=>'pk','columns'=>[0=>'wg_audit_tenant_id',1=>'wg_audit_id'],'full_table_name'=>'b4_counselors__audit'],'migration_id'=>70]);
		$this->process('new_indexes', 80, 'b4_registrations__audit.b4_registrations__audit_parent_idx', ['type'=>'index_new','schema'=>'','table'=>'b4_registrations__audit','name'=>'b4_registrations__audit_parent_idx','data'=>['type'=>'btree','columns'=>[0=>'wg_audit_tenant_id',1=>'wg_audit_registration_id'],'full_table_name'=>'b4_registrations__audit'],'migration_id'=>80]);
		$this->process('new_indexes', 90, 'b4_counselors__audit.b4_counselors__audit_parent_idx', ['type'=>'index_new','schema'=>'','table'=>'b4_counselors__audit','name'=>'b4_counselors__audit_parent_idx','data'=>['type'=>'btree','columns'=>[0=>'wg_audit_tenant_id',1=>'wg_audit_counselor_id'],'full_table_name'=>'b4_counselors__audit'],'migration_id'=>90]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_sequences', 100, 'b4_registrations__audit_wg_audit_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'b4_registrations__audit_wg_audit_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_registrations__audit_wg_audit_id_seq','full_table_name'=>'b4_registrations__audit','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>100]);
		$this->process('delete_sequences', 110, 'b4_counselors__audit_wg_audit_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'b4_counselors__audit_wg_audit_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_counselors__audit_wg_audit_id_seq','full_table_name'=>'b4_counselors__audit','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>110]);
		$this->process('delete_columns', 30, 'b4_counselors.b4_counselor_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>30]);
		$this->process('delete_columns', 40, 'b4_counselors.b4_counselor_signing_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_signing_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_counselors','migration_id'=>40]);
		$this->process('delete_tables', 10, 'b4_registrations__audit', ['type'=>'table_delete','schema'=>'','name'=>'b4_registrations__audit','data'=>['columns'=>['wg_audit_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'wg_audit_registration_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL,'is_numeric_key'=>1],'wg_audit_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1,'is_numeric_key'=>1],'wg_audit_changes'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1],'wg_audit_value'=>['type'=>'json'],'wg_audit_inserted_timestamp'=>['type'=>'timestamp','null'=>false],'wg_audit_inserted_user_id'=>['domain'=>'user_id','type'=>'bigint','default'=>NULL,'null'=>true,'is_numeric_key'=>1]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_registrations__audit'],'migration_id'=>10]);
		$this->process('delete_tables', 20, 'b4_counselors__audit', ['type'=>'table_delete','schema'=>'','name'=>'b4_counselors__audit','data'=>['columns'=>['wg_audit_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'wg_audit_counselor_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL,'is_numeric_key'=>1],'wg_audit_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1,'is_numeric_key'=>1],'wg_audit_changes'=>['domain'=>'counter','type'=>'integer','default'=>0,'is_numeric_key'=>1],'wg_audit_value'=>['type'=>'json'],'wg_audit_inserted_timestamp'=>['type'=>'timestamp','null'=>false],'wg_audit_inserted_user_id'=>['domain'=>'user_id','type'=>'bigint','default'=>NULL,'null'=>true,'is_numeric_key'=>1]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_counselors__audit'],'migration_id'=>20]);
		$this->process('new_columns', 50, 'b4_counselors.b4_counselor_medical_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_counselors','name'=>'b4_counselor_medical_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_counselors','migration_id'=>50]);
	}
}