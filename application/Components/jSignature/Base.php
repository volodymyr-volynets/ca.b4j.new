<?php

namespace Components\jSignature;
class Base {

	/**
	 * see \HTML::signature()
	 */
	public static function signature(array $options = []) : string {
		\Layout::addCss('/components/jSignature/jSignature.css');
		if (empty($options['readonly'])) {
			\Layout::addJs('/components/jSignature/jSignature.js');
			$result = \HTML::div([
				'id' => $options['id'] . '_pad',
				'class' => 'components_jSignature_pad',
			]);
			$result.= \HTML::button([
				'id' => $options['id'] . '_reset',
				'value' => i18n(null, 'Reset'),
				'onclick' => "$('#{$options['id']}_pad').jSignature('reset'); $('#{$options['id']}').val('');",
				'style' => 'float: right;'
			]);
			$result.= \HTML::hidden([
				'name' => $options['name'],
				'id' => $options['id'],
				'value' => $options['value'] ?? ''
			]);
			$js = <<<TTT
				var {$options['id']}_pad = $('#{$options['id']}_pad').jSignature({'UndoButton':false});
				$("#{$options['id']}_pad").bind('change', function(e) {
					var data = {$options['id']}_pad.jSignature('getData', 'image');
					if (typeof data === 'string') {
						$('#{$options['id']}').val(data);
					} else if($.isArray(data) && data.length === 2) {
						$('#{$options['id']}').val(data.join(','));
					}
				});
TTT;
			if (!empty($options['value'])) {
				$js.= <<<TTT
					var temp = $('#{$options['id']}').val();
					if (temp != '') {
						{$options['id']}_pad.jSignature('importData', 'data:' + temp)
					}
TTT;
			}
			\Layout::onload($js);
		} else {
			$src = '';
			if (!empty($options['value'])) {
				$src = 'data:' . $options['value'];
			}
			$result = \HTML::img([
				'src' => $src,
				'class' => 'components_jSignature_pad'
			]);
			$result.= \HTML::hidden([
				'name' => $options['name'],
				'id' => $options['id'],
				'value' => $options['value'] ?? ''
			]);
		}
		return $result;
	}
}