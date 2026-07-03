<?php
class ControllerExtensionPaymentVindiboleto extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/vindiboleto');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('vindiboleto', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$this->remover();
		
		$data['version'] = $this->ver();
		$data['module_name'] = 'vindiboleto';
		
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

		$data['text_edit'] = sprintf($this->language->get('text_edit'), $this->ver());
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
		$data['entry_group'] = $this->language->get('entry_group');

		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['murl'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=42087';
		$data['atual'] = $this->checkForUpdate();

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
		
		if (isset($this->error['token'])) {
			$data['error_token'] = $this->error['token'];
		} else {
			$data['error_token'] = '';
		}
		
		if (isset($this->error['doc'])) {
			$data['error_doc'] = $this->error['doc'];
		} else {
			$data['error_doc'] = '';
		}
		
		if (isset($this->error['number'])) {
			$data['error_number'] = $this->error['number'];
		} else {
			$data['error_number'] = '';
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
			'href' => $this->url->link('extension/payment/vindiboleto', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/vindiboleto', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		if (isset($this->request->post['vindiboleto_title'])) {
			$data['vindiboleto_title'] = $this->request->post['vindiboleto_title'];
		} else {
			$data['vindiboleto_title'] = $this->config->get('vindiboleto_title');
		}

		if (isset($this->request->post['vindiboleto_token'])) {
			$data['vindiboleto_token'] = $this->request->post['vindiboleto_token'];
		} else {
			$data['vindiboleto_token'] = $this->config->get('vindiboleto_token');
		}
		
		if (isset($this->request->post['vindiboleto_days'])) {
			$data['vindiboleto_days'] = $this->request->post['vindiboleto_days'];
		} else {
			$data['vindiboleto_days'] = $this->config->get('vindiboleto_days');
		}
		
		if (isset($this->request->post['vindiboleto_doc'])) {
			$data['vindiboleto_doc'] = $this->request->post['vindiboleto_doc'];
		} else {
			$data['vindiboleto_doc'] = $this->config->get('vindiboleto_doc');
		}
		
		if (isset($this->request->post['vindiboleto_doc2'])) {
			$data['vindiboleto_doc2'] = $this->request->post['vindiboleto_doc2'];
		} else {
			$data['vindiboleto_doc2'] = $this->config->get('vindiboleto_doc2');
		}
		
		if (isset($this->request->post['vindiboleto_raz'])) {
			$data['vindiboleto_raz'] = $this->request->post['vindiboleto_raz'];
		} else {
			$data['vindiboleto_raz'] = $this->config->get('vindiboleto_raz');
		}
		
		if (isset($this->request->post['vindiboleto_type'])) {
			$data['vindiboleto_type'] = $this->request->post['vindiboleto_type'];
		} else {
			$data['vindiboleto_type'] = $this->config->get('vindiboleto_type');
		}
		
		if (isset($this->request->post['vindiboleto_number'])) {
			$data['vindiboleto_number'] = $this->request->post['vindiboleto_number'];
		} else {
			$data['vindiboleto_number'] = $this->config->get('vindiboleto_number');
		}
		
		if (isset($this->request->post['vindiboleto_complement'])) {
			$data['vindiboleto_complement'] = $this->request->post['vindiboleto_complement'];
		} else {
			$data['vindiboleto_complement'] = $this->config->get('vindiboleto_complement');
		}
		
		if (isset($this->request->post['vindiboleto_total'])) {
			$data['vindiboleto_total'] = $this->request->post['vindiboleto_total'];
		} elseif($this->config->has('vindiboleto_total')) {
			$data['vindiboleto_total'] = $this->config->get('vindiboleto_total');
		} else {
			$data['vindiboleto_total'] = 3.00;
		}

		if (isset($this->request->post['vindiboleto_order_status_id'])) {
			$data['vindiboleto_order_status_id'] = $this->request->post['vindiboleto_order_status_id'];
		} else {
			$data['vindiboleto_order_status_id'] = $this->config->get('vindiboleto_order_status_id');
		}
		
		if (isset($this->request->post['vindiboleto_order_status_id1'])) {
			$data['vindiboleto_order_status_id1'] = $this->request->post['vindiboleto_order_status_id1'];
		} else {
			$data['vindiboleto_order_status_id1'] = $this->config->get('vindiboleto_order_status_id1');
		}
		
		if (isset($this->request->post['vindiboleto_order_status_id2'])) {
			$data['vindiboleto_order_status_id2'] = $this->request->post['vindiboleto_order_status_id2'];
		} else {
			$data['vindiboleto_order_status_id2'] = $this->config->get('vindiboleto_order_status_id2');
		}
		
		if (isset($this->request->post['vindiboleto_order_status_id3'])) {
			$data['vindiboleto_order_status_id3'] = $this->request->post['vindiboleto_order_status_id3'];
		} else {
			$data['vindiboleto_order_status_id3'] = $this->config->get('vindiboleto_order_status_id3');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['vindiboleto_geo_zone_id'])) {
			$data['vindiboleto_geo_zone_id'] = $this->request->post['vindiboleto_geo_zone_id'];
		} else {
			$data['vindiboleto_geo_zone_id'] = $this->config->get('vindiboleto_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['vindiboleto_status'])) {
			$data['vindiboleto_status'] = $this->request->post['vindiboleto_status'];
		} else {
			$data['vindiboleto_status'] = $this->config->get('vindiboleto_status');
		}

		if (isset($this->request->post['vindiboleto_sort_order'])) {
			$data['vindiboleto_sort_order'] = $this->request->post['vindiboleto_sort_order'];
		} else {
			$data['vindiboleto_sort_order'] = $this->config->get('vindiboleto_sort_order');
		}
		
		$this->load->model('customer/custom_field');
		
        $data['custom_fields'] = $this->model_customer_custom_field->getCustomFields();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/vindiboleto', $data));
	}
	
	public function checkForUpdate() {
        $ver = 0;
		$url = base64_decode('aHR0cHM6Ly93d3cub3BlbmNhcnRtYXN0ZXIuY29tLmJyL21vZHVsZS92ZXJzaW9uLw==');
        $json_convert  = array('module' => 'vindiboleto');

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
        curl_setopt($soap_do, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $json_convert);

        $response = curl_exec($soap_do); 
        curl_close($soap_do);
        $resposta = json_decode($response, true);
		
		if (version_compare($resposta['mensagem'], $this->ver(), '>')) {
        $ver = 1;
        }
		return $ver;
	}
	
	public function ver() {
		$ver = '1.9.0.5';
		return $ver;
	}

	public function remover() {
        if (is_file(DIR_SYSTEM .'rastreio-yapay.ocmod.xml')) {
	 	unlink(DIR_SYSTEM .'rastreio-yapay.ocmod.xml');
    	}
		if (is_file(DIR_CATALOG .'view/theme/journal2/template/extension/payment/vindiboleto.tpl')) {
	 	unlink(DIR_CATALOG .'view/theme/journal2/template/extension/payment/vindiboleto.tpl');
    	}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/vindiboleto')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!isset($this->request->post['vindiboleto_token']) || $this->request->post['vindiboleto_token'] == '' ) {
			$this->error['token'] = $this->language->get('error_token');
		}
		
		if (!isset($this->request->post['vindiboleto_doc']) || $this->request->post['vindiboleto_doc'] == '' ) {
			$this->error['doc'] = $this->language->get('error_doc');
		}
		
		if (!isset($this->request->post['vindiboleto_title']) || $this->request->post['vindiboleto_title'] == '' ) {
			$this->error['title'] = $this->language->get('error_title');
		}
		
		if (!isset($this->request->post['vindiboleto_number']) || $this->request->post['vindiboleto_number'] == '' ) {
			$this->error['number'] = $this->language->get('error_number');
		}

		return !$this->error;
	}
}