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
		
		$data['breadcrumbs'] = array('Devices' => '');
		$data['content'] = 'devices/viewall';
		$this->load->view('layouts/main/index', $data);
	}
	
	public function view($id)
	{
		$data = array();
	
		$device = new Device($id);
		if (!$device->exists()) show_404();
		if ($device->diagram != NULL) $data['diagram'] = $device->diagram;
		
		$router = new Router($device->address, $device->community);
		if ($router->exists()) $data['router'] = $router;
		
		$data['id'] = $device->id;
		$data['breadcrumbs'] = array('Devices' => '/', $device->hostname . ' (' . $device->address . ')' => '');
		$data['content'] = 'devices/view';
		$this->load->view('layouts/main/index', $data);
	}
	
	public function delete($id)
	{
		$data = array();
	
		$device = new Device($id);
		$device->delete();
		
		redirect("/", "refresh");
	}
	
	public function add()
	{
		$data = $this->_save(array(), new Device());
		
		$data['breadcrumbs'] = array('Devices' => '/', 'Add' => '');
		$data['content'] = 'devices/add';
		$this->load->view('layouts/main/index', $data);
	}
	
	public function edit($id)
	{
		$device = new Device($id);
		$data = $this->_save(array(), $device);
		$data['device'] = $device;
		$data['id'] = $id;
		
		$data['breadcrumbs'] = array('Devices' => '/', $device->hostname . ' (' . $device->address . ')' => '/devices/view/' . $id, 'Edit' => '');
		$data['content'] = 'devices/edit';
		$this->load->view('layouts/main/index', $data);
	}
	
	private function _save($data, $device)
	{
		$this->load->library(array('input', 'form_validation'));
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('community', 'community', 'required');
	
		if ($this->form_validation->run())
		{
			$config['upload_path'] = '../www/images/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '1024';
			$config['max_width'] = '1600';
			$config['max_height'] = '1200';
			$config['encrypt_name'] = True;

			$this->load->library('upload', $config);
		
			$router = new Router($this->input->post('address'), $this->input->post('community'));
			
			if ($router->exists())
			{
				$device->hostname = $router->hostname->name;
				$device->address = $this->input->post('address');
				$device->community = $this->input->post('community');
				
				if ($this->input->post('fakeupload'))
				{
					if (!$this->upload->do_upload('upload'))
					{
						$data['upload_error'] = $this->upload->display_errors();
					}
					else
					{
						$upload_data = $this->upload->data();
						$device->diagram = $upload_data['file_name'];
						$data['saved'] = $device->save();
					}
				}
				else
				{
					$data['saved'] = $device->save();
				}
			}
			else
			{
				$data['saved'] = False;
			}
		}
		
		return $data;
	}
}

/* End of file devices.php */
/* Location: ./app/controllers/devices.php */