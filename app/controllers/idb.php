<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class idb extends CI_Controller
{
	function __construct()
	{
		$this-> _startup();
		
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}
	
	function _startup()
	{
		$db = return_db();
		$db = $db['default'];
		
		$link = mysql_connect($db['hostname'], $db['username'], $db['password']) or die('Could not connect: ' . mysql_error());
		
		// Create the database if it does not exist
		$sql = 'CREATE DATABASE IF NOT EXISTS ' . $db['database'];
		mysql_query($sql, $link) or die('Could not create database: ' . mysql_error());

		mysql_close($link);
	}
	
	function index()
	{
		$data['content'] = 'idb/form';
		$this->load->view('layouts/form/index', $data);
	}
	
	function initialize()
	{
		$this->load->model('idb_model');
		
		if ($this->input->post('dropped_database'))
		{
			$this->load->database();
			$this->load->dbforge();
			
			$dbname = $this->db->database;
			$data['dropped_database'] = $this->dbforge->drop_database($dbname) + $this->dbforge->create_database($dbname);
		}
		
		$data['dropped_tables'] = $this->idb_model->drop_tables();
        $data['created_tables']['devices'] = $this->idb_model->create_devices();
		
		$data['content'] = 'idb/status';
		$this->load->view('layouts/form/index', $data);
	}
}
/* End of file idb.php */
/* Location: ./app/controllers/idb.php */