<?php

class Numbers_Backend_Db_Common_Migration_Template_20180523_154002_223400__Volodymyr_Volynets__up_6__down_2 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_tables', 10, 'b4_registrations', ['type'=>'table_new','schema'=>'','name'=>'b4_registrations','data'=>['columns'=>['b4_registration_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL],'b4_registration_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1],'b4_registration_register_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL],'b4_registration_timestamp'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false],'b4_registration_period_id'=>['domain'=>'group_id','type'=>'integer','default'=>NULL],'b4_registration_period_code'=>['domain'=>'code','type'=>'varchar','length'=>255],'b4_registration_in_group_id'=>['domain'=>'group_id','type'=>'integer','default'=>NULL],'b4_registration_child_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_parents_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_parish'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true],'b4_registration_grade'=>['type'=>'smallint','default'=>0],'b4_registration_age'=>['type'=>'smallint','default'=>0],'b4_registration_date_of_birth'=>['type'=>'date'],'b4_registration_address1'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_address2'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true],'b4_registration_city'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_postal_code'=>['domain'=>'postal_code','type'=>'varchar','length'=>15],'b4_registration_country_code'=>['domain'=>'country_code','type'=>'char','length'=>2],'b4_registration_province_code'=>['domain'=>'province_code','type'=>'varchar','length'=>30],'b4_registration_email'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true],'b4_registration_phone'=>['domain'=>'phone','type'=>'varchar','length'=>50,'null'=>true],'b4_registration_emergency_line1'=>['type'=>'text','null'=>true],'b4_registration_emergency_line2'=>['type'=>'text','null'=>true],'b4_registration_prefered_language_preference'=>['type'=>'smallint','default'=>0],'b4_registration_first_time'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_signature'=>['domain'=>'signature','type'=>'text','null'=>true],'b4_registration_medical_signing_date'=>['type'=>'date'],'b4_registration_medical_health_card_number'=>['domain'=>'code','type'=>'varchar','length'=>255],'b4_registration_medical_doctors_contact'=>['type'=>'text','null'=>true],'b4_registration_medical_alergies_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_alergies_details'=>['type'=>'text','null'=>true],'b4_registration_medical_immunization_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_medication_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_medication_details'=>['type'=>'text','null'=>true],'b4_registration_medical_special_food_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_special_food_details'=>['type'=>'text','null'=>true],'b4_registration_medical_other_issues_details'=>['type'=>'text','null'=>true],'b4_registration_medical_special_need_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_special_need_details'=>['type'=>'text','null'=>true],'b4_registration_medical_drug_acetaminophen'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_ibuprofen'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_polysporin'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antacids'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antihistamines'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_decongestants'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_hydrocortisone'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_cough_drops'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antiseptic_solutions'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_anti_emetics'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_bismuth_subsalicylate'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_non_prescription_medication'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_no_non_prescription_medication'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_waiver_signature'=>['domain'=>'signature','type'=>'text','null'=>true],'b4_registration_waiver_signing_date'=>['type'=>'date'],'b4_registration_waiver_child_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_medical_period_start'=>['type'=>'date'],'b4_registration_medical_period_end'=>['type'=>'date'],'b4_registration_tshirt_size'=>['type'=>'smallint','default'=>0],'b4_registration_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_registrations'],'migration_id'=>10]);
		$this->process('new_sequences', 60, 'b4_registrations_b4_registration_id_seq', ['type'=>'sequence_new','schema'=>'','name'=>'b4_registrations_b4_registration_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_registrations_b4_registration_id_seq','full_table_name'=>'b4_registrations','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>60]);
		$this->process('new_constraints', 20, 'b4_registrations.b4_registrations_pk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registrations_pk','data'=>['type'=>'pk','columns'=>[0=>'b4_registration_tenant_id',1=>'b4_registration_id'],'full_table_name'=>'b4_registrations'],'migration_id'=>20]);
		$this->process('new_constraints', 30, 'b4_registrations.b4_registration_period_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_period_id_fk','data'=>['type'=>'fk','columns'=>[0=>'b4_registration_tenant_id',1=>'b4_registration_period_id'],'foreign_model'=>'\\Model\\Periods','foreign_columns'=>[0=>'b4_period_tenant_id',1=>'b4_period_id'],'full_table_name'=>'b4_registrations','foreign_table'=>'b4_periods','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>30]);
		$this->process('new_constraints', 40, 'b4_registrations.b4_registration_in_group_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_in_group_id_fk','data'=>['type'=>'fk','columns'=>[0=>'b4_registration_tenant_id',1=>'b4_registration_in_group_id'],'foreign_model'=>'\\Numbers\\Internalization\\Internalization\\Model\\Groups','foreign_columns'=>[0=>'in_group_tenant_id',1=>'in_group_id'],'full_table_name'=>'b4_registrations','foreign_table'=>'in_groups','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>40]);
		$this->process('new_constraints', 50, 'b4_registrations.b4_registration_register_id_fk', ['type'=>'constraint_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_register_id_fk','data'=>['type'=>'fk','columns'=>[0=>'b4_registration_tenant_id',1=>'b4_registration_register_id'],'foreign_model'=>'\\Model\\Register','foreign_columns'=>[0=>'b4_register_tenant_id',1=>'b4_register_id'],'full_table_name'=>'b4_registrations','foreign_table'=>'b4_register','options'=>['match'=>'simple','update'=>'cascade','delete'=>'restrict']],'migration_id'=>50]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_sequences', 60, 'b4_registrations_b4_registration_id_seq', ['type'=>'sequence_delete','schema'=>'','name'=>'b4_registrations_b4_registration_id_seq','data'=>['owner'=>'root','full_sequence_name'=>'b4_registrations_b4_registration_id_seq','full_table_name'=>'b4_registrations','type'=>'tenant_simple','prefix'=>NULL,'suffix'=>NULL,'length'=>0],'migration_id'=>60]);
		$this->process('delete_tables', 10, 'b4_registrations', ['type'=>'table_delete','schema'=>'','name'=>'b4_registrations','data'=>['columns'=>['b4_registration_tenant_id'=>['domain'=>'tenant_id','type'=>'integer','default'=>NULL],'b4_registration_id'=>['domain'=>'big_id_sequence','type'=>'bigserial','sequence'=>1],'b4_registration_register_id'=>['domain'=>'big_id','type'=>'bigint','default'=>NULL],'b4_registration_timestamp'=>['domain'=>'timestamp_now','type'=>'timestamp','default'=>'now()','null'=>false],'b4_registration_period_id'=>['domain'=>'group_id','type'=>'integer','default'=>NULL],'b4_registration_period_code'=>['domain'=>'code','type'=>'varchar','length'=>255],'b4_registration_in_group_id'=>['domain'=>'group_id','type'=>'integer','default'=>NULL],'b4_registration_child_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_parents_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_parish'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true],'b4_registration_grade'=>['type'=>'smallint','default'=>0],'b4_registration_age'=>['type'=>'smallint','default'=>0],'b4_registration_date_of_birth'=>['type'=>'date'],'b4_registration_address1'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_address2'=>['domain'=>'name','type'=>'varchar','length'=>120,'null'=>true],'b4_registration_city'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_postal_code'=>['domain'=>'postal_code','type'=>'varchar','length'=>15],'b4_registration_country_code'=>['domain'=>'country_code','type'=>'char','length'=>2],'b4_registration_province_code'=>['domain'=>'province_code','type'=>'varchar','length'=>30],'b4_registration_email'=>['domain'=>'email','type'=>'varchar','length'=>255,'null'=>true],'b4_registration_phone'=>['domain'=>'phone','type'=>'varchar','length'=>50,'null'=>true],'b4_registration_emergency_line1'=>['type'=>'text','null'=>true],'b4_registration_emergency_line2'=>['type'=>'text','null'=>true],'b4_registration_prefered_language_preference'=>['type'=>'smallint','default'=>0],'b4_registration_first_time'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_signature'=>['domain'=>'signature','type'=>'text','null'=>true],'b4_registration_medical_signing_date'=>['type'=>'date'],'b4_registration_medical_health_card_number'=>['domain'=>'code','type'=>'varchar','length'=>255],'b4_registration_medical_doctors_contact'=>['type'=>'text','null'=>true],'b4_registration_medical_alergies_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_alergies_details'=>['type'=>'text','null'=>true],'b4_registration_medical_immunization_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_medication_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_medication_details'=>['type'=>'text','null'=>true],'b4_registration_medical_special_food_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_special_food_details'=>['type'=>'text','null'=>true],'b4_registration_medical_other_issues_details'=>['type'=>'text','null'=>true],'b4_registration_medical_special_need_flag'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_special_need_details'=>['type'=>'text','null'=>true],'b4_registration_medical_drug_acetaminophen'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_ibuprofen'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_polysporin'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antacids'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antihistamines'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_decongestants'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_hydrocortisone'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_cough_drops'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_antiseptic_solutions'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_anti_emetics'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_drug_bismuth_subsalicylate'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_non_prescription_medication'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_medical_no_non_prescription_medication'=>['type'=>'boolean','default'=>0,'null'=>0],'b4_registration_waiver_signature'=>['domain'=>'signature','type'=>'text','null'=>true],'b4_registration_waiver_signing_date'=>['type'=>'date'],'b4_registration_waiver_child_name'=>['domain'=>'name','type'=>'varchar','length'=>120],'b4_registration_medical_period_start'=>['type'=>'date'],'b4_registration_medical_period_end'=>['type'=>'date'],'b4_registration_tshirt_size'=>['type'=>'smallint','default'=>0],'b4_registration_inactive'=>['type'=>'boolean','default'=>0,'null'=>0]],'owner'=>'root','engine'=>['MySQLi'=>'InnoDB'],'full_table_name'=>'b4_registrations'],'migration_id'=>10]);
	}
}