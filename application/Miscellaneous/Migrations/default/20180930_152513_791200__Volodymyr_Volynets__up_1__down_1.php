<?php

class Numbers_Backend_Db_Common_Migration_Template_20180930_152513_791200__Volodymyr_Volynets__up_1__down_1 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('new_functions', 10, 'MySQLi..setval', ['type'=>'function_new','schema'=>'','name'=>'setval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'setval','header'=>'setval(sequence_name varchar(255), sequence_counter bigint)','definition'=>'CREATE FUNCTION setval(sequence_name varchar(255), sequence_counter bigint) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	UPDATE sm_sequences SET sm_sequence_counter = sequence_counter WHERE sm_sequence_name = sequence_name;
	RETURN sequence_counter;
END;','sql_version'=>'1.0.0'],'migration_id'=>10]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_functions', 10, 'MySQLi..setval', ['type'=>'function_delete','schema'=>'','name'=>'setval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'setval','header'=>'setval(sequence_name varchar(255), sequence_counter bigint)','definition'=>'CREATE FUNCTION setval(sequence_name varchar(255), sequence_counter bigint) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	UPDATE sm_sequences SET sm_sequence_counter = sequence_counter WHERE sm_sequence_name = sequence_name;
	RETURN sequence_counter;
END;','sql_version'=>'1.0.0'],'migration_id'=>10]);
	}
}