<?php
class ControllerExtensionPaymentVindicartao extends Controller {
	private $error = array();

	public function index() {
		$this->vindi = new VindiApi($this->registry);
		$this->load->language('extension/payment/vindicartao');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('vindicartao', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}
		
		$data['text_terms'] = $this->language->get('text_terms');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_m'] = $this->language->get('text_m');
		$data['text_v'] = $this->language->get('text_v');
		$data['text_t'] = $this->language->get('text_t');
		$data['text_h'] = $this->language->get('text_h');
		$data['text_l'] = $this->language->get('text_l');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_help'] = $this->language->get('tab_help');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_sandbox'] = $this->language->get('text_sandbox');
		$data['text_production'] = $this->language->get('text_production');

		$data['entry_order_status_pen'] = $this->language->get('entry_order_status_pen');
		$data['entry_order_status_can'] = $this->language->get('entry_order_status_can');
		$data['entry_order_status_apr'] = $this->language->get('entry_order_status_apr');
		$data['entry_order_status_con'] = $this->language->get('entry_order_status_con');
		$data['entry_order_status_not'] = $this->language->get('entry_order_status_not');
		$data['entry_order_status_ana'] = $this->language->get('entry_order_status_ana');
		$data['entry_parcela'] = $this->language->get('entry_parcela');
		$data['entry_parcela_min'] = $this->language->get('entry_parcela_min');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_token'] = $this->language->get('entry_token');
		$data['entry_days'] = $this->language->get('entry_days');
		$data['entry_doc'] = $this->language->get('entry_doc');
		$data['entry_doc2'] = $this->language->get('entry_doc2');
		$data['entry_raz'] = $this->language->get('entry_raz');
		$data['entry_number'] = $this->language->get('entry_number');
		$data['entry_complement'] = $this->language->get('entry_complement');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['murl'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=42087';
		$data['module_name'] = "Vindi Pagamentos";

		$data['atual'] = $this->vindi->checkUpdate();
		$data['version'] = $this->vindi->moduleVersion();
		$this->vindi->check();

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}
		
		if (isset($this->error['doc'])) {
			$data['error_doc'] = $this->error['doc'];
		} else {
			$data['error_doc'] = '';
		}
		
		if (isset($this->error['token'])) {
			$data['error_token'] = $this->error['token'];
		} else {
			$data['error_token'] = '';
		}
		
		if (isset($this->error['number'])) {
			$data['error_number'] = $this->error['number'];
		} else {
			$data['error_number'] = '';
		}
		
