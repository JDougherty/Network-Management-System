<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'classes/router/router.php';

class Devices extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data = array();
	
		$devices = new Device();
		$data['devices'] = $devices->get()->all;
		
		$data['breadcrumbs'] = array('Devices' => '/');
		$data['content'] = 'devices/viewall';
		$this->load->view('layouts/main/index', $data);
	}
	
	public function view($id)
	{
		$data = array();
	
		$device = new Device($id);
		if (!$device->exists()) show_404();
		
		$router = new Router($device->host, $device->community);
		if ($router->exists()) $data['router'] = $router;
		
		$data['breadcrumbs'] = array('Devices' => '/', $device->host => '');
		$data['content'] = 'devices/view';
		$this->load->view('layouts/main/index', $data);
	}
	
	public function add()
	{
		$data = array();
	
		$this->load->library(array('input', 'form_validation'));
		$this->form_validation->set_rules('host', 'host', 'required');
		$this->form_validation->set_rules('community', 'community', 'required');
	
		if ($this->form_validation->run())
		{
			$device = new Device();
			$device->label = $this->input->post('label');
			$device->host = $this->input->post('host');
			$device->community = $this->input->post('community');
			
			$data['added'] = $device->save();
		}
		
		$data['breadcrumbs'] = array('Devices' => '/', 'Add' => '');
		$data['content'] = 'devices/add';
		$this->load->view('layouts/main/index', $data);
	}
}

/* End of file devices.php */
/* Location: ./app/controllers/devices.php */