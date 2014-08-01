<?php
class ControllerCommonCatlist extends Controller {
	public function index() {
		//$this->document->setTitle($this->config->get('config_title'));
		//$this->document->setDescription($this->config->get('config_meta_description'));
		//$this->data['heading_title'] = $this->config->get('config_title');
		$this->data['breadcrumbs'] = array();

      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        		'separator' => false
      		);

		$this->data['breadcrumbs'][] = array(
        		'text'      => "Каталог",
			'href'      => $this->url->link('common/catlist'),
        		'separator' => $this->language->get('text_separator')
      		);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/catlist.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/catlist.tpl';
		} else {
			$this->template = 'default/template/common/catlist.tpl';
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
}
?>