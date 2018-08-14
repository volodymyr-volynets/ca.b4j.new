<?php

namespace Numbers\Internalization\Internalization;
class Base {

	/**
	 * Translations
	 *
	 * @var array
	 */
	private static $translations = [];

	/**
	 * Missing translations
	 *
	 * @var array
	 */
	private static $missing = [];

	/**
	 * Options
	 *
	 * @var array
	 */
	public static $options;

	/**
	 * Initialize
	 *
	 * @param array $options
	 */
	public function init(array $options) : array {
		// load groups
		$groups = \Numbers\Internalization\Internalization\DataSource\Groups::getStatic();
		$group_id = \Application::get('flag.global.__in_group_id');
		$final_group = [];
		if (!empty($groups[$group_id])) {
			$final_group = $groups[$group_id];
		} else if (!empty($options['group_id']) && !empty($groups[$options['group_id']])) {
			$final_group = $groups[$options['group_id']];
		}
		if (!empty($final_group)) {
			$options = array_merge_hard($options, $final_group);
		}
		// user settings
		$user_settings = \User::get('internalization');
		if (!empty($user_settings)) {
			foreach ($user_settings as $k => $v) if (empty($v)) unset($user_settings[$k]);
		}
		$options = self::$options = array_merge_hard($options, $user_settings);
		return $options;
	}

	/**
	 * Get
	 *
	 * @param int $i18n
	 * @param mixed $text
	 * @param array $options
	 */
	public function get($i18n, $text, array $options = []) {
		// lazy load translations
		$from_language = $options['from_language'] ?? 'sm0';
		$to_language = self::$options['language_code'] ?? 'sm0';
		$organization_id = self::$options['organization_id'] ?? 0;
		if (!isset(self::$translations[$from_language][$to_language])) {
			$this->loadTranslations($from_language, $to_language, $organization_id, 0);
		}
		// try to ge it by i18n
		$i18n = abs(intval($i18n));
		$translated = false;
		if (empty($i18n)) {
			// some texts we skip
			if (in_array($text . '', [' ', '&nbsp;', '-', '', '  '])) {
				$result = $text;
				$skip_translation_symbol = true;
				goto finish;
			}
			// integers and floats
			if (is_numeric($text)) {
				$result = \Format::id($text);
				$skip_translation_symbol = true;
				goto finish;
			}
		}
		// if we have i18n
		if (!empty($i18n) && isset(self::$translations[$from_language][$to_language]['i18n::id::' . $i18n])) {
			$result = self::$translations[$from_language][$to_language]['i18n::id::' . $i18n];
			goto finish;
		}
		// we translate if language is not system
		if ($to_language != 'sm0') {
			// continue logic
			$hash = $text;
			if (strlen($hash) > 40) {
				$hash = sha1($hash);
			}
			if (array_key_exists($hash, self::$translations[$from_language][$to_language])) {
				$result = self::$translations[$from_language][$to_language][$hash];
				$translated = true;
			} else {
				$result = $text;
				// put data into missing
				if ($to_language != 'eng' && $to_language != 'sm0' && \Tenant::id() <= 1) {
					self::$missing[$from_language][$to_language][$result] = 1;
				}
			}
		} else {
			$result = $text;
		}
finish:
		// append translation symbol for system language
		if (\Debug::$debug && empty($options['skip_i_symbol']) && \Application::get('flag.global.__content_type') == 'text/html' && empty($skip_translation_symbol) && empty($options['skip_translation_symbol']) && $to_language == 'sm0') {
			$color = $translated ? 'blue' : 'red';
			$result.= '<span style="color: ' . $color . '; font-weight: bold:"><span style="display:none"> (</span>i<span style="display:none">)</span></span>';
		}
		return $result;
	}

	/**
	 * Load translations
	 *
	 * @param string $from_language
	 * @param string $to_language
	 * @param int $organization_id
	 * @param int $javascript
	 */
	private function loadTranslations(string $from_language, string $to_language, int $organization_id, int $javascript) {
		$model = new \Numbers\Internalization\Internalization\DataSource\Translations();
		self::$translations[$from_language][$to_language] = $model->get(['where' => [
			'from_language' => $from_language,
			'to_language' => $to_language,
			'organization_id' => $organization_id,
			'javascript' => $javascript
		]]);
	}

	/**
	 * Destroy
	 */
	public function destroy() {
		if (!empty(self::$missing)) {
			$model = new \Numbers\Internalization\Internalization\Model\Translation\Missing();
			$model->db_object->begin();
			// step 1. create temporary table, insert missing translations
			$model->db_object->createTempTable('temp_missing_translations', [
				'from_language_code' => ['type' => 'text'],
				'from_text' => ['type' => 'text'],
				'to_language_code' => ['type' => 'text'],
				'organization_id' => ['domain' => 'organization_id', 'null' => true]
			]);
			$data = [];
			foreach (self::$missing as $k => $v) {
				foreach ($v as $k2 => $v2) {
					foreach ($v2 as $k3 => $v4) {
						$data[] = [
							'from_language_code' => $k,
							'from_text' => $k3,
							'to_language_code' => $k2,
							'organization_id' => self::$options['organization_id']
						];
					}
				}
			}
			$model->db_object->insert('temp_missing_translations', $data);
			// step 2. create non existing translations
			$query = $model->queryBuilder()->insert();
			$query->columns([
				'in_translmiss_tenant_id',
				'in_translmiss_id',
				'in_translmiss_from_language_code',
				'in_translmiss_from_text',
				'in_translmiss_to_language_code',
				'in_translmiss_organization_id'
			]);
			$query->values(function(& $query) use ($model) {
				$query->select()->from('temp_missing_translations', 'a');
				$query->columns([
					'in_translmiss_tenant_id' => \Tenant::id(),
					'in_translmiss_id' => "nextval_extended(" . $model->db_object->cast("'in_translation_missing_in_translmiss_id_seq'", "varchar") . ", " . \Tenant::id() . ", 0)",
					'in_translmiss_from_language_code' => 'a.from_language_code',
					'in_translmiss_from_text' => 'a.from_text',
					'in_translmiss_to_language_code' => 'a.to_language_code',
					'in_translmiss_organization_id' => 'a.organization_id'
				]);
				// join
				$query->join('LEFT', new \Numbers\Internalization\Internalization\Model\Translation\Missing(), 'b', 'ON', [
					['AND', ['b.in_translmiss_from_language_code', '=', 'a.from_language_code', true], false],
					['AND', ['b.in_translmiss_from_text', '=', 'a.from_text', true], false],
					['AND', ['b.in_translmiss_to_language_code', '=', 'a.to_language_code', true], false]
				]);
				$query->join('LEFT', new \Numbers\Internalization\Internalization\Model\Translations(), 'c', 'ON', [
					['AND', ['c.in_translation_from_language_code', '=', 'a.from_language_code', true], false],
					['AND', ['c.in_translation_from_text', '=', 'a.from_text', true], false],
					['AND', ['c.in_translation_to_language_code', '=', 'a.to_language_code', true], false]
				]);
				// where
				$query->where('AND', ['b.in_translmiss_from_language_code', 'IS', null]);
				$query->where('AND', ['c.in_translation_from_language_code', 'IS', null]);
			});
			$query->query();
			// commit
			$model->db_object->commit();
		}
	}
}