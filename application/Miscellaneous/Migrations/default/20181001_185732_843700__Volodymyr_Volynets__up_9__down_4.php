<?php

class Numbers_Backend_Db_Common_Migration_Template_20181001_185732_843700__Volodymyr_Volynets__up_9__down_4 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_tables', 10, 'tm_policy_roots', ['type'=>'table_new','schema'=>'','name'=>'tm_policy_roots','data'=>['columns'=>['tm_polroot_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_polroot_code'=>['domain'=>'type_code','type'=>'varchar','length'=>15],'tm_polroot_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_polroot_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_policy_roots'],'migration_id'=>10]);
		$this->process('new_tables', 20, 'tm_policy_folders', ['type'=>'table_new','schema'=>'','name'=>'tm_policy_folders','data'=>['columns'=>['tm_polfolder_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_polfolder_id'=>['domain'=>'folder_id_sequence','type'=>'serial','sequence'=>1,'is_numeric_key'=>1],'tm_polfolder_polroot_code'=>['domain'=>'type_code','type'=>'varchar','length'=>15],'tm_polfolder_parent_polfolder_id'=>['domain'=>'folder_id','type'=>'integer','default'=>NULL,'null'=>true,'is_numeric_key'=>1],'tm_polfolder_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_polfolder_icon'=>['domain'=>'icon','type'=>'varchar','length'=>50,'null'=>true],'tm_polfolder_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_policy_folders'],'migration_id'=>20]);
		$this->process('new_columns', 30, 'sm_module_features.sm_feature_reset_model', ['type'=>'column_new','schema'=>'','table'=>'sm_module_features','name'=>'sm_feature_reset_model','data'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'sm_module_features','migration_id'=>30]);
		$this->process('new_sequences', 90, 'tm_policy_folders_tm_polfolder_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'tm_policy_folders_tm_polfolder_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_policy_folders_tm_polfolder_id_seq','full_table_name'=>'tm_policy_folders','type'=>NULL,'prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>90]);
		$this->process('new_constraints', 40, 'tm_policy_roots.tm_policy_roots_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_policy_roots','name'=>'tm_policy_roots_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_polroot_tenant_id',1=>'tm_polroot_code'],'full_table_name'=>'tm_policy_roots'],'migration_id'=>40]);
		$this->process('new_constraints', 50, 'tm_policy_folders.tm_policy_folders_pk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_policy_folders_pk','data'=>['type'=>'pk','columns'=>[0=>'tm_polfolder_tenant_id',1=>'tm_polfolder_id'],'full_table_name'=>'tm_policy_folders'],'migration_id'=>50]);
		$this->process('new_constraints', 60, 'tm_policy_folders.tm_polfolder_polroot_code_un', ['type'=>'constraint_new','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_polfolder_polroot_code_un','data'=>['type'=>'unique','columns'=>[0=>'tm_polfolder_tenant_id',1=>'tm_polfolder_polroot_code',2=>'tm_polfolder_id'],'full_table_name'=>'tm_policy_folders'],'migration_id'=>60]);
		$this->process('new_constraints', 70, 'tm_policy_folders.tm_polfolder_polroot_code_fk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_polfolder_polroot_code_fk','data'=>['type'=>'fk','columns'=>[0=>'tm_polfolder_tenant_id',1=>'tm_polfolder_polroot_code'],'foreign_model'=>'\\Numbers\\Tenants\\Tenants\\Model\\Policy\\Roots','foreign_columns'=>[0=>'tm_polroot_tenant_id',1=>'tm_polroot_code'],'full_table_name'=>'tm_policy_folders','foreign_table'=>'tm_policy_roots','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>70]);
		$this->process('new_constraints', 80, 'tm_policy_folders.tm_polfolder_parent_polfolder_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'tm_policy_folders','name'=>'tm_polfolder_parent_polfolder_id_fk','data'=>['type'=>'fk','columns'=>[0=>'tm_polfolder_tenant_id',1=>'tm_polfolder_polroot_code',2=>'tm_polfolder_parent_polfolder_id'],'foreign_model'=>'\\Numbers\\Tenants\\Tenants\\Model\\Policy\\Folders','foreign_columns'=>[0=>'tm_polfolder_tenant_id',1=>'tm_polfolder_polroot_code',2=>'tm_polfolder_id'],'full_table_name'=>'tm_policy_folders','foreign_table'=>'tm_policy_folders','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>80]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_sequences', 90, 'tm_policy_folders_tm_polfolder_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'tm_policy_folders_tm_polfolder_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'tm_policy_folders_tm_polfolder_id_seq','full_table_name'=>'tm_policy_folders','type'=>NULL,'prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>90]);
		$this->process('delete_columns', 30, 'sm_module_features.sm_feature_reset_model', ['type'=>'column_delete','schema'=>'','table'=>'sm_module_features','name'=>'sm_feature_reset_model','data'=>[],'data_old'=>['domain'=>'code','type'=>'varchar','length'=>255,'null'=>true,'default'=>NULL,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'sm_module_features','migration_id'=>30]);
		$this->process('delete_tables', 10, 'tm_policy_roots', ['type'=>'table_delete','schema'=>'','name'=>'tm_policy_roots','data'=>['columns'=>['tm_polroot_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_polroot_code'=>['domain'=>'type_code','type'=>'varchar','length'=>15],'tm_polroot_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_polroot_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_policy_roots'],'migration_id'=>10]);
		$this->process('delete_tables', 20, 'tm_policy_folders', ['type'=>'table_delete','schema'=>'','name'=>'tm_policy_folders','data'=>['columns'=>['tm_polfolder_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL,'is_numeric_key'=>1],'tm_polfolder_id'=>['domain'=>'folder_id_sequence','type'=>'serial','sequence'=>1,'is_numeric_key'=>1],'tm_polfolder_polroot_code'=>['domain'=>'type_code','type'=>'varchar','length'=>15],'tm_polfolder_parent_polfolder_id'=>['domain'=>'folder_id','type'=>'integer','default'=>NULL,'null'=>true,'is_numeric_key'=>1],'tm_polfolder_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'tm_polfolder_icon'=>['domain'=>'icon','type'=>'varchar','length'=>50,'null'=>true],'tm_polfolder_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'tm_policy_folders'],'migration_id'=>20]);
	}
}