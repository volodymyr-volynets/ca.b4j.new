<?php

namespace Numbers\Users\Chat\Controller;
class Chat extends \Object\Controller\Authorized {
	public function actionIndex() {
		// include js and css
		\Layout::addJs('/numbers/media_submodules/Numbers_Users_Chat_Media_JS_Base.js');
		\Layout::addCss('/numbers/media_submodules/Numbers_Users_Chat_Media_CSS_Base.css');
		// add new users form
		$input = \Request::input(null, true, true);
		$form = new \Numbers\Users\Chat\Form\AddNewUser([
			'input' => $input
		]);
		$form_content = $form->render();
		// groups list
		$groups_content = '';
		// render status
		$groups_content.= \HTML::select(['id' => '__chat_mini_status', 'name' => '__chat_mini_status', 'value' => $input['__chat_mini_status_user_' . \User::id()] ?? 30, 'no_choose' => true, 'options' => \Numbers\Users\Chat\Model\Statuses::optionsStatic(), 'onchange' => 'Numbers.Chat.changeUserStatus(this.value);']);
		$groups_content.= '<hr class="simple" />';
		// render groups
		$groups = \Numbers\Users\Chat\DataSource\Groups::getStatic([]);
		$group_list = [];
		if (!empty($groups)) {
			foreach ($groups as $k => $v) {
				$group_list[] = $v['ct_group_id'];
			}
			// get from datasource
			$model = new \Numbers\Users\Users\DataSource\Messages();
			$model->cache = false;
			$messages = $model->get([
				'where' => [
					'chat_group_id' => $group_list,
					'chat_unread' => 1,
					'chat_by_group' => 1
				],
				'pk' => ['chat_group_id']
			]);
		} else {
			$messages = [];
		}
		foreach ($groups as $k => $v) {
			$name = $v['ct_group_name'];
			$icon = '';
			// single user group
			if (count($v['user_names']) == 1) {
				$name = current($v['user_names']);
				$icon_id = current($v['photos']);
				if ($icon_id > 0) {
					$icon.= \Numbers\Users\Documents\Base\Helper\Preview::renderImage($icon_id, 32, 32);
				} else {
					$icon.= \Numbers\Users\Documents\Base\Helper\Preview::renderIcon($name, 32, 32);
				}
			} else { // multi user
				foreach ($v['photos'] as $k2 => $v2) {
					if ($v2 > 0) {
						$icon.= \Numbers\Users\Documents\Base\Helper\Preview::renderImage($v2, 16, 16);
					} else {
						$icon.= \Numbers\Users\Documents\Base\Helper\Preview::renderIcon($v['user_names'][$k2], 16, 16);
					}
				}
			}
			$last_message = '<div class="chat_mini_groups" id="chat_mini_groups_group_' . $v['ct_group_id'] . '">';
				if (!empty($messages[$v['ct_group_id']])) {
					$last_message2 = \Format::firstName($messages[$v['ct_group_id']]['from_name']) . ': ' . \Numbers\Frontend\HTML\Renderers\Common\Emojis::replaceEmoji($messages[$v['ct_group_id']]['subject']);
					if (empty($messages[$v['ct_group_id']]['read'])) {
						$last_message2 = \HTML::b(['value' => $last_message2]);
					}
					$last_message.= $last_message2;
				}
			$last_message.= '</div>';
			$groups_content.= '<table width="100%">';
				$groups_content.= '<tr><td width="99%"><a href="javascript:void(0);" onclick="Numbers.Chat.startNewChat(' . $v['ct_group_id'] . ');">' . $icon . ' ' . $name . '</a>' . $last_message . '</td></tr>'; // <td width="1%"><a href="javascript:void(0);">' . \HTML::icon(['type' => 'far fa-trash-alt']) . '</a></td>
			$groups_content.= '</table>';
			$groups_content.= '<hr class="simple" />';
		}
		if (empty($groups)) {
			$groups_content.= \HTML::message(['options' => i18n(null, \Object\Content\Messages::NO_ROWS_FOUND), 'type' => 'warning']);
		}
		// build grid
		$grid = [
			'options' => [
				'Header Row' => [
					'Header' => [
						'Groups' => [
							'value' => \HTML::segment([
								'type' => 'primary',
								'value' => $groups_content,
								'header' => [
									'icon' => ['type' => 'fas fa-users'],
									'title' => i18n(null, 'People / Groups:')
								]
							]),
							'options' => [
								'percent' => 25,
							]
						],
						'Create group' => [
							'value' => \HTML::segment([
								'type' => 'success',
								'value' => $form_content,
								'header' => [
									'icon' => ['type' => 'fas fa-user-plus'],
									'title' => i18n(null, 'Search and add people:')
								]
							]),
							'options' => [
								'percent' => 75,
							]
						]
					]
				]
			]
		];
		echo \HTML::grid($grid);
		\Layout::onload('Numbers.Chat.initialize();');
	}
	public function actionJsonMenuName() {
		// fetch number of messages
		$query = \Numbers\Users\Users\Model\Message\Recipients::queryBuilderStatic()->select();
		$query->columns(['count' => 'COUNT(*)']);
		$query->where('AND', ['a.um_mesrecip_read', '=', 0]);
		$query->where('AND', ['a.um_mesrecip_user_id', '=', \User::id()]);
		$query->where('AND', ['a.um_mesrecip_chat_group_id', 'IS NOT', null]);
		$data = $query->query();
		// generate message
		$label = '<table width="100%"><tr><td width="99%">' . \HTML::icon(['type' => 'far fa-comments']) . ' ' . i18n(null, 'Chat') . '</td><td width="1%">' . \HTML::label2(['type' => 'success', 'value' => \Format::id($data['rows'][0]['count'])]) . '</td></tr></table>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $label,
			'item' => \Request::input('item')
		], 'application/json');
	}
}