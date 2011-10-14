<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'classes/router/router.php';

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data = array();
	
		$this->load->library(array('input', 'form_validation'));
		$this->form_validation->set_rules('host', 'host', 'required');
		$this->form_validation->set_rules('community', 'community', 'required');
	
		if ($this->form_validation->run())
		{
			$router = new Router($this->input->post('host'), $this->input->post('community'));
			if ($router->exists()) $data['router'] = $router;
			else $data['message'] = "Unable to communicate with router.";
		}
		
		$data['content'] = 'test';
		$this->load->view('layouts/main/index', $data);
	}
}

/* End of file home.php */
/* Location: ./app/controllers/home.php */