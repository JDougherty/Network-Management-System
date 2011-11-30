<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hostname
{
	public $name;
	private $snmp;

	function __construct(&$snmp)
	{
		$this->snmp = $snmp;
	}
	
	public function update()
	{
		try
		{
			$this->name	= $this->snmp->walk("1.3.6.1.2.1.1.5");
			$this->name = $this->name[0];
			
			return True;
		}
		catch(exception $e)
		{
			$this->name	= "";
			
			return False;
		}
	}
}

/* End of file hostname.php */
/* Location: ./app/classes/router/hostname.php */