<?php

namespace Numbers\Users\Documents\Base;
class Base {

	/**
	 * Fetch primary catalog
	 *
	 * @param int $organization_id
	 * @return array
	 */
	public function fetchPrimaryCatalog(int $organization_id) : array {
		$result = \Numbers\Users\Documents\Base\Model\Catalogs::getStatic([
			'where' => [
				'dt_catalog_organization_id' => $organization_id,
				'dt_catalog_primary' => 1
			],
			'pk' => null,
		]);
		return $result[0] ?? [];
	}

	/**
	 * Upload
	 *
	 * @param array $file
	 * @param array $catalog
	 * @return array
	 */
	public function upload(array $file, array $catalog) : array {
		$result = [
			'success' => false,
			'error' => [],
			'file_id' => null
		];
		// get next sequence number
		$file_save_model = new \Numbers\Users\Documents\Base\Model\Files();
		$file['file_id'] = $file_save_model->sequence('dt_file_id', 'nextval', \Tenant::id());
		// load storage
		$storages = \Numbers\Users\Documents\Base\Model\Storages::getStatic();
		$storage = $storages[$catalog['dt_catalog_storage_id']];
		$class = $storage['submodule'];
		$file_upload_model = new $class($storage);
		$file_upload_result = $file_upload_model->upload($file, $catalog);
		if (!$file_upload_result['success']) {
			$result['error'] = array_merge($result['error'], $file_upload_result['error']);
			return $result;
		}
		// create database record
		$save = [
			'dt_file_id' => $file['file_id'],
			'dt_file_storage_id' => $catalog['dt_catalog_storage_id'],
			'dt_file_catalog_code' => $catalog['dt_catalog_code'],
			'dt_file_organization_id' => $catalog['dt_catalog_organization_id'],
			'dt_file_name' => $file['name'],
			'dt_file_extension' => pathinfo($file['name'], PATHINFO_EXTENSION),
			'dt_file_mime' => $file['type'],
			'dt_file_size' => $file['size'],
			'dt_file_path' => $file_upload_result['path'],
			'dt_file_thumbnail_path' => $file_upload_result['thumbnail_path'],
			'dt_file_language_code' => \I18n::$options['language_code'] ?? null,
			'dt_file_readonly' => $catalog['dt_catalog_readonly'],
			'dt_file_temporary' => $catalog['dt_catalog_temporary'],
			'dt_file_inactive' => 0
		];
		$save_result = $file_save_model->collection()->merge($save);
		if (!$save_result['success']) {
			$result['error'] = array_merge($result['error'], $save_result['error']);
			return $result;
		}
		$result['success'] = true;
		$result['file_id'] = $file['file_id'];
		return $result;
	}

	/**
	 * Delete
	 *
	 * @param int $file_id
	 * @return array
	 */
	public function delete(int $file_id) : array {
		$result = [
			'success' => false,
			'error' => [],
		];
		$model = new \Numbers\Users\Documents\Base\Model\Files();
		$file_data = $model->get([
			'where' => [
				'dt_file_id' => $file_id,
			],
			'pk' => null
		]);
		// delete in driver
		$storages = \Numbers\Users\Documents\Base\Model\Storages::getStatic();
		$storage = $storages[$file_data[0]['dt_file_storage_id']];
		$class = $storage['submodule'];
		$file_upload_model = new $class($storage);
		$file_upload_result = $file_upload_model->delete($file_data[0]);
		if (!$file_upload_result['success']) {
			$result['error'] = array_merge($result['error'], $file_upload_result['error']);
			return $result;
		}
		// delete record
		$delete_result = $model->collection()->merge($file_data[0], [
			'flag_delete_row' => true
		]);
		if (!$delete_result['success']) {
			$result['error'] = array_merge($result['error'], $delete_result['error']);
			return $result;
		}
		$result['success'] = true;
		return $result;
	}

	/**
	 * Download
	 *
	 * @param int $file_id
	 * @param array $options
	 * @return mixed
	 */
	public function download(int $file_id, array $options = []) {
		$model = new \Numbers\Users\Documents\Base\Model\Files();
		$file_data = $model->get([
			'where' => [
				'dt_file_id' => $file_id,
			],
			'pk' => null
		]);
		if (empty($file_data[0])) return '';
		// delete in driver
		$storages = \Numbers\Users\Documents\Base\Model\Storages::getStatic();
		$storage = $storages[$file_data[0]['dt_file_storage_id']];
		$class = $storage['submodule'];
		$file_upload_model = new $class($storage);
		return $file_upload_model->download($file_data[0], $options);
	}

	/**
	 * Generate URL
	 *
	 * @param int $file_id
	 * @param bool $thumbnail
	 * @return string
	 */
	public static function generateURL(int $file_id, bool $thumbnail = false) : string {
		$crypt = new \Crypt();
		return \Request::buildURL('/Numbers/Users/Documents/Base/Controller/GetFile', [
			'token' => urldecode($crypt->tokenCreate($file_id, $thumbnail ? 'thumbnail.view' : 'file.view'))
		]);
	}

	/**
	 * Generate Icon URL
	 *
	 * @param int $file_id
	 * @param bool $thumbnail
	 * @return string
	 */
	public static function generateIconURL(string $text, int $width, int $height) : string {
		$crypt = new \Crypt();
		return \Request::buildURL('/Numbers/Users/Documents/Base/Controller/GetFile/_Icon', [
			'token' => urldecode($crypt->tokenCreate($text, 'icon.view')),
			'text' => $text,
			'width' => $width,
			'height' => $height
		]);
	}
}