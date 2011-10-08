<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['content'] = 'test';
		$this->load->view('layouts/main/index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./app/controllers/welcome.php */