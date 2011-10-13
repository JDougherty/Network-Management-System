<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'classes/snmp.php';
include APPPATH . 'classes/router/interfaces.php';
include APPPATH . 'classes/router/routes.php';

class Router
{
	private $snmp = NULL;
	
	public $host = "";
	public $community = "";
	
	public $interfaces = NULL;
	public $routes = NULL;

	function __construct($host, $community)
	{
		$this->host = $host;
		$this->community = $community;
		
		$this->snmp = new SNMP($host, $community);
		$this->interfaces = new Interfaces($this->snmp);
		$this->routes = new Routes($this->snmp);
	}

}

/* End of file router.php */
/* Location: ./app/classes/router/router.php */