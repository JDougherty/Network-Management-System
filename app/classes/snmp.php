<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SNMP
{
	private $host = "";
	private $community = "";

	function __construct($host, $community)
	{
		$this->host = $host;
		$this->community = $community;
	}
	
	private function clean_array($_arr)
	{
		$_ret = array();
		foreach($_arr as $v)
		{
			$v = explode(":", $v);
			if (count($v) > 1)
			{
				$v = $v[1];
				array_push($_ret, $v);
			}
		}
		return $_ret;
	}
	
	public function walk($object_id, $timeout = 50000)
	{
		return $this->clean_array(snmp2_walk($this->host, $this->community, $object_id, $timeout));
	}

}

/* End of file snmp.php */
/* Location: ./app/classes/snmp.php */