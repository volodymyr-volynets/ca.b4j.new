<?php

namespace Numbers\Backend\Db\MySQLi;
class DDL extends \Numbers\Backend\Db\Common\DDL implements \Numbers\Backend\Db\Common\Interface2\DDL {

	/**
	 * Extra queries
	 *
	 * @var array
	 */
	public static $extra = [];

	/**
	 * Column SQL type
	 *
	 * @param array $column
	 * @return array
	 */
	public function columnSqlType($column) {
		// presetting
		$column = $this->columnSqlTypeBase($column);
		// simple switch would do the work
		switch ($column['type']) {
			case 'boolean':
				$column['sql_type'] = 'tinyint';
				break;
			case 'smallserial':
			case 'serial':
			case 'bigserial':
				$column['sql_type'] = str_replace('serial', 'int', $column['type']);
				// 'auto_increment' => 1, there are issues with auto increment in MySQL, it does not work as a sequence
				break;
			case 'integer':
				$column['sql_type'] = 'int';
				break;
			case 'bcnumeric':
			case 'numeric':
				if ($column['precision'] > 0) {
					$column['sql_type'] = 'decimal(' . $column['precision'] . ',' . $column['scale'] . ')';
				} else {
					$column['sql_type'] = 'decimal(30,10)';
				}
				break;
			case 'char':
				$column['sql_type'] = 'char(' . $column['length'] . ')';
				break;
			case 'varchar':
				$column['sql_type'] = 'varchar(' . $column['length'] . ')';
				break;
			case 'json':
				$column['sql_type'] = 'json';
				break;
			case 'time':
				$column['sql_type'] = 'time';
				break;
			case 'datetime':
				$column['sql_type'] = 'datetime';
				break;
			case 'timestamp':
				$column['sql_type'] = 'datetime(6)';
				break;
			default:
				$column['sql_type'] = $column['type'];
		}
		return $column;
	}

