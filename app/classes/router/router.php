<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'classes/snmp.php';
include APPPATH . 'classes/router/interfaces.php';
include APPPATH . 'classes/router/routes.php';

class Router
{
	private $snmp;
	
	public $host, $community;
	public $interfaces, $routes;
	public $exists = False;

	function __construct($host, $community)
	{
		$this->host = $host;
		$this->community = $community;
		
		$this->snmp = new SNMP($host, $community);

		$this->interfaces = new Interfaces($this->snmp);
		$this->routes = new Routes($this->snmp);
		
		$this->update();
	}
	
	public function update()
	{
		$this->exists = $this->interfaces->update() && $this->routes->update();
		return $this->exists;
	}
	
	public function exists()
	{
		return $this->exists;
	}
}

/* End of file router.php */
/* Location: ./app/classes/router/router.php */