		if (isset($this->error['parct'])) {
			$data['error_parct'] = $this->error['parct'];
		} else {
			$data['error_parct'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/vindicartao', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/vindicartao', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		if (isset($this->request->post['vindicartao_title'])) {
			$data['vindicartao_title'] = $this->request->post['vindicartao_title'];
		} else {
			$data['vindicartao_title'] = $this->config->get('vindicartao_title');
		}

		if (isset($this->request->post['vindicartao_token'])) {
			$data['vindicartao_token'] = $this->request->post['vindicartao_token'];
		} else {
			$data['vindicartao_token'] = $this->config->get('vindicartao_token');
		}
		
		if (isset($this->request->post['vindicartao_days'])) {
			$data['vindicartao_days'] = $this->request->post['vindicartao_days'];
		} else {
			$data['vindicartao_days'] = $this->config->get('vindicartao_days');
		}
		
		if (isset($this->request->post['vindicartao_doc'])) {
			$data['vindicartao_doc'] = $this->request->post['vindicartao_doc'];
		} else {
			$data['vindicartao_doc'] = $this->config->get('vindicartao_doc');
		}
		
		if (isset($this->request->post['vindicartao_doc2'])) {
			$data['vindicartao_doc2'] = $this->request->post['vindicartao_doc2'];
		} else {
			$data['vindicartao_doc2'] = $this->config->get('vindicartao_doc2');
		}
		
		if (isset($this->request->post['vindicartao_raz'])) {
			$data['vindicartao_raz'] = $this->request->post['vindicartao_raz'];
		} else {
			$data['vindicartao_raz'] = $this->config->get('vindicartao_raz');
		}
		
		if (isset($this->request->post['vindicartao_type'])) {
			$data['vindicartao_type'] = $this->request->post['vindicartao_type'];
		} else {
			$data['vindicartao_type'] = $this->config->get('vindicartao_type');
		}
		
		if (isset($this->request->post['vindicartao_number'])) {
			$data['vindicartao_number'] = $this->request->post['vindicartao_number'];
		} else {
			$data['vindicartao_number'] = $this->config->get('vindicartao_number');
		}
		
		if (isset($this->request->post['vindicartao_complement'])) {
			$data['vindicartao_complement'] = $this->request->post['vindicartao_complement'];
		} else {
			$data['vindicartao_complement'] = $this->config->get('vindicartao_complement');
		}
		
		if (isset($this->request->post['vindicartao_total'])) {
			$data['vindicartao_total'] = $this->request->post['vindicartao_total'];
		} elseif($this->config->has('vindicartao_total')) {
			$data['vindicartao_total'] = $this->config->get('vindicartao_total');
		} else {
			$data['vindicartao_total'] = 5.00;
		}
		
   		if (isset($this->request->post['vindicartao_parcela'])) {
			$data['vindicartao_parcela'] = $this->request->post['vindicartao_parcela'];
		} elseif($this->config->has('vindicartao_parcela')) {
			$data['vindicartao_parcela'] = $this->config->get('vindicartao_parcela');
		} else {
			$data['vindicartao_parcela'] = 12;
		}
		
		if (isset($this->request->post['vindicartao_parcela_min'])) {
			$data['vindicartao_parcela_min'] = $this->request->post['vindicartao_parcela_min'];
		} elseif($this->config->has('vindicartao_parcela_min')) {
			$data['vindicartao_parcela_min'] = $this->config->get('vindicartao_parcela_min');
		} else {
			$data['vindicartao_parcela_min'] = 5.00;
		}

		if (isset($this->request->post['vindicartao_order_status_id'])) {
			$data['vindicartao_order_status_id'] = $this->request->post['vindicartao_order_status_id'];
		} else {
			$data['vindicartao_order_status_id'] = $this->config->get('vindicartao_order_status_id');
		}
		
		if (isset($this->request->post['vindicartao_order_status_id1'])) {
			$data['vindicartao_order_status_id1'] = $this->request->post['vindicartao_order_status_id1'];
		} else {
			$data['vindicartao_order_status_id1'] = $this->config->get('vindicartao_order_status_id1');
		}
		
		if (isset($this->request->post['vindicartao_order_status_id2'])) {
			$data['vindicartao_order_status_id2'] = $this->request->post['vindicartao_order_status_id2'];
		} else {
			$data['vindicartao_order_status_id2'] = $this->config->get('vindicartao_order_status_id2');
		}
		
		if (isset($this->request->post['vindicartao_order_status_id3'])) {
			$data['vindicartao_order_status_id3'] = $this->request->post['vindicartao_order_status_id3'];
		} else {
			$data['vindicartao_order_status_id3'] = $this->config->get('vindicartao_order_status_id3');
		}
		
		if (isset($this->request->post['vindicartao_order_status_id4'])) {
			$data['vindicartao_order_status_id4'] = $this->request->post['vindicartao_order_status_id4'];
		} else {
			$data['vindicartao_order_status_id4'] = $this->config->get('vindicartao_order_status_id4');
		}
		
		if (isset($this->request->post['vindicartao_order_status_id5'])) {
			$data['vindicartao_order_status_id5'] = $this->request->post['vindicartao_order_status_id5'];
		} else {
			$data['vindicartao_order_status_id5'] = $this->config->get('vindicartao_order_status_id5');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['vindicartao_geo_zone_id'])) {
			$data['vindicartao_geo_zone_id'] = $this->request->post['vindicartao_geo_zone_id'];
		} else {
			$data['vindicartao_geo_zone_id'] = $this->config->get('vindicartao_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['vindicartao_status'])) {
			$data['vindicartao_status'] = $this->request->post['vindicartao_status'];
		} else {
			$data['vindicartao_status'] = $this->config->get('vindicartao_status');
		}

		if (isset($this->request->post['vindicartao_sort_order'])) {
			$data['vindicartao_sort_order'] = $this->request->post['vindicartao_sort_order'];
		} else {
			$data['vindicartao_sort_order'] = $this->config->get('vindicartao_sort_order');
		}
		
		$this->load->model('customer/custom_field');
		
        $data['custom_fields'] = $this->model_customer_custom_field->getCustomFields();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/vindicartao', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/vindicartao')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!isset($this->request->post['vindicartao_token']) || $this->request->post['vindicartao_token'] == '' ) {
			$this->error['token'] = $this->language->get('error_token');
		}
		
		if (!isset($this->request->post['vindicartao_doc']) || $this->request->post['vindicartao_doc'] == '' ) {
			$this->error['doc'] = $this->language->get('error_doc');
		}
		
		if (!isset($this->request->post['vindicartao_title']) || $this->request->post['vindicartao_title'] == '' ) {
			$this->error['title'] = $this->language->get('error_title');
		}
		
		if (!isset($this->request->post['vindicartao_number']) || $this->request->post['vindicartao_number'] == '' ) {
			$this->error['number'] = $this->language->get('error_number');
		}
		
		if (!isset($this->request->post['vindicartao_parcela']) || $this->request->post['vindicartao_parcela'] < 1 || $this->request->post['vindicartao_parcela'] > 12) {
			$this->error['parct'] = $this->language->get('error_parcela');
		}

		return !$this->error;
	}
}