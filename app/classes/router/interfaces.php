<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interfaces implements Countable, Iterator
{
	public $description, $type, $mtu, $speed, $mac;
	private $snmp, $cursor;

	function __construct(&$snmp)
	{
		$this->snmp = $snmp;
	}
	
	public function update()
	{
		try
		{
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
		$data->description	= $this->description[$this->cursor];
		$data->type			= $this->type[$this->cursor];
		if ($data->type == 6)
		{
			$data->mtu			= $this->mtu[$this->cursor];
			$data->speed		= $this->speed[$this->cursor];
			$data->mac			= $this->mac[$this->cursor];
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