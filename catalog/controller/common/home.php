<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		$this->data['heading_title'] = $this->config->get('config_title');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}

		$this->children = array(
			'common/column_left_top',
			'common/column_left_bottom',
			'common/column_right_top',
			'common/column_right_bottom',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header',
		);

		//NOPE code here
        $conf = $this->config->get('featured_module');
		$this->data['featured'] = $this->getChild('module/featured', $conf[0]);
        $conf = $this->config->get('latest_module');
		$this->data['latest'] = $this->getChild('module/latest', $conf[0]);
		$conf = $this->config->get('special_module');
		$this->data['special'] = $this->getChild('module/special', $conf[0]);
		//NOPE code ends


		$this->response->setOutput($this->render());
	}
}
?>