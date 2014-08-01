<?php
class ControllerPaymentCod extends Controller {
	protected function index() {
    		$this->load->model('checkout/order');
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('cod_order_status_id'));
	}
}
?>