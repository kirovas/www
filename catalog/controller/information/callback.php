<?php
class ControllerInformationCallback extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('information/callback');

    	$this->document->setTitle($this->language->get('heading_title'));

    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_location'] = $this->language->get('text_location');
		$this->data['text_callback'] = $this->language->get('text_callback');
		$this->data['text_address'] = $this->language->get('text_address');
    	$this->data['text_telephone'] = $this->language->get('text_telephone');
    	$this->data['text_fax'] = $this->language->get('text_fax');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}

 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}

    	$this->data['button_continue'] = $this->language->get('button_continue');

		$this->data['action'] = $this->url->link('information/callback');
		$this->data['store'] = $this->config->get('config_name');
    	$this->data['address'] = nl2br($this->config->get('config_address'));
    	$this->data['telephone'] = $this->config->get('config_telephone');
    	$this->data['fax'] = $this->config->get('config_fax');

		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}

		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/callback.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/callback.tpl';
		} else {
			$this->template = 'default/template/information/callback.tpl';
		}

		$this->children = array();

 		$this->response->setOutput($this->render());
  	}

  	public function submit() {
		$this->language->load('information/callback');
		$json = array();

    	$this->document->setTitle($this->language->get('heading_title'));

    	if (!isset($this->request->post['name'])) {
    		$this->request->post['name'] = '';
    	}
    	if (!isset($this->request->post['phone'])) {
    		$this->request->post['phone'] = '';
    	}
    	if (!isset($this->request->post['message'])) {
    		$this->request->post['message'] = '';
    	}
    	if (!isset($this->request->post['captcha'])) {
    		$this->request->post['captcha'] = '';
    	}

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
			$mail->setTo($this->config->get('config_email'));
	  		$mail->setFrom($this->config->get('config_email'));
	  		$mail->setSender($this->request->post['name']);
	  		$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
	  		$mail->setText(strip_tags(html_entity_decode($this->request->post['phone']."\n\n".$this->request->post['message'], ENT_QUOTES, 'UTF-8')));
      		$mail->send();

	  		//$this->redirect($this->url->link('information/callback/success'));
	  		$json['response'] = $this->language->get('text_message');
    	}

    	$this->data['text_location'] = $this->language->get('text_location');
		$this->data['text_callback'] = $this->language->get('text_callback');
		$this->data['text_address'] = $this->language->get('text_address');
    	$this->data['text_telephone'] = $this->language->get('text_telephone');
    	$this->data['text_fax'] = $this->language->get('text_fax');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

		if (isset($this->error['name'])) {
    		$json['error']['name'] = $this->error['name'];
		}

		if (isset($this->error['phone'])) {
			$json['error']['phone'] = $this->error['phone'];
		}

		if (isset($this->error['message'])) {
			$json['error']['message'] = $this->error['message'];
		}

		if (isset($this->error['captcha'])) {
			$json['error']['captcha'] = $this->error['captcha'];
		}

    	$this->data['button_continue'] = $this->language->get('button_continue');

		$this->data['action'] = $this->url->link('information/callback');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/callback.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/callback.tpl';
		} else {
			$this->template = 'default/template/information/callback.tpl';
		}

		$this->children = array();
        $this->response->setOutput(json_encode($json));
 		//$this->response->setOutput($this->render());
  	}

  	public function success() {
		$this->language->load('information/callback');

		$this->document->setTitle($this->language->get('heading_title'));

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/callback'),
        	'separator' => $this->language->get('text_separator')
      	);

    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_message'] = $this->language->get('text_message');

    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}

		$this->children = array(
			'common/column_left_top',
			'common/column_left_bottom',
			'common/column_right_top',
			'common/column_right_bottom',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);

 		$this->response->setOutput($this->render());
	}

  	protected function validate() {
    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}

    	if ((utf8_strlen($this->request->post['phone']) < 3) || (utf8_strlen($this->request->post['phone']) > 32)) {
      		$this->error['phone'] = $this->language->get('error_phone');
    	}

    	if ((utf8_strlen($this->request->post['message']) < 10) || (utf8_strlen($this->request->post['message']) > 3000)) {
      		$this->error['message'] = $this->language->get('error_message');
    	}

    	if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}

	public function captcha() {
		$this->load->library('captcha');

		$captcha = new Captcha();

		$this->session->data['captcha'] = $captcha->getCode();

		$captcha->showImage();
	}
}
?>
