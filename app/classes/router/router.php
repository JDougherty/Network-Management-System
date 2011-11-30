<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'classes/snmp.php';
include APPPATH . 'classes/router/hostname.php';
include APPPATH . 'classes/router/interfaces.php';
include APPPATH . 'classes/router/routes.php';

class Router
{
	private $snmp;
	
	public $address, $community;
	public $hostname, $interfaces, $routes;
	public $exists = False;

	function __construct($address, $community)
	{
		$this->address = $address;
		$this->community = $community;
		
		$this->snmp = new SNMP($address, $community);

		$this->hostname = new Hostname($this->snmp);
		$this->interfaces = new Interfaces($this->snmp);
		$this->routes = new Routes($this->snmp);
		
		$this->update();
	}
	
	public function update()
	{
		$this->exists = $this->hostname->update() && $this->interfaces->update() && $this->routes->update();
		return $this->exists;
	}
	
	public function exists()
	{
		return $this->exists;
	}
}

/* End of file router.php */
/* Location: ./app/classes/router/router.php */