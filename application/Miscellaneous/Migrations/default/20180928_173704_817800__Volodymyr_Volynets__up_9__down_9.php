<?php

class Numbers_Backend_Db_Common_Migration_Template_20180928_173704_817800__Volodymyr_Volynets__up_9__down_9 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_constraints', 70, 'tm_assignment_details.tm_assignment_details_pk', ['type'=>'constraint_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assignment_details_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id',2=>'tm_assigndet_abacattr_id'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>70]);
		$this->process('delete_columns', 60, 'tm_assignment_details.tm_assigndet_timestamp', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_timestamp','data'=>[],'data_old'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_assignment_details','migration_id'=>60]);
		$this->process('new_columns', 10, 'tm_assignments.tm_assignment_bidirectional', ['type'=>'column_new','schema'=>'','table'=>'tm_assignments','name'=>'tm_assignment_bidirectional','data'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignments','migration_id'=>10]);
		$this->process('new_columns', 20, 'tm_assignment_details.tm_assigndet_id', ['type'=>'column_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_id','data'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>true,'is_numeric_key'=>1,'null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignment_details','migration_id'=>20]);
		$this->process('new_columns', 30, 'tm_assignment_details.tm_assigndet_name', ['type'=>'column_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_name','data'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignment_details','migration_id'=>30]);
		$this->process('new_columns', 40, 'tm_assignment_details.tm_assigndet_primary', ['type'=>'column_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_primary','data'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignment_details','migration_id'=>40]);
		$this->process('new_columns', 50, 'tm_assignment_details.tm_assigndet_multiple', ['type'=>'column_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_multiple','data'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignment_details','migration_id'=>50]);
		$this->process('new_sequences', 80, 'tm_assignment_details_tm_assigndet_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'tm_assignment_details_tm_assigndet_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_assignment_details_tm_assigndet_id_seq','full_table_name'=>'tm_assignment_details','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>80]);
		$this->process('new_constraints', 70, 'tm_assignment_details.tm_assignment_details_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assignment_details_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id',2=>'tm_assigndet_id'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>70]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_constraints', 70, 'tm_assignment_details.tm_assignment_details_pk', ['type'=>'constraint_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assignment_details_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id',2=>'tm_assigndet_id'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>70]);
		$this->process('delete_sequences', 80, 'tm_assignment_details_tm_assigndet_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'tm_assignment_details_tm_assigndet_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_assignment_details_tm_assigndet_id_seq','full_table_name'=>'tm_assignment_details','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>80]);
		$this->process('delete_columns', 10, 'tm_assignments.tm_assignment_bidirectional', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignments','name'=>'tm_assignment_bidirectional','data'=>[],'data_old'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_assignments','migration_id'=>10]);
		$this->process('delete_columns', 20, 'tm_assignment_details.tm_assigndet_id', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_id','data'=>[],'data_old'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>true,'is_numeric_key'=>1,'null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sql_type'=>NULL],'full_table_name'=>'tm_assignment_details','migration_id'=>20]);
		$this->process('delete_columns', 30, 'tm_assignment_details.tm_assigndet_name', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_name','data'=>[],'data_old'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>false,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_assignment_details','migration_id'=>30]);
		$this->process('delete_columns', 40, 'tm_assignment_details.tm_assigndet_primary', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_primary','data'=>[],'data_old'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_assignment_details','migration_id'=>40]);
		$this->process('delete_columns', 50, 'tm_assignment_details.tm_assigndet_multiple', ['type'=>'column_delete','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_multiple','data'=>[],'data_old'=>['type'=>'boolean','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'tm_assignment_details','migration_id'=>50]);
		$this->process('new_columns', 60, 'tm_assignment_details.tm_assigndet_timestamp', ['type'=>'column_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assigndet_timestamp','data'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'tm_assignment_details','migration_id'=>60]);
		$this->process('new_constraints', 70, 'tm_assignment_details.tm_assignment_details_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_assignment_details','name'=>'tm_assignment_details_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_assigndet_tenant_id',1=>'tm_assigndet_assignment_id',2=>'tm_assigndet_abacattr_id'],'full_table_name'=>'tm_assignment_details'],'migration_id'=>70]);
	}
}