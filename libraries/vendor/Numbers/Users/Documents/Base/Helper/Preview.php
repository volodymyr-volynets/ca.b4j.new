<?php

namespace Numbers\Users\Documents\Base\Helper;
class Preview {

	/**
	 * Preview
	 *
	 * @param object $form
	 * @param array $options
	 * @param mixed $value
	 * @param array $neighbouring_values
	 * @return string
	 */
	public function renderPreview(& $form, & $options, & $value, & $neighbouring_values) {
		if (!empty($neighbouring_values[$options['options']['preview_file_id']])) {
			return '<div>' . \HTML::img(['src' => \Numbers\Users\Documents\Base\Base::generateURL($neighbouring_values[$options['options']['preview_file_id']])]) . '</div>';
		} else {
			return '';
		}
	}

	/**
	 * Render image
	 *
	 * @param int $file_id
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public static function renderImage($file_id, $width, $height) {
		return \HTML::img(['src' => \Numbers\Users\Documents\Base\Base::generateURL($file_id), 'class' => 'navbar-menu-item-avatar-img', 'width' => $width, 'height' => $height]);
	}

	/**
	 * Render icon
	 *
	 * @param string $text
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public static function renderIcon($text, $width, $height) {
		return \HTML::img(['src' => \Numbers\Users\Documents\Base\Base::generateIconURL($text, $width, $height), 'class' => 'navbar-menu-item-avatar-img', 'width' => $width, 'height' => $height]);
	}
}