	/**
	 * Load database schema
	 *
	 * @param string $db_link
	 * @return array
	 */
	public function loadSchema($db_link) {
		$result = [
			'success' => false,
			'error' => [],
			'data' => [],
			'count' => []
		];
		$sequence_model = \Factory::model('\Numbers\Backend\Db\Common\Model\Sequences');
		$db_object = new \Db($db_link);
		// getting information
		foreach (['schemas', 'sequences', 'columns', 'constraints', 'functions', 'triggers', 'views', 'checks'] as $v) {
			// we only load sequences if we have a sequence table
			if ($v == 'sequences') {
				if (!$sequence_model->dbPresent()) {
					continue;
				}
			}
			$temp = $this->loadSchemaDetails($v, $db_link);
			if (!$temp['success']) {
				$result['error'] = array_merge($result['error'], $temp['error']);
			} else {
				switch ($v) {
					case 'columns':
						$tables = [];
						// small conversion for columns
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								foreach ($v3 as $k4 => $v4) {
									// full table name
									if ($k2 == '') {
										$full_table_name = $v4['table_name'];
									} else {
										$full_table_name = $v4['schema_name'] . '.' . $v4['table_name'];
									}
									// preset empty table
									if (!isset($tables[$full_table_name])) {
										$tables[$full_table_name] = [
											'type' => 'table',
											'schema' => $k2,
											'name' => $v4['table_name'],
											'data' => [
												'columns' => [],
												'owner' => $v4['table_owner'],
												'engine' => [],
												'full_table_name' => $full_table_name
											]
										];
									}
									// processing type
									if (in_array($v4['type'], ['tinyint', 'smallint', 'int', 'bigint'])) {
										$sql_type = $type = $v4['type'];
									} else if ($v4['type'] == 'decimal') {
										$type = 'numeric';
										$sql_type = $v4['full_type'];
									} else {
										$sql_type = $type = $v4['full_type'];
									}
									// processing default
									$default = $v4['default'];
									if ($default !== null) {
										if (in_array($v4['type'], ['tinyint', 'smallint', 'int', 'bigint'])) {
											$default = (int) $default;
										} else if ($v4['type'] == 'decimal') {
											$default = (float) $default;
										} else if (is_string($default) && strpos($default, 'CURRENT_TIMESTAMP') !== false) {
											$default = 'now()';
										}
									}
									// see if column is a sequence
									$sequence = false;
									if (!empty($this->objects[$db_link]['sequence'][''][$full_table_name . '_' . $k4 . '_seq'])) {
										$sequence = true;
									}
									// putting column back into array
									$tables[$full_table_name]['data']['columns'][$k4] = [
										'type' => $type,
										'null' => !empty($v4['null']) ? true : false,
										'default' => $default,
										'length' => (int) $v4['length'],
										'precision' => (int) $v4['precision'],
										'scale' => (int) $v4['scale'],
										'sequence' => $sequence,
										'sql_type' => $sql_type
									];
								}
							}
						}
						// add tables
						foreach ($tables as $v2) {
							$this->objectAdd($v2, $db_link);
						}
						break;
					case 'constraints':
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								foreach ($v3 as $k4 => $v4) {
									foreach ($v4 as $k5 => $v5) {
										$constraint_type = 'constraint';
										$full_table_name = $v5['schema_name'] . '.' . $v5['table_name'];
										if ($v5['constraint_type'] == 'PRIMARY KEY') {
											if ($k5 == 'PRIMARY') {
												$k5 = $v5['table_name'] . '_pk';
											}
											$temp2 = [
												'type' => 'pk',
												'columns' => explode(',', $v5['column_names']),
												'full_table_name' => $full_table_name
											];
										} else if ($v5['constraint_type'] == 'UNIQUE') {
											$temp2 = [
												'type' => 'unique',
												'columns' => explode(',', $v5['column_names']),
												'full_table_name' => $full_table_name
											];
										} else if ($v5['constraint_type'] == 'INDEX') {
											$temp2 = [
												'type' => strtolower($v5['index_type']),
												'columns' => explode(',', $v5['column_names']),
												'full_table_name' => $full_table_name
											];
											$constraint_type = 'index';
										} else if ($v5['constraint_type'] == 'FOREIGN KEY') {
											$foreign_table_name = $v5['schema_name'] . '.' . $v5['foreign_table_name'];
											$temp2 = [
												'type' => 'fk',
												'columns' => explode(',', $v5['column_names']),
												'foreign_table' => $foreign_table_name,
												'foreign_columns' => explode(',', $v5['foreign_column_names']),
												'options' => [
													'match' => 'simple',
													'update' => 'cascade',
													'delete' => 'restrict'
												],
												'name' => $v5['constraint_name'],
												'full_table_name' => $full_table_name
											];
										}
										// add constraint
										$this->objectAdd([
											'type' => $constraint_type,
											'schema' => $k3,
											'table' => $v5['table_name'],
											'name' => $k5,
											'data' => $temp2
										], $db_link);
									}
								}
							}
						}
						break;
					case 'sequences':
						// load sequence attributes
						$sequence_attributes = $sequence_model->get();
						// add sequences
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								$full_sequence_name = ltrim($v3['schema_name'] . '.' . $v3['sequence_name'], '.');
								$this->objectAdd([
									'type' => 'sequence',
									'schema' => $v3['schema_name'],
									'name' => $v3['sequence_name'],
									'data' => [
										'owner' => $v3['sequence_owner'],
										'full_sequence_name' => $full_sequence_name,
										'full_table_name' => '',
										'type' => $sequence_attributes[$full_sequence_name]['sm_sequence_type'] ?? 'global_simple',
										'prefix' => $sequence_attributes[$full_sequence_name]['sm_sequence_prefix'] ?? '',
										'suffix' => $sequence_attributes[$full_sequence_name]['sm_sequence_suffix'] ?? '',
										'length' => $sequence_attributes[$full_sequence_name]['sm_sequence_length'] ?? 0
									]
								], $db_link);
							}
						}
						break;
					case 'schemas':
						foreach ($temp['data'] as $k2 => $v2) {
							$this->objectAdd([
								'type' => 'schema',
								'name' => $v2['name'],
								'data' => [
									'owner' => $v2['owner'],
									'name' => $v2['name']
								]
							], $db_link);
						}
						break;
					case 'functions':
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								$full_function_name = ltrim($v3['schema_name'] . '.' . $v3['function_name'], '.');
								// add object
								$this->objectAdd([
									'type' => 'function',
									'schema' => $k2,
									'name' => $k3,
									'backend' => 'MySQLi',
									'data' => [
										'owner' => $v3['function_owner'],
										'full_function_name' => $full_function_name,
										'header' => null,
										'definition' => $v3['routine_definition'],
										'sql_version' => $v3['sql_version']
									]
								], $db_link);
							}
						}
						break;
					case 'triggers':
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								$full_function_name = ltrim($v3['schema_name'] . '.' . $v3['function_name'], '.');
								// get definition
								$definition = $db_object->query('SHOW CREATE TRIGGER ' . $full_function_name);
								$temp = explode(' TRIGGER ', $definition['rows'][0]['sql original statement']);
								$definition = 'CREATE TRIGGER ' . $temp[1] . ';';
								// add object
								$this->objectAdd([
									'type' => 'trigger',
									'schema' => $k2,
									'name' => $k3,
									'backend' => 'MySQLi',
									'data' => [
										'full_function_name' => $full_function_name,
										'full_table_name' => $v3['full_table_name'],
										'header' => $full_function_name,
										'definition' => $definition,
										'sql_version' => $v3['sql_version']
									]
								], $db_link);
							}
						}
						break;
					case 'views':
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								// add object
								$this->objectAdd([
									'type' => 'view',
									'schema' => $k2,
									'name' => $k3,
									'backend' => 'MySQLi',
									'data' => [
										'owner' => $v3['view_owner'],
										'full_view_name' => $v3['full_view_name'],
										'definition' => $v3['routine_definition'],
										'sql_version' => $v3['sql_version'],
										'grant_tables' => []
									]
								], $db_link);
							}
						}
						break;
					case 'checks':
						foreach ($temp['data'] as $k2 => $v2) {
							foreach ($v2 as $k3 => $v3) {
								$full_check_name = ltrim($v3['schema_name'] . '.' . $v3['function_name'], '.');
								// get definitions
								$definitions = [];
								$definition = $db_object->query('SHOW CREATE TRIGGER ' . $full_check_name . '_insert');
								$temp = explode(' TRIGGER ', $definition['rows'][0]['sql original statement']);
								$definition = 'CREATE TRIGGER ' . $temp[1] . ';';
								$definitions[] = $definition;
								$definition = $db_object->query('SHOW CREATE TRIGGER ' . $full_check_name . '_update');
								$temp = explode(' TRIGGER ', $definition['rows'][0]['sql original statement']);
								$definition = 'CREATE TRIGGER ' . $temp[1] . ';';
								$definitions[] = $definition;
								// add object
								$this->objectAdd([
									'type' => 'check',
									'schema' => $k2,
									'name' => $k3,
									'backend' => 'MySQLi',
									'data' => [
										'full_check_name' => $full_check_name,
										'full_table_name' => $v3['full_table_name'],
										'definition' => $definitions,
										'sql_version' => $v3['sql_version']
									]
								], $db_link);
							}
						}
						break;
					default:
						// nothing
				}
			}
		}
		if (empty($result['error'])) {
			$result['success'] = true;
		}
		$result['data'] = $this->objects;
		$result['count'] = $this->count;
		return $result;
	}

	/**
	 * Get schema details
	 *
	 * @param string $type
	 * @param string $db_link
	 * @param array $options
	 * @return array
	 * @throws Exception
	 */
	public function loadSchemaDetails($type, $db_link, $options = array()) {
		$result = array(
			'success' => false,
			'error' => array(),
			'data' => array()
		);
		// we need to get database name
		$db_object = new \Db($db_link);
		$database_name = $db_object->object->connect_options['dbname'];
		$owner = $db_object->object->connect_options['username'];
		// check for metadata table
		$metadata_model = new \Numbers\Backend\Db\Common\Model\Metadata();
		$metadata_exists = $metadata_model->dbPresent();
		// getting proper query
		switch($type) {
			case 'schemas':
				$key = array('name');
				$sql = <<<TTT
					SELECT
						DATABASE() AS name,
						'{$owner}' owner
TTT;
				break;
			case 'constraints':
				$key = ['constraint_type', 'schema_name', 'table_name', 'constraint_name'];
				$sql = <<<TTT
					SELECT
							*
					FROM (
						SELECT
							a.constraint_type,
							a.table_schema schema_name,
							a.table_name,
							a.constraint_name,
							null index_type,
							b.column_names,
							b.referenced_table_schema foreign_schema_name,
							b.referenced_table_name foreign_table_name,
							b.referenced_column_name foreign_column_names,
							null match_option,
							null update_rule,
							null delete_rule
						FROM information_schema.table_constraints a
						LEFT JOIN (
							SELECT
								table_schema schema_name,
								table_name,
								constraint_name,
								GROUP_CONCAT(column_name ORDER BY ordinal_position SEPARATOR ',') column_names,
								MAX(referenced_table_schema) referenced_table_schema,
								MAX(referenced_table_name) referenced_table_name,
								GROUP_CONCAT(referenced_column_name ORDER BY ordinal_position SEPARATOR ',') referenced_column_name
							FROM information_schema.key_column_usage c
							WHERE 1=1
								AND c.table_schema = '{$database_name}'
							GROUP BY table_schema, table_name, constraint_name
						) b ON a.table_schema = b.schema_name AND a.table_name = b.table_name AND a.constraint_name = b.constraint_name
						WHERE 1=1
							AND a.table_schema = '{$database_name}'

						UNION ALL

						SELECT
							'INDEX' constraint_type,
							a.table_schema schema_name,
							a.table_name,
							a.index_name constraint_name,
							MAX(a.index_type) index_type,
							GROUP_CONCAT(a.column_name ORDER BY a.seq_in_index SEPARATOR ',') column_names,
							null foreign_schema_name,
							null foreign_table_name,
							null foreign_column_names,
							null match_option,
							null update_rule,
							null delete_rule
						FROM (
							SELECT
								*
							FROM information_schema.statistics b
							WHERE 1=1
								AND b.table_schema = '{$database_name}'
								AND b.non_unique = 1
								AND b.index_name NOT LIKE '%_fk'
							ORDER BY b.seq_in_index
						) a
						GROUP BY a.table_schema, a.table_name, a.index_name
					) a
TTT;
				break;
			 case 'columns':
				$key = ['schema_name', 'table_name', 'column_name'];
				$sql = <<<TTT
					SELECT
						a.table_schema schema_name,
						a.table_name,
						'{$owner}' table_owner,
						a.column_name,
						a.data_type "type",
						CASE WHEN a.is_nullable = 'NO' THEN 0 ELSE 1 END "null",
						a.column_default "default",
						a.character_maximum_length "length",
						a.numeric_precision "precision",
						a.numeric_scale "scale",
						a.column_type "full_type",
						b.engine "engine",
						CASE WHEN a.extra LIKE '%auto_increment%' THEN 1 ELSE 0 END auto_increment
					FROM information_schema.columns a
					INNER JOIN (
						SELECT
							table_schema schema_name,
							table_name,
							engine
						FROM information_schema.tables
						WHERE 1=1
							AND table_schema = '{$database_name}'
							AND engine IS NOT NULL
					) b ON a.table_schema = b.schema_name AND a.table_name = b.table_name
					WHERE 1=1
						AND a.table_schema = '{$database_name}'
					ORDER BY schema_name, table_name, ordinal_position
TTT;
				break;
			case 'sequences':
				$key = ['schema_name', 'sequence_name'];
				$sql = <<<TTT
					SELECT
						substring(a.sm_sequence_name, 1, locate('.', a.sm_sequence_name) - 1) schema_name,
						substring(a.sm_sequence_name, locate('.', a.sm_sequence_name) + 1) sequence_name,
						'{$owner}' sequence_owner,
						sm_sequence_type "type",
						sm_sequence_prefix prefix,
						sm_sequence_length length,
						sm_sequence_suffix suffix
					FROM sm_sequences a
TTT;
				break;
			case 'functions':
				$key = ['schema_name', 'function_name'];
				if ($metadata_exists) {
					$sql_version = "COALESCE(mdata.sm_metadata_sql_version, '')";
					$sql_join = "LEFT JOIN {$metadata_model->full_table_name} mdata ON mdata.sm_metadata_db_link = '{$db_link}' AND mdata.sm_metadata_type = 'function' AND (mdata.sm_metadata_name COLLATE utf8_bin) = (CONCAT(a.routine_schema, '.', a.routine_name) COLLATE utf8_bin)";
				} else {
					$sql_version = "''";
					$sql_join = '';
				}
				$sql = <<<TTT
					SELECT
						a.routine_schema schema_name,
						a.routine_name function_name,
						'{$owner}' function_owner,
						a.routine_definition,
						{$sql_version} sql_version
					FROM information_schema.routines a
					{$sql_join}
					WHERE 1=1
						AND a.routine_type = 'FUNCTION'
						AND a.routine_schema = '{$database_name}'
TTT;
				break;
			case 'triggers':
				$key = ['schema_name', 'function_name'];
				if ($metadata_exists) {
					$sql_version = "COALESCE(mdata.sm_metadata_sql_version, '')";
					$sql_join = "LEFT JOIN {$metadata_model->full_table_name} mdata ON mdata.sm_metadata_db_link = '{$db_link}' AND mdata.sm_metadata_type = 'trigger' AND (mdata.sm_metadata_name COLLATE utf8_bin) = CONCAT(a.trigger_schema COLLATE utf8_bin, '.' COLLATE utf8_bin, a.trigger_name COLLATE utf8_bin)";
				} else {
					$sql_version = "''";
					$sql_join = '';
				}
				$sql = <<<TTT
					SELECT
						a.trigger_schema schema_name,
						a.trigger_name function_name,
						CONCAT(a.event_object_schema, '.', a.event_object_table) full_table_name,
						{$sql_version} sql_version
					FROM information_schema.triggers a
					{$sql_join}
					WHERE a.trigger_schema = '{$database_name}'
						AND a.trigger_name NOT LIKE '%_check_insert'
						AND a.trigger_name NOT LIKE '%_check_update'
TTT;
				break;
			case 'views':
				$key = ['schema_name', 'view_name'];
				if ($metadata_exists) {
					$sql_version = "COALESCE(mdata.sm_metadata_sql_version, '')";
					$sql_join = "LEFT JOIN {$metadata_model->full_table_name} mdata ON mdata.sm_metadata_db_link = '{$db_link}' AND mdata.sm_metadata_type = 'view' AND mdata.sm_metadata_name = CONCAT(a.table_schema, '.', a.table_name)";
				} else {
					$sql_version = "''";
					$sql_join = '';
				}
				$sql = <<<TTT
					SELECT
						a.table_schema schema_name,
						a.table_name view_name,
						a.table_name full_view_name,
						'{$owner}' view_owner,
						a.view_definition routine_definition,
						{$sql_version} sql_version
					FROM information_schema.views a
					{$sql_join}
					WHERE a.table_schema = '{$database_name}'
TTT;
				break;
			case 'checks':
				$key = ['schema_name', 'function_name'];
				if ($metadata_exists) {
					$sql_version = "COALESCE(mdata.sm_metadata_sql_version, '')";
					$sql_join = "LEFT JOIN {$metadata_model->full_table_name} mdata ON mdata.sm_metadata_db_link = '{$db_link}' AND mdata.sm_metadata_type = 'check' AND (mdata.sm_metadata_name COLLATE utf8_bin) = REPLACE(CONCAT(a.trigger_schema, '.', a.trigger_name) COLLATE utf8_bin, '_check_insert' COLLATE utf8_bin, '_check' COLLATE utf8_bin)";
				} else {
					$sql_version = "''";
					$sql_join = '';
				}
				$sql = <<<TTT
					SELECT
						a.trigger_schema schema_name,
						REPLACE(a.trigger_name, '_check_insert', '_check') function_name,
						CONCAT(a.event_object_schema COLLATE utf8_bin, '.' COLLATE utf8_bin, a.event_object_table COLLATE utf8_bin) full_table_name,
						{$sql_version} sql_version
					FROM information_schema.triggers a
					{$sql_join}
					WHERE a.trigger_schema = '{$database_name}'
						AND a.trigger_name LIKE '%_check_insert'
TTT;
				break;
			default:
				Throw new \Exception('type?');
		}
		// options
		if (!empty($options['where'])) {
			$sql = "SELECT * FROM (" . $sql . ") a WHERE 1=1 AND " . $db_object->prepareCondition($options['where'], 'AND');
		}
		$result2 = $db_object->query($sql, $key);
		if ($result2['error']) {
			$result['error'] = array_merge($result['error'], $result2['error']);
		} else {
			$result['data'] = $result2['rows'];
			$result['success'] = true;
		}
		return $result;
	}

	/**
	 * Render SQL
	 *
	 * @param string $type
	 * @param array $data
	 * @param array $options
	 *		string mode
	 * @param mixed $extra_comments
	 * @return string|array
	 * @throws Exception
	 */
	public function renderSql($type, $data, $options = [], & $extra_comments = null) {
		$result = '';
		switch ($type) {
			// columns
			case 'column_delete':
				$result = "ALTER TABLE {$data['table']} DROP COLUMN {$data['name']};";
				break;
			case 'column_new':
				$default = $data['data']['default'] ?? null;
				if (is_string($default) && $default != 'now()') {
					$default = "'" . $default . "'";
				} else if ($default === 'now()') {
					if ($data['data']['sql_type'] == 'datetime(6)') {
						$default = 'CURRENT_TIMESTAMP(6)';
					} else {
						$default = 'CURRENT_TIMESTAMP';
					}
				}
				$null = $data['data']['null'] ?? false;
				if (empty($options['column_new_no_alter'])) {
					$result = "ALTER TABLE {$data['table']} ADD COLUMN {$data['name']} {$data['data']['sql_type']}" . ($default !== null ? (' DEFAULT ' . $default) : '') . (!$null ? (' NOT NULL') : '') . ";";
				} else {
					$result = "{$data['name']} {$data['data']['sql_type']}" . ($default !== null ? (' DEFAULT ' . $default) : '') . (!$null ? (' NOT NULL') : '');
				}
				break;
			case 'column_change':
				$result = [];
				$diff = false;
				$str = $data['data_old']['sql_type'];
				if ($data['data']['sql_type'] !== $data['data_old']['sql_type']) {
					$str = $data['data']['sql_type'];
					$diff = true;
				}
				$default = $data['data_old']['default'];
				if ($data['data']['default'] !== $data['data_old']['default']) {
					$default = $data['data']['default'];
					$diff = true;
				}
				if (is_null($default)) {
					// nothing
				} else if (is_numeric($default)) {
					$str.= ' DEFAULT ' . $default;
				} else {
					$str.= " DEFAULT '{$default}'";
				}
				$null = $data['data_old']['null'];
				if ($data['data']['null'] !== $data['data_old']['null']) {
					$null = $data['data']['null'];
					$diff = true;
				}
				if (!empty($null)) {
					$str.= ' NULL';
				} else {
					$str.= ' NOT NULL';
				}
				if ($diff) {
					$result[]= "ALTER TABLE {$data['table']} CHANGE COLUMN {$data['name']} {$data['name']} {$str};";
				}
				break;
			// table
			case 'table_new':
				$columns = [];
				foreach ($data['data']['columns'] as $k => $v) {
					$columns[] = $this->renderSql('column_new', ['table' => '', 'name' => $k, 'data' => $v], ['column_new_no_alter' => true]);
				}
				$result = "CREATE TABLE {$data['data']['full_table_name']} (\n\t";
					$result.= implode(",\n\t", $columns);
					$engine = isset($data['data']['engine']['MySQLi']) ? $data['data']['engine']['MySQLi'] : 'InnoDB';
				$result.= "\n) ENGINE={$engine} DEFAULT CHARSET=utf8;";
				break;
			case 'table_delete':
				$result = "DROP TABLE {$data['data']['full_table_name']} CASCADE;";
				break;
			// view
			case 'view_new':
				$result = [];
				$result[] = "CREATE OR REPLACE VIEW {$data['data']['full_view_name']} AS {$data['data']['definition']};";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'view', $data['data']['full_view_name'], $data['data']['sql_version'], false));
				break;
			case 'view_delete':
				$result = [];
				$result[]= "DROP VIEW {$data['data']['full_view_name']};";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'view', $data['data']['full_view_name'], '', true));
				break;
			// foreign key/unique/primary key
			case 'constraint_new':
				switch ($data['data']['type']) {
					case 'pk':
						$result = "ALTER TABLE {$data['data']['full_table_name']} ADD CONSTRAINT {$data['name']} PRIMARY KEY (" . implode(", ", $data['data']['columns']) . ");";
						break;
					case 'unique':
						$result = "ALTER TABLE {$data['data']['full_table_name']} ADD CONSTRAINT {$data['name']} UNIQUE (" . implode(", ", $data['data']['columns']) . ");";
						break;
					case 'fk':
						$result = "ALTER TABLE {$data['data']['full_table_name']} ADD CONSTRAINT {$data['name']} FOREIGN KEY (" . implode(", ", $data['data']['columns']) . ") REFERENCES {$data['data']['foreign_table']} (" . implode(", ", $data['data']['foreign_columns']) . ") ON UPDATE " . strtoupper($data['data']['options']['update'] ?? 'NO ACTION') . " ON DELETE " . strtoupper($data['data']['options']['delete'] ?? 'NO ACTION') . ";";
						break;
					default:
						Throw new \Exception($data['data']['type'] . '?');
				}
				break;
			case 'constraint_delete':
				// drop primary key
				if ($data['data']['type'] == 'pk') {
					$result = "ALTER TABLE {$data['data']['full_table_name']} DROP PRIMARY KEY;";
				} else if ($data['data']['type'] == 'fk') {
					$result = "ALTER TABLE {$data['data']['full_table_name']} DROP FOREIGN KEY {$data['name']};";
				} else if ($data['data']['type'] == 'unique') {
					$result = "ALTER TABLE {$data['data']['full_table_name']} DROP INDEX {$data['name']};";
				}
				break;
			// indexes
			case 'index_new':
				// fulltext indexes as gin
				if ($data['data']['type'] == 'fulltext') {
					$result = "CREATE FULLTEXT INDEX {$data['name']} ON {$data['data']['full_table_name']} (" . implode(", ", $data['data']['columns']) . ");";
				} else {
					$result = "CREATE INDEX {$data['name']} ON {$data['data']['full_table_name']} (" . implode(", ", $data['data']['columns']) . ") USING {$data['data']['type']};";
				}
				break;
			case 'index_delete':
				$result = "DROP INDEX {$data['name']} ON {$data['data']['full_table_name']};";
				break;
			// sequences
			case 'sequence_new':
				// insert entry into sequences table
				$model = new \Numbers\Backend\Db\Common\Model\Sequences();
				if (strpos($data['data']['full_sequence_name'], '.') === false) {
					$data['data']['full_sequence_name'] = $model->schema . '.' . $data['data']['full_sequence_name'];
				}
				$result = <<<TTT
					INSERT INTO {$model->full_table_name} (
						sm_sequence_name,
						sm_sequence_description,
						sm_sequence_prefix,
						sm_sequence_length,
						sm_sequence_suffix,
						sm_sequence_counter,
						sm_sequence_type
					) VALUES (
						'{$data['data']['full_sequence_name']}',
						null,
						'{$data['data']['prefix']}',
						{$data['data']['length']},
						'{$data['data']['suffix']}',
						0,
						'{$data['data']['type']}'
					);
