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
	
	// SNMP Get / Walk returns an array where each value has the format:
	//   Array[0] = "String: \"Foo bar\""
	// Or:
	//   Array[0] = "Integer: 0"
	// 
	// This function strips off the type in the beginning and returns just the 
	//   values. 
	private function clean_array($_arr)
	{
		$_ret = array();
		foreach($_arr as $v)
		{
			/*
			// This way is bad, because sometimes there is more than one colon!
			$v = explode(":", $v);
			if (count($v) > 1)
			{
				$v = $v[1];
				array_push($_ret, $v);
			}*/
			
			// This way is good, since it just skips the value type
			$colon_pos = strpos($v, ":");
			$v = trim(str_replace('"', '', substr($v,$colon_pos+1 , strlen($v) - $colon_pos)));
			array_push($_ret, $v);
			
		}
		return $_ret;
	}
	
	public function walk($object_id, $timeout = 1000000)
	{
		$array = @snmp2_walk($this->host, $this->community, $object_id, $timeout);
		
		// We often do many consecutive walks; it is easier to just throw an exception and 
		// catch it than check every result after every walk
		if ($array === False) throw new Exception("Walk failed.");
		
		return $this->clean_array($array);
	}

}

/* End of file snmp.php */
/* Location: ./app/classes/snmp.php */
