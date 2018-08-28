<?php

class Numbers_Backend_Db_Common_Migration_Template_20180828_140104_683100__Volodymyr_Volynets__up_15__down_15 extends \Numbers\Backend\Db\Common\Migration\Base {

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
		$this->process('delete_functions', 80, 'MySQLi..nextval', ['type'=>'function_delete','schema'=>'','name'=>'nextval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval','header'=>'nextval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION nextval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	UPDATE sm_sequences SET sm_sequence_counter = last_insert_id(sm_sequence_counter + 1) WHERE sm_sequence_name = sequence_name;
	RETURN last_insert_id();
END;'],'migration_id'=>80]);
		$this->process('delete_functions', 90, 'MySQLi..currval', ['type'=>'function_delete','schema'=>'','name'=>'currval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval','header'=>'currval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION currval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequences WHERE sm_sequence_name = sequence_name;
	RETURN result;
END;'],'migration_id'=>90]);
		$this->process('delete_functions', 100, 'MySQLi..nextval_extended', ['type'=>'function_delete','schema'=>'','name'=>'nextval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval_extended','header'=>'nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	IF result IS NOT NULL THEN
		SET result = result + 1;
		UPDATE sm_sequence_extended SET sm_sequence_counter = result WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	ELSE
		INSERT INTO sm_sequence_extended (
			sm_sequence_name,
			sm_sequence_tenant_id,
			sm_sequence_module_id,
			sm_sequence_description,
			sm_sequence_type,
			sm_sequence_prefix,
			sm_sequence_length,
			sm_sequence_suffix,
			sm_sequence_counter
		)
		SELECT
			sm_sequence_name sm_sequence_name,
			tenant_id sm_sequence_tenant_id,
			module_id sm_sequence_module_id,
			sm_sequence_description sm_sequence_description,
			sm_sequence_type sm_sequence_type,
			sm_sequence_prefix sm_sequence_prefix,
			sm_sequence_length sm_sequence_length,
			sm_sequence_suffix sm_sequence_suffix,
			1 sm_sequence_counter
		FROM sm_sequences
		WHERE sm_sequence_name = sequence_name;
		SET result = 1;
	END IF;
	RETURN result;
END;'],'migration_id'=>100]);
		$this->process('delete_functions', 110, 'MySQLi..currval_extended', ['type'=>'function_delete','schema'=>'','name'=>'currval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval_extended','header'=>'currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	RETURN result;
END;'],'migration_id'=>110]);
		$this->process('delete_columns', 40, 'b4_registrations.b4_registration_grade', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_grade','data'=>[],'data_old'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>40]);
		$this->process('delete_columns', 50, 'b4_registrations.b4_registration_age', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_age','data'=>[],'data_old'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>50]);
		$this->process('delete_columns', 60, 'b4_registrations.b4_registration_emergency_line1', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line1','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>60]);
		$this->process('delete_columns', 70, 'b4_registrations.b4_registration_emergency_line2', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line2','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>70]);
		$this->process('new_columns', 10, 'b4_register.b4_register_children', ['type'=>'column_new','schema'=>'','table'=>'b4_register','name'=>'b4_register_children','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_register','migration_id'=>10]);
		$this->process('new_columns', 20, 'b4_registrations.b4_registration_first_signature', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signature','data'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>20]);
		$this->process('new_columns', 30, 'b4_registrations.b4_registration_first_signing_date', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signing_date','data'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>30]);
		$this->process('new_functions', 80, 'MySQLi..nextval', ['type'=>'function_new','schema'=>'','name'=>'nextval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval','header'=>'nextval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION nextval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	UPDATE sm_sequences SET sm_sequence_counter = last_insert_id(sm_sequence_counter + 1) WHERE sm_sequence_name = sequence_name;
	RETURN last_insert_id();
END;'],'migration_id'=>80]);
		$this->process('new_functions', 90, 'MySQLi..currval', ['type'=>'function_new','schema'=>'','name'=>'currval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval','header'=>'currval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION currval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequences WHERE sm_sequence_name = sequence_name;
	RETURN result;
END;'],'migration_id'=>90]);
		$this->process('new_functions', 100, 'MySQLi..nextval_extended', ['type'=>'function_new','schema'=>'','name'=>'nextval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval_extended','header'=>'nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	IF result IS NOT NULL THEN
		SET result = result + 1;
		UPDATE sm_sequence_extended SET sm_sequence_counter = result WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	ELSE
		INSERT INTO sm_sequence_extended (
			sm_sequence_name,
			sm_sequence_tenant_id,
			sm_sequence_module_id,
			sm_sequence_description,
			sm_sequence_type,
			sm_sequence_prefix,
			sm_sequence_length,
			sm_sequence_suffix,
			sm_sequence_counter
		)
		SELECT
			sm_sequence_name sm_sequence_name,
			tenant_id sm_sequence_tenant_id,
			module_id sm_sequence_module_id,
			sm_sequence_description sm_sequence_description,
			sm_sequence_type sm_sequence_type,
			sm_sequence_prefix sm_sequence_prefix,
			sm_sequence_length sm_sequence_length,
			sm_sequence_suffix sm_sequence_suffix,
			1 sm_sequence_counter
		FROM sm_sequences
		WHERE sm_sequence_name = sequence_name;
		SET result = 1;
	END IF;
	RETURN result;
END;'],'migration_id'=>100]);
		$this->process('new_functions', 110, 'MySQLi..currval_extended', ['type'=>'function_new','schema'=>'','name'=>'currval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval_extended','header'=>'currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	RETURN result;
END;'],'migration_id'=>110]);
	}

	/**
	 * Migrate down
	 *
	 * Throw exceptions if something fails!!!
	 */
	public function down() {
		$this->process('delete_functions', 80, 'MySQLi..nextval', ['type'=>'function_delete','schema'=>'','name'=>'nextval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval','header'=>'nextval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION nextval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	UPDATE sm_sequences SET sm_sequence_counter = last_insert_id(sm_sequence_counter + 1) WHERE sm_sequence_name = sequence_name;
	RETURN last_insert_id();
END;'],'migration_id'=>80]);
		$this->process('delete_functions', 90, 'MySQLi..currval', ['type'=>'function_delete','schema'=>'','name'=>'currval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval','header'=>'currval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION currval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequences WHERE sm_sequence_name = sequence_name;
	RETURN result;
END;'],'migration_id'=>90]);
		$this->process('delete_functions', 100, 'MySQLi..nextval_extended', ['type'=>'function_delete','schema'=>'','name'=>'nextval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval_extended','header'=>'nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	IF result IS NOT NULL THEN
		SET result = result + 1;
		UPDATE sm_sequence_extended SET sm_sequence_counter = result WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	ELSE
		INSERT INTO sm_sequence_extended (
			sm_sequence_name,
			sm_sequence_tenant_id,
			sm_sequence_module_id,
			sm_sequence_description,
			sm_sequence_type,
			sm_sequence_prefix,
			sm_sequence_length,
			sm_sequence_suffix,
			sm_sequence_counter
		)
		SELECT
			sm_sequence_name sm_sequence_name,
			tenant_id sm_sequence_tenant_id,
			module_id sm_sequence_module_id,
			sm_sequence_description sm_sequence_description,
			sm_sequence_type sm_sequence_type,
			sm_sequence_prefix sm_sequence_prefix,
			sm_sequence_length sm_sequence_length,
			sm_sequence_suffix sm_sequence_suffix,
			1 sm_sequence_counter
		FROM sm_sequences
		WHERE sm_sequence_name = sequence_name;
		SET result = 1;
	END IF;
	RETURN result;
END;'],'migration_id'=>100]);
		$this->process('delete_functions', 110, 'MySQLi..currval_extended', ['type'=>'function_delete','schema'=>'','name'=>'currval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval_extended','header'=>'currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	/* [[[SQL Version: 1.0.0]]] */
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	RETURN result;
END;'],'migration_id'=>110]);
		$this->process('delete_columns', 10, 'b4_register.b4_register_children', ['type'=>'column_delete','schema'=>'','table'=>'b4_register','name'=>'b4_register_children','data'=>[],'data_old'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_register','migration_id'=>10]);
		$this->process('delete_columns', 20, 'b4_registrations.b4_registration_first_signature', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signature','data'=>[],'data_old'=>['domain'=>'signature','type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>20]);
		$this->process('delete_columns', 30, 'b4_registrations.b4_registration_first_signing_date', ['type'=>'column_delete','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_first_signing_date','data'=>[],'data_old'=>['type'=>'date','null'=>false,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'full_table_name'=>'b4_registrations','migration_id'=>30]);
		$this->process('new_columns', 40, 'b4_registrations.b4_registration_grade', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_grade','data'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>40]);
		$this->process('new_columns', 50, 'b4_registrations.b4_registration_age', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_age','data'=>['type'=>'smallint','default'=>0,'null'=>false,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>50]);
		$this->process('new_columns', 60, 'b4_registrations.b4_registration_emergency_line1', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line1','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>60]);
		$this->process('new_columns', 70, 'b4_registrations.b4_registration_emergency_line2', ['type'=>'column_new','schema'=>'','table'=>'b4_registrations','name'=>'b4_registration_emergency_line2','data'=>['type'=>'text','null'=>true,'default'=>NULL,'length'=>0,'precision'=>0,'scale'=>0,'sequence'=>false,'sql_type'=>NULL],'data_old'=>[],'full_table_name'=>'b4_registrations','migration_id'=>70]);
		$this->process('new_functions', 80, 'MySQLi..nextval', ['type'=>'function_new','schema'=>'','name'=>'nextval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval','header'=>'nextval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION nextval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	UPDATE sm_sequences SET sm_sequence_counter = last_insert_id(sm_sequence_counter + 1) WHERE sm_sequence_name = sequence_name;
	RETURN last_insert_id();
END;'],'migration_id'=>80]);
		$this->process('new_functions', 90, 'MySQLi..currval', ['type'=>'function_new','schema'=>'','name'=>'currval','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval','header'=>'currval(sequence_name varchar(255))','definition'=>'CREATE FUNCTION currval(sequence_name varchar(255)) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequences WHERE sm_sequence_name = sequence_name;
	RETURN result;
END;'],'migration_id'=>90]);
		$this->process('new_functions', 100, 'MySQLi..nextval_extended', ['type'=>'function_new','schema'=>'','name'=>'nextval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'nextval_extended','header'=>'nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION nextval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	IF result IS NOT NULL THEN
		SET result = result + 1;
		UPDATE sm_sequence_extended SET sm_sequence_counter = result WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	ELSE
		INSERT INTO sm_sequence_extended (
			sm_sequence_name,
			sm_sequence_tenant_id,
			sm_sequence_module_id,
			sm_sequence_description,
			sm_sequence_type,
			sm_sequence_prefix,
			sm_sequence_length,
			sm_sequence_suffix,
			sm_sequence_counter
		)
		SELECT
			sm_sequence_name sm_sequence_name,
			tenant_id sm_sequence_tenant_id,
			module_id sm_sequence_module_id,
			sm_sequence_description sm_sequence_description,
			sm_sequence_type sm_sequence_type,
			sm_sequence_prefix sm_sequence_prefix,
			sm_sequence_length sm_sequence_length,
			sm_sequence_suffix sm_sequence_suffix,
			1 sm_sequence_counter
		FROM sm_sequences
		WHERE sm_sequence_name = sequence_name;
		SET result = 1;
	END IF;
	RETURN result;
END;'],'migration_id'=>100]);
		$this->process('new_functions', 110, 'MySQLi..currval_extended', ['type'=>'function_new','schema'=>'','name'=>'currval_extended','backend'=>'MySQLi','data'=>['owner'=>'root','full_function_name'=>'currval_extended','header'=>'currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer)','definition'=>'CREATE FUNCTION currval_extended(sequence_name varchar(255), tenant_id integer, module_id integer) RETURNS BIGINT
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE result BIGINT;
	SELECT sm_sequence_counter INTO result FROM sm_sequence_extended WHERE sm_sequence_name = sequence_name AND sm_sequence_tenant_id = tenant_id AND sm_sequence_module_id = module_id;
	RETURN result;
END;'],'migration_id'=>110]);
	}
}