TTT;
				break;
			case 'sequence_delete':
				$result = [];
				if (($options['mode'] ?? '') != 'drop') {
					$model = new \Numbers\Backend\Db\Common\Model\Sequences();
					if (strpos($data['data']['full_sequence_name'], '.') === false) {
						$data['data']['full_sequence_name'] = $model->schema . '.' . $data['data']['full_sequence_name'];
					}
					$result[]= "DELETE FROM {$model->full_table_name} WHERE sm_sequence_name = '{$data['data']['full_sequence_name']}'";
				}
				break;
			// functions
			case 'function_new':
				$result = [];
				$result[]= $data['data']['definition'] . ";";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'function', $data['data']['full_function_name'], $data['data']['sql_version'], false));
				break;
			case 'function_delete':
				$result = [];
				$result[]= "DROP FUNCTION {$data['data']['full_function_name']};";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'function', $data['data']['full_function_name'], '', true));
				break;
			// trigger
			case 'trigger_new':
				$result = [];
				$result[]= trim($data['data']['definition']);
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'trigger', $data['data']['full_function_name'], $data['data']['sql_version'], false));
				break;
			case 'trigger_delete':
				$result = [];
				$result[]= "DROP TRIGGER {$data['data']['full_function_name']};";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'trigger', $data['data']['full_function_name'], '', true));
				break;
			// check
			case 'check_new':
				$result = [];
				$result = array_merge($result, $data['data']['definition']);
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'check', $data['data']['full_check_name'], $data['data']['sql_version'], false));
				break;
			case 'check_delete':
				$result = [];
				$result[]= "DROP TRIGGER {$data['data']['full_check_name']}_insert;";
				$result[]= "DROP TRIGGER {$data['data']['full_check_name']}_update;";
				$result = array_merge($result, \Numbers\Backend\Db\Common\Model\Metadata::makeSchemaChanges($options['db_link'], 'check', $data['data']['full_check_name'], '', true));
				break;
			case 'permission_grant_database':
				$result = [];
				$result[] = "CREATE USER IF NOT EXISTS {$data['owner']} IDENTIFIED WITH mysql_native_password BY '{$data['password']}';";
				$result[] = "GRANT LOCK TABLES ON {$data['database']}.* TO '{$data['owner']}';";
				$result[] = "GRANT CREATE TEMPORARY TABLES ON {$data['database']}.* TO '{$data['owner']}';";
				break;
			case 'permission_grant_schema': /* nothing */ break;
			case 'permission_grant_table':
				// DROP is needed so we can TRUNCATE
				$result = "GRANT SELECT, INSERT, UPDATE, DELETE, DROP ON {$data['table']} TO '{$data['owner']}';";
				break;
			case 'permission_grant_view':
				$result = "GRANT SELECT ON {$data['view']} TO '{$data['owner']}';";
				break;
			case 'permission_grant_sequence': /* nothing */ break;
			case 'permission_grant_function':
				$result = "GRANT EXECUTE ON FUNCTION {$data['function']} TO '{$data['owner']}';";
				break;
			case 'permission_grant_flush':
				$result = "FLUSH PRIVILEGES;";
				break;
			default:
				/* nothing */
		}
		return $result;
	}
}