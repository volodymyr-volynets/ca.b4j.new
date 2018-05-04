<?php

namespace Numbers\Users\Workflow\Helper;
class CanvasRenderer {

	/**
	 * Render
	 *
	 * @param array $data
	 * @param array $options
	 *		int width
	 *		int height
	 * @return string
	 */
	public static function render(array $data, array $options = []) {
		if (empty($options['width']) || empty($options['height'])) return '';
		$options['width'] = $options['width'] ?? 1024;
		$options['height'] = $options['height'] ?? 768;
		// sort by order
		array_key_sort($data, ['order' => SORT_ASC]);
		//create transparent image
		$image = imagecreatetruecolor($options['width'], $options['height']);
		$fill_color = imagecolorallocate($image, 255, 255, 255);
		imagefilledrectangle($image, 0, 0, $options['width'], $options['height'], $fill_color);
		//imagealphablending($image, true);
		//$transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
		//imagecolortransparent($image, $transparent);
		// loop through shapes
		foreach ($data as $k => $v) {
			switch ($v['type']) {
				case 1000: // rectangle
				case 1100: // rhombus
				case 3000: // circle
					// override colors
					if ((!empty($options['completed_steps']) && in_array($v['step'], $options['completed_steps'])) || !empty($options['show_as_completed'])) {
						$v['shape_fill_color'] = $v['completed_fill_color'];
						$v['shape_border_style'] = $v['completed_border_style'];
						$v['shape_border_color'] = $v['completed_border_color'];
					}
					$fill_color_rgb = hex2rgb($v['shape_fill_color']);
					$fill_color = imagecolorallocate($image, $fill_color_rgb[0], $fill_color_rgb[1], $fill_color_rgb[2]);
					if ($v['type'] == 1000) {
						imagefilledrectangle($image, $v['x1'], $v['y1'], $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], $fill_color);
					} else if ($v['type'] == 1100) {
						$half_width = $v['x2'] / 2;
						$half_height = $v['y2'] / 2;
						imagefilledpolygon($image, [
							$v['x1'] + $half_width, $v['y1'],
							$v['x1'] + $v['x2'], $v['y1'] + $half_height,
							$v['x1'] + $half_width, $v['y1'] + $v['y2'],
							$v['x1'], $v['y1'] + $half_height
						], 4, $fill_color);
					} else if ($v['type'] == 3000) {
						imagefilledarc($image, $v['x1'], $v['y1'], $v['x2'], $v['y2'], 0, 360, $fill_color, IMG_ARC_PIE);
					}
					// border
					self::setLineStyle($image, $v['shape_border_style']);
					$border_color_rgb = hex2rgb($v['shape_border_color']);
					$border_color = imagecolorallocate($image, $border_color_rgb[0], $border_color_rgb[1], $border_color_rgb[2]);
					if ($v['type'] == 1000) {
						imagerectangle($image, $v['x1'], $v['y1'], $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], $border_color);
					} else if ($v['type'] == 1100) {
						$half_width = $v['x2'] / 2;
						$half_height = $v['y2'] / 2;
						imagepolygon($image, [
							$v['x1'] + $half_width, $v['y1'],
							$v['x1'] + $v['x2'], $v['y1'] + $half_height,
							$v['x1'] + $half_width, $v['y1'] + $v['y2'],
							$v['x1'], $v['y1'] + $half_height
						], 4, $border_color);
					} else if ($v['type'] == 3000) {
						imagearc($image, $v['x1'], $v['y1'], $v['x2'], $v['y2'], 0, 360, $border_color);
					}
					break;
				case 2000: // line
					self::setLineStyle($image, $v['line_style']);
					$line_color_rgb = hex2rgb($v['line_color']);
					$line_color = imagecolorallocate($image, $line_color_rgb[0], $line_color_rgb[1], $line_color_rgb[2]);
					imageline($image, $v['x1'], $v['y1'], $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], $line_color);
					// line right/left
					if ($v['line_left_type'] == 30) {
						imagearc($image, $v['x1'], $v['y1'], 5, 5, 0, 360, $line_color);
					} else if ($v['line_left_type'] == 20) {
						self::arrow($image, $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], $v['x1'], $v['y1'], 10, 10, $line_color);
					}
					if ($v['line_right_type'] == 30) {
						imagearc($image, $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], 5, 5, 0, 360, $line_color);
					} else if ($v['line_right_type'] == 20) {
						self::arrow($image, $v['x1'], $v['y1'], $v['x1'] + $v['x2'], $v['y1'] + $v['y2'], 10, 10, $line_color);
					}
					break;
				case 4000: // text
					// override colors
					if ((!empty($options['completed_steps']) && in_array($v['step'], $options['completed_steps'])) || !empty($options['show_as_completed'])) {
						$v['shape_fill_color'] = $v['completed_fill_color'];
					}
					self::setLineStyle($image, 10);
					$fill_color_rgb = hex2rgb($v['shape_fill_color']);
					$fill_color = imagecolorallocate($image, $fill_color_rgb[0], $fill_color_rgb[1], $fill_color_rgb[2]);
					imagestring($image, 5, $v['x1'], $v['y1'], $v['name'], $fill_color);
					break;
			}
		}
		// render image
		ob_start();
		imagepng($image);
		imagedestroy($image);
		$imagedata = ob_get_contents();
		ob_end_clean();
		return '<img src="data:image/png;base64,' . base64_encode($imagedata) . '" alt="Preview" width="' . $options['width'] . '" height="' . $options['height'] . '"/>';
	}

	/**
	 * Set Line style
	 *
	 * @param resource $image
	 * @param int $type
	 */
	private static function setLineStyle($image, $type) {
		if ($type == 10) {
			imagesetthickness($image, 1);
		} else if ($type == 20) {
			imagesetthickness($image, 2);
		} else if ($type == 30) {
			imagesetthickness($image, 3);
		}
	}

	/**
	 * Arrow
	 *
	 * @param resource $image
	 * @param int $x1
	 * @param int $y1
	 * @param int $x2
	 * @param int $y2
	 * @param int $alength
	 * @param int $awidth
	 * @param int $color
	 */
	private static function arrow($image, $x1, $y1, $x2, $y2, $alength, $awidth, $color) {
		$distance = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));
		$dx = $x2 + ($x1 - $x2) * $alength / $distance;
		$dy = $y2 + ($y1 - $y2) * $alength / $distance;
		$k = $awidth / $alength / 3;
		$x2o = $x2 - $dx;
		$y2o = $dy - $y2;
		$x3 = $y2o * $k + $dx;
		$y3 = $x2o * $k + $dy;
		$x4 = $dx - $y2o * $k;
		$y4 = $dy - $x2o * $k;
		imagefilledpolygon($image, [$x2, $y2, $x3, $y3, $x4, $y4], 3, $color);
	}
}