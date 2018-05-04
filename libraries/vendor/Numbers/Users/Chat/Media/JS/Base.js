/**
 * Chat
 */
Numbers.Chat = {

	/**
	 * Web socket
	 *
	 * @type resource
	 */
	websocket: null,

	/**
	 * Connection established
	 *
	 * @type Boolean
	 */
	connected: false,

	/**
	 * Initialize
	 */
	initialize: function() {
		if (!this.websocket) {
			this.initializeSocket();
		}
	},

	/**
	 * Start new chat
	 *
	 * @param int group_id
	 */
	startNewChat: function(group_id) {
		// see if chat already exists
		if ($('#chat_mini_group_id_' + group_id).length > 0) return;
		// if we have other chats
		var chat_right = 0;
		if ($('.chat_mini_main_holder').length) {
			chat_right = $('.chat_mini_main_holder').length * 300 + ($('.chat_mini_main_holder').length * 5);
		}
		chat_right+= 5;
		var that = this;
		// call to get skeleton
		$.ajax({
			url: '/Numbers/Users/Chat/Controller/Renderer/Chat',
			method: 'post',
			data: '__ajax=1&group_id=' + group_id + '&token=' + Numbers.token,
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					$('body').prepend(data.data);
					$('#chat_mini_group_id_' + group_id).css('right', chat_right);
					// progress bar
					$('#chat_mini_group_id_' + group_id + '_messages').html('<div style="text-align: center;"><i class="fas fa-spinner fa-spin"></i></div>');
					if (!that.websocket) {
						that.initializeSocket();
					}
					$('#chat_mini_group_id_' + group_id + '_send_link').click(function () {
						var message = $('#chat_mini_group_id_' + group_id + '_value_field').val();
						if (message) {
							that.sendMessage(group_id, message, 'message');
							$('#chat_mini_group_id_' + group_id + '_value_field').val('');
						}
					});
					$('#chat_mini_group_id_' + group_id + '_value_field').keyup(function (event) {
						var keycode = (event.keyCode ? event.keyCode : event.which);
						if (keycode == '13') {
							var message = $('#chat_mini_group_id_' + group_id + '_value_field').val();
							if (message) {
								that.sendMessage(group_id, message, 'message');
								$('#chat_mini_group_id_' + group_id + '_value_field').val('');
								that.scrollToTheBottomOfMessages(group_id);
								return;
							}
						}
						// need to show if someone is typing
						var message = $('#chat_mini_group_id_' + group_id + '_value_field').val();
						var status = cookie_get('__chat_mini_status_user_' + Numbers.user_id);
						if ((message.length % 3) == 0 && status == 10) { // status Online
							that.sendMessage(group_id, 'Typing', 'typing');
						}
					});
					$('#chat_mini_group_id_' + group_id + '_messages').scroll(function () {
						if ($(this).prop('scrollHeight') - $(this).scrollTop() <= Math.ceil($(this).height())) {
							that.loadMessages(group_id, true);
						}
					});
					// load messages
					that.loadMessages(group_id);
					that.scrollToTheBottomOfMessages(group_id);
					// execute js
					if (data.js) {
						eval(data.js);
					}
				} else {
					print_r2(data.error);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				print_r2(jqXHR.responseText);
			}
		});
	},

	sendMessage: function (group_id, message, message_type) {
		var data = {};
		data.type = message_type;
		data.message = message;
		data.host = Numbers.host;
		data.group_id = group_id;
		data.user_id = Numbers.user_id;
		data.token = Numbers.token;
		data.api = '/Numbers/Users/Chat/Controller/Renderer/Chat/_NewChatMessage';
		if (this.connected) {
			$('#chat_mini_group_id_' + group_id + '_value_field').attr('readonly', false);
			this.websocket.send(JSON.stringify(data));
		} else {
			$('#chat_mini_group_id_' + group_id + '_value_field').attr('readonly', true);
		}
	},

	/**
	 * Close chat
	 *
	 * @param int group_id
	 */
	closeChat: function(group_id) {
		$('#chat_mini_group_id_' + group_id).remove();
	},

	/**
	 * Lock for load messages
	 *
	 * @type Boolean
	 */
	loadMessageLock: {},

	/**
	 * Load messages
	 */
	loadMessages: function(group_id, read) {
		if (this.loadMessageLock[group_id]) {
			return;
		} else {
			this.loadMessageLock[group_id] = true;
		}
		var last_message_id = $('#chat_mini_group_id_' + group_id + '_last_message_id').val();
		that = this;
		$.ajax({
			url: '/Numbers/Users/Chat/Controller/Renderer/Chat/_LoadMessages',
			method: 'get',
			data: '__ajax=1&group_id=' + group_id + '&read=' + (read ? 1 : 0) + '&last_message_id=' + last_message_id + '&token=' + Numbers.token,
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					// aggregate
					var content = '', groupped = {}, counter = 0;
					var current_user_id = null, current_read = null;
					var last_message_id, last_message_data;
					for (var i in data.messages) {
						if (data.count > 0 && data.messages[i]['read'] == 0) {
							counter++;
							// label here
							groupped[counter] = {
								options: i18n(null, '[count] new messages', {replace: {'[count]': data.count}}),
								new_message_separator: true,
								current_user: false
							};
							counter++;
							data.count = 0;
						} else if (!current_user_id || current_user_id != data.messages[i]['chat_user_id']) {
							counter++;
							current_user_id = data.messages[i]['chat_user_id'];
						}
						if (!groupped[counter]) {
							groupped[counter] = {
								options: [],
								from_name: data.messages[i]['from_name'],
								from_user_id: data.messages[i]['chat_user_id'],
								from_photo_file_id: data.messages[i]['chat_user_photo_file_id'],
								from_photo_file_id_url: data.messages[i]['to_photo_file_id_url'],
								new_message_separator: false,
								current_user: (data.messages[i]['chat_user_id'] == Numbers.user_id),
								chat_user_photo_file_id_url: data.messages[i]['chat_user_photo_file_id_url'],
								timestamp_nice: data.messages[i]['timestamp_nice']
							};
						}
						groupped[counter].options.push({
							id: data.messages[i]['message_id'],
							message: data.messages[i]['subject']
						});
						last_message_id = data.messages[i]['message_id'];
						last_message_data = data.messages[i];
					}
					// render
					for (var i in groupped) {
						if (groupped[i].new_message_separator) {
							content+= '<table width="100%">';
								content+= '<tr>';
									content+= '<td width="20%"><hr/></td>';
									content+= '<td width="60%">' + groupped[i]['options'] + '</td>';
									content+= '<td width="20%"><hr/></td>';
								content+= '</tr>';
							content+= '</table>';
						} else if (groupped[i].current_user) {
							content+= '<br/>';
							content+= '<table>';
								content+= '<tr>';
									content+= '<td width="99%" class="chat_mini_message_single_line_left">';
										for (var j in groupped[i].options) {
											content+= groupped[i].options[j].message + '<br/>';
										}
									content+= '</td>';
									content+= '<td width="1%">';
										if (groupped[i].from_photo_file_id_url) {
											content+= '<img src="' + groupped[i].from_photo_file_id_url + '" width="32" height="32" class="navbar-menu-item-avatar-img" />';
										}
									content+= '</td>';
								content+= '</tr>';
								content+= '<tr>';
									content+= '<td width="99%" class="chat_mini_message_who">';
										content+= groupped[i].from_name + ' &mdash; ' + groupped[i].timestamp_nice;
									content+= '</td>';
									content+= '<td width="1%">&nbsp;</td>';
								content+= '</tr>';
							content+= '</table>';
						} else if (!groupped[i].current_user) {
							content+= '<br/>';
							content+= '<table>';
								content+= '<tr>';
									content+= '<td width="1%">';
										if (groupped[i].from_photo_file_id_url) {
											content+= '<img src="' + groupped[i].chat_user_photo_file_id_url + '" width="32" height="32" class="navbar-menu-item-avatar-img" />';
										}
									content+= '</td>';
									content+= '<td width="99%" class="chat_mini_message_single_line_right">';
										for (var j in groupped[i].options) {
											content+= groupped[i].options[j].message + '<br/>';
										}
									content+= '</td>';
								content+= '</tr>';
								content+= '<tr>';
									content+= '<td width="1%">&nbsp;</td>';
									content+= '<td width="99%" class="chat_mini_message_who">';
										content+= groupped[i].from_name + ' &mdash; ' + groupped[i].timestamp_nice;
									content+= '</td>';
								content+= '</tr>';
							content+= '</table>';
						}
					}
					content+= '<input type="hidden" id="chat_mini_group_id_' + group_id + '_last_message_id" value="' + last_message_id + '" />'
					$('#chat_mini_group_id_' + group_id + '_messages').html(content);
					if (last_message_data) {
					   var temp = Numbers.Format.firstName(last_message_data['from_name']) + ': ' + last_message_data['subject'];
						$('#chat_mini_groups_group_' + group_id).html(temp);
					}
					// unset the lock
					that.loadMessageLock[group_id] = false;
				} else {
					print_r2(data.error);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				print_r2(jqXHR.responseText);
				// unset the lock
				that.loadMessageLock[group_id] = false;
			}
		});
	},

	/**
	 * Init socket
	 *
	 * @param int group_id
	 */
	initializeSocket: function() {
		try {
			that = this;
			this.websocket = new WebSocket(Numbers.ws_host);
			this.websocket.onopen = function(event) {
				that.connected = true;
			};
			this.websocket.onmessage = function(event) {
				var data = JSON.parse(event.data);
				if (data.type == 'message') {
					that.startNewChat(data.group_id);
					that.loadMessages(data.group_id);
					that.scrollToTheBottomOfMessages(data.group_id);
					// beep
					var audio = new Audio('/numbers/media_submodules/Numbers_Users_Chat_Media_Other_Tone.mp3');
					audio.play();
				} else if (data.type == 'typing') {
					var typing_span = $('#chat_mini_group_id_' + data.group_id + '_typing_user_' + data.user_id);
					typing_span.show();
					setTimeout(function(){ typing_span.hide(); }, 5000);
				}
			};
			this.websocket.onerror = function (event) {
				if (event && event.data) {
					var data = JSON.parse(event.data);
					that.closeChat(data.group_id);
				}
			};
			this.websocket.onclose = function (event) {
				that.initializeSocket();
			};
		} catch (error) {
			console.log(error);
		}
	},

	/**
	 * Scroll to the bottom
	 *
	 * @param int group_id
	 */
	scrollToTheBottomOfMessages: function(group_id) {
		$('#chat_mini_group_id_' + group_id + '_messages').animate({scrollTop: $('#chat_mini_group_id_' + group_id + '_messages').prop("scrollHeight") + 5000}, 2500);
	},

	/**
	 * Change users status
	 *
	 * @param int status
	 */
	changeUserStatus: function (status) {
		cookie_set('__chat_mini_status_user_' + Numbers.user_id, status);
	},

	/**
	 * Attach emoji
	 *
	 * @param int group_id
	 */
	AttachEmoji: function(group_id, emoji) {
		var previous = $('#chat_mini_group_id_' + group_id + '_value_field').val();
		var temp = $(emoji).attr('data-symbol');
		$('#chat_mini_group_id_' + group_id + '_value_field').val(previous + ' ' + temp);
	}
};