<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interfaces implements Countable, Iterator
{
	// These variable names should be derived from the name given by the OID
	public $ifIndex, $description, $type, $mtu, $speed, $mac,
		$ipAdEntAdd, $ipAdEntNetMask;
	private $snmp, $cursor;

	function __construct(&$snmp)
	{
		$this->snmp = $snmp;
	}
	
	public function update()
	{
		try
		{
			
			$this->ifIndex		= $this->snmp->walk("1.3.6.1.2.1.2.2.1.1");
			$this->description	= $this->snmp->walk("1.3.6.1.2.1.2.2.1.2");
			$this->type			= $this->snmp->walk("1.3.6.1.2.1.2.2.1.3");
			$this->mtu			= $this->snmp->walk("1.3.6.1.2.1.2.2.1.4");
			$this->speed		= $this->snmp->walk("1.3.6.1.2.1.2.2.1.5");
			$this->mac			= $this->snmp->walk("1.3.6.1.2.1.2.2.1.6");
			
			
			$this->cursor		= -1;
			
			return True;
		}
		catch(exception $e)
		{
			$this->description	= array();
			$this->type			= array();
			$this->mtu			= array();
			$this->speed		= array();
			$this->mac			= array();
			
			return False;
		}
	}
	
	public function count()
	{
		return count($this->description);
	}
	
	public function rewind()
	{
		$this->cursor = -1;
		$this->next();
	}
	
	public function next()
	{
		$this->cursor++;
	}

	public function current()
	{
		$data = new stdClass();
		$data->ifIndex	= $this->ifIndex[$this->cursor];
		$data->description	= $this->description[$this->cursor];
		$data->type			= $this->type[$this->cursor];
		if ($data->type == 6)
		{
			$data->mtu			= $this->mtu[$this->cursor];
			$data->speed		= $this->speed[$this->cursor];
			$data->mac			= $this->mac[$this->cursor];
			
			
			/* The IP-MIB is terribly designed and the OID to find an IP address
			** actually includes the IP address in the OID... 
			** So we have to do some workaround to directly associate the 
			** address with the interfaces ifIndex. 
			*/
			$ipAdEntAddr		= $this->snmp->walk("1.3.6.1.2.1.4.20.1.1");
			$ipAdEntIfIndex		= $this->snmp->walk("1.3.6.1.2.1.4.20.1.2");
			$ipAdEntNetMask		= $this->snmp->walk("1.3.6.1.2.1.4.20.1.3");
			
			$ipAdEntIfIndex_ipAdEntAdd 		= array_combine($ipAdEntIfIndex, $ipAdEntAddr );
			$ipAdEntIfIndex_ipAdEntNetMask	= array_combine($ipAdEntIfIndex, $ipAdEntNetMask );
			
			$data->ipAdEntAdd = $ipAdEntIfIndex_ipAdEntAdd[$data->ifIndex];
			$data->ipAdEntNetMask = $ipAdEntIfIndex_ipAdEntNetMask[$data->ifIndex];
			
		}
		return $data;
	}
	
	public function key()
	{
		return $this->cursor;
	}

	public function valid()
	{
		return ($this->cursor < $this->count());
	}
}

/* End of file interfaces.php */
/* Location: ./app/classes/router/interfaces.php */
