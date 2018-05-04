<?php

namespace Numbers\Users\Chat\Controller\Renderer;
class Chat extends \Object\Controller {
	public $title = 'Chat Renderer';
	public function actionIndex() {
		$input = \Request::input();
		$crypt = new \Crypt();
		$token_data = $crypt->tokenVerify($input['token'] ?? '', ['general']);
		// load group
		$input['group_id'] = (int) $input['group_id'];
		$group = \Numbers\Users\Chat\DataSource\Groups::getStatic([
			'where' => [
				'only_this_group_id' => $input['group_id']
			],
			'pk' => null
		]);
		$group_name = $group[0]['ct_group_name'] ?? $group[0]['user_names'][0] ?? null;
		// send bar
		$emoji_model = new \Numbers\Frontend\HTML\Renderers\Common\Emojis();
		$empji_content = $emoji_model->renderEmojis(['onclick' => 'Numbers.Chat.AttachEmoji(' . $input['group_id'] . ', this);']);
		$send_button = '<div style="position: relative;">';
			$send_button.= \HTML::textarea(['id' => 'chat_mini_group_id_' . $input['group_id'] . '_value_field', 'placeholder' => i18n(null, 'Send a message')]);
			$send_button.= \HTML::popover(['id' => 'popover_emoji_id_' . $input['group_id'], 'value' => \HTML::a(['href' => 'javascript:void(0);', 'id' => 'popover_emoji_id_' . $input['group_id'], 'value' => '<i class="fas fa-smile"></i>', 'title' => i18n(null, 'Select Emoji'), 'style'=>'position: absolute; right: 2.5em; top: 0.5em;']), 'title' => i18n(null, 'Select Emoji'), 'content' => $empji_content]);
			$send_button.= \HTML::a(['id' => 'chat_mini_group_id_' . $input['group_id'] . '_send_link', 'href' => 'javascript:void(0);', 'onclick' => '', 'value' => \HTML::icon(['type' => 'fas fa-mouse-pointer']), 'style' => 'position: absolute; right: 1em; top: 0.5em;']);
		$send_button.= '</div>';
		// generate messages
		$chat_messages = '<div class="chat_mini_message_holder" id="chat_mini_group_id_' . $input['group_id'] . '_messages">&nbsp;</div>';
		$chat_messages.= '<div class="chat_mini_typing_holder" id="chat_mini_group_id_' . $input['group_id'] . '_typing">';
			foreach ($group[0]['photos'] as $k2 => $v2) {
				if ($v2 > 0) {
					$icon = \Numbers\Users\Documents\Base\Helper\Preview::renderImage($v2, 16, 16);
				} else {
					$icon = \Numbers\Users\Documents\Base\Helper\Preview::renderIcon($group[0]['user_names'][$k2], 16, 16);
				}
				$chat_messages.= '<span class="chat_mini_typing_user" id="chat_mini_group_id_' . $input['group_id'] . '_typing_user_' . $group[0]['user_ids'][$k2] . '" style="display: none;">' . $icon . ' ' . '<i class="fas fa-circle-notch fa-spin"></i>' . '</span>';
			}
		$chat_messages.= '</div>';
		// build grid
		$grid = [
			'options' => [
				'Header Row' => [
					'Header' => [
						'Groups' => [
							'value' => $chat_messages,
							'options' => [
								'percent' => 100,
							]
						],
					]
				],
				'Body Row' => [
					'Header' => [
						'Groups' => [
							'value' => $send_button,
							'options' => [
								'percent' => 100,
							]
						],
					]
				]
			]
		];
		$grid = \HTML::grid($grid);
		$chat_content = '<div class="chat_mini_main_holder" id="chat_mini_group_id_' . $input['group_id'] . '">' . \HTML::segment([
			'type' => 'info',
			'value' => $grid,
			'header' => [
				'icon' => ['type' => 'far fa-comments'],
				'title' => i18n(null, 'Chat with: [group_name]', ['replace' => ['[group_name]' => $group_name]]) . '<a href="javascript:void(0);" class="float-right" onclick="Numbers.Chat.closeChat(' . $input['group_id'] . ');">' . \HTML::icon(['type' => 'fas fa-times', 'class' => 'text-white']) . '</a>'
			],
		]) . '</div>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $chat_content,
			'js' => \Layout::$onload
		], 'application/json');
	}

	/**
	 * Load messages
	 */
	public function actionLoadMessages() {
		$input = \Request::input();
		$crypt = new \Crypt();
		$token_data = $crypt->tokenVerify($input['token'] ?? '', ['general']);
		// get from datasource
		$model = new \Numbers\Users\Users\DataSource\Messages();
		$model->cache = false;
		$messages = $model->get([
			'where' => [
				'chat_group_id' => [(int) $input['group_id']],
				'chat_unread' => 1
			],
			'cache' => false
		]);
		$new = 0;
		foreach ($messages as $k => $v) {
			if (empty($v['read'])) $new++;
			$messages[$k]['to_photo_file_id_url'] = $v['to_photo_file_id'] ? \Numbers\Users\Documents\Base\Base::generateURL($v['to_photo_file_id'], true) : null;
			$messages[$k]['chat_user_photo_file_id_url'] = $v['chat_user_photo_file_id'] ? \Numbers\Users\Documents\Base\Base::generateURL($v['chat_user_photo_file_id'], true) : null;
			$messages[$k]['timestamp_nice'] = \Format::niceTimestamp($v['timestamp']);
			// process emojis
			$messages[$k]['subject'] = \Numbers\Frontend\HTML\Renderers\Common\Emojis::replaceEmoji($messages[$k]['subject']);
		}
		// update read flag
		if (!empty($input['read'])) {
			$query = \Numbers\Users\Users\Model\Message\Recipients::queryBuilderStatic()->update();
			$query->set([
				'um_mesrecip_read' => 1
			]);
			$query->where('AND' , ['a.um_mesrecip_user_id', '=', (int) $token_data['id']]);
			$query->where('AND' , ['a.um_mesrecip_chat_group_id', '=', (int) $input['group_id']]);
			$query->where('AND' , ['a.um_mesrecip_message_id', '<=', (int) $input['last_message_id']]);
			$query->query();
		}
		$result['success'] = true;
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'count' => $new,
			'messages' => $messages
		], 'application/json');
	}

	/**
	 * New chat message
	 */
	public function actionNewChatMessage() {
		$input = \Request::input(null, false);
		$crypt = new \Crypt();
		$token_data = $crypt->tokenVerify($input['token'] ?? '', ['general']);
		// save chat message
		$header_model = new \Numbers\Users\Users\Model\Message\Headers();
		$header_model->db_object->begin();
		// load user & group
		$user_data = \Numbers\Users\Users\Model\Users::loadById((int) $token_data['id']);
		$group_data = \Numbers\Users\Chat\Model\Group\Users::getStatic([
			'where' => [
				'ct_grpuser_group_id' => (int) $input['group_id'],
			],
			'pk' => null
		]);
		// header
		$header = [
			'um_mesheader_type_id' => 20,
			'um_mesheader_notification_code' => 'CT::CHAT_MESSAGE',
			'um_mesheader_important' => 0,
			'um_mesheader_from_email' => $user_data['um_user_email'] ?? '',
			'um_mesheader_from_name' => $user_data['um_user_name'],
			'um_mesheader_subject' => $input['message'],
			'um_mesheader_body_id' => null,
			'um_mesheader_keywords' => strip_tags($input['message']),
			'um_mesheader_chat_group_id' => (int) $input['group_id'],
			'um_mesheader_chat_user_id' => (int) $token_data['id']
		];
		$header_result = $header_model->collection()->merge($header);
		if (!$header_result['success']) {
			$header_model->db_object->rollback();
			\Layout::renderAs($header_result, 'application/json');
		}
		// store recipient
		foreach ($group_data as $k => $v) {
			$user_to_data = \Numbers\Users\Users\Model\Users::loadById((int) $v['ct_grpuser_user_id']);
			$recipient_result = \Numbers\Users\Users\Model\Message\Recipients::collectionStatic()->merge([
				'um_mesrecip_message_id' => $header_result['new_serials']['um_mesheader_id'],
				'um_mesrecip_type_id' => 10,
				'um_mesrecip_user_id' => $v['ct_grpuser_user_id'],
				'um_mesrecip_user_email' => $user_to_data['um_user_email'],
				'um_mesrecip_read' => ($v['ct_grpuser_user_id'] == (int) $token_data['id']) ? 1 : 0,
				'um_mesrecip_chat_group_id' => (int) $input['group_id']
			]);
			if (!$recipient_result) {
				$header_model->db_object->rollback();
				\Layout::renderAs($recipient_result, 'application/json');
			}
		}
		// update read flag
		$query = \Numbers\Users\Users\Model\Message\Recipients::queryBuilderStatic()->update();
		$query->set([
			'um_mesrecip_read' => 1
		]);
		$query->where('AND' , ['a.um_mesrecip_user_id', '=', (int) $token_data['id']]);
		$query->where('AND' , ['a.um_mesrecip_chat_group_id', '=', (int) $input['group_id']]);
		$query->where('AND' , ['a.um_mesrecip_message_id', '<=', $header_result['new_serials']['um_mesheader_id']]);
		$update_result = $query->query();
		if (!$update_result['success']) {
			$header_model->db_object->rollback();
			\Layout::renderAs($update_result, 'application/json');
		}
		// we are ok if we got here
		$header_model->db_object->commit();
		\Layout::renderAs([
			'success' => true,
			'error' => []
		], 'application/json');
	}
}