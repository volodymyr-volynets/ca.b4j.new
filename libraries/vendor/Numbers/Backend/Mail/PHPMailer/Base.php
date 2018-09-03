<?php

namespace Numbers\Backend\Mail\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Base extends \Numbers\Backend\Mail\Common\Base implements \Numbers\Backend\Mail\Common\Interface2\Base {

	/**
	 * Send an email
	 *
	 * @param array $options
	 * @return array
	 */
	public function send(array $options) : array {
		$result = [
			'success' => false,
			'error' => [],
			'unique_id' => null
		];
		// see if we need to validate
		if (empty($options['validated'])) {
			$temp = $this->validate($options);
			if (!$temp['success']) {
				return $temp;
			} else if (!empty($temp['data']['requires_fetching'])) {
				// we error if we require fetching from database
				$result['error'][] = 'Fetching of email addresses is required!';
				return $result;
			} else {
				$options = $temp['data'];
			}
		}
		// to, cc, bcc
		$recepients = [];
		foreach (['to', 'cc', 'bcc'] as $r) {
			$recepients[$r] = [];
			foreach ($options[$r] as $v) {
				// todo: add recepient name here
				$recepients[$r][] = $v['email'];
			}
			$recepients[$r] = implode(',', $recepients[$r]);
		}
		// create PHPMailer object and prepare for sending
		require \Application::get('application.path_full') . '../libraries/vendor/autoload.php';
		$mail = new \PHPMailer\PHPMailer\PHPMailer();
		// overrides for non production environments
		$environment = \Application::get('environment');
		$debug = \Application::get('debug.debug');
		if (!empty($debug)) {
			// special headers
			foreach ($recepients as $k => $v) {
				if (!empty($v)) {
					$mail->addCustomHeader('X-Original-' . ucfirst($k), $v);
				}
			}
			unset($recepients);
			$recepients['to'] = \Application::get('debug.email');
			$options['subject'] = '[' . $environment . '] ' . $options['subject'];
		}
		// smtp
		$smtp = \Application::get('flag.global.mail.delivery.smtp');
		if (!empty($smtp)) {
			$mail->isSMTP();
			$mail->Host = $smtp['host'];
			$mail->Port = $smtp['port'];
			if (!empty($smtp['auth'])) {
				$mail->SMTPAuth = true;
				$mail->Username = $smtp['username'];
				$mail->Password = $smtp['password'];
			}
			$mail->SMTPSecure = $smtp['secure'] ?? 'tls';
		}
		// fetch mail settings
		$options = array_merge_hard(\Application::get('flag.global.mail') ?? [], $options);
		// process from
		$mail->setFrom($options['from']['email'], $options['from']['name'] ?? '');
		$mail->addReplyTo($options['from']['email'], $options['from']['name'] ?? '');
		// organization
		if (!empty($options['from']['organization'])) {
			$mail->addCustomHeader('Organization', $options['from']['organization']);
		}
		$mail->Subject = $options['subject'];
		// to, cc, bcc
		foreach (explode(',', $recepients['to']) as $v) $mail->addAddress($v);
		if (!empty($recepients['bcc'])) {
			foreach (explode(',', $recepients['bcc']) as $v) $mail->addBCC($v);
		}
		if (!empty($recepients['cc'])) {
			foreach (explode(',', $recepients['cc']) as $v) $mail->addCC($v);
		}
		$mail->addCustomHeader('Errors-To', $options['from']['email']);
		// important
		if (!empty($options['important'])) {
			$mail->Priority = 1;
		}
		// body
		$mail->WordWrap = 50;
		if (!empty($options['is_html'])) {
			$mail->isHTML(true);
			$mail->AltBody = $options['message'][0]['data'];
			$mail->Body = $options['message'][1]['data'];
		} else {
			$mail->Body = $options['message'][0]['data'];
		}
		// attachments
		if (!empty($options['attachments'])) {
			foreach ($options['attachments'] as $k => $v) {
				$mail->addStringAttachment($v['data'], $v['name']);
			}
		}
		// trying to deliver
		if ($mail->send()) {
			$result['success'] = true;
		} else {
			$result['error'][] = 'Could not deliver mail!';
			trigger_error('Mail: ' . $mail->ErrorInfo);
		}
		return $result;
	}
}