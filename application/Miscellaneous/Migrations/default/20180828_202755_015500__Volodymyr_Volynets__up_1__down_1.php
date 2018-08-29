<?php

class Numbers_Backend_Db_Common_Migration_Template_20180828_202755_015500__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_indexes', 10, 'b4_registrations.b4_registrations_fulltext_idx', ['type'=>'index_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registrations_fulltext_idx','data'=>['type'=>'fulltext','columns'=>[0=>'b4_registration_child_name',1=>'b4_registration_parents_name',2=>'b4_registration_parish',3=>'b4_registration_email',4=>'b4_registration_phone'],'full_table_name'=>'b4_registrations'],'migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_indexes', 10, 'b4_registrations.b4_registrations_fulltext_idx', ['type'=>'index_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registrations_fulltext_idx','data'=>['type'=>'fulltext','columns'=>[0=>'b4_registration_child_name',1=>'b4_registration_parents_name',2=>'b4_registration_parish',3=>'b4_registration_email',4=>'b4_registration_phone'],'full_table_name'=>'b4_registrations'],'migration_id'=>10]);
	}
}