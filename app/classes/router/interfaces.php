<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interfaces implements Countable, Iterator
{
	public $description, $type, $mtu, $speed, $mac;
	private $cursor;

	function __construct(&$snmp)
	{
		$this->description	= $snmp->walk("1.3.6.1.2.1.2.2.1.2", 50000);
		$this->type			= $snmp->walk("1.3.6.1.2.1.2.2.1.3", 50000);
		$this->mtu			= $snmp->walk("1.3.6.1.2.1.2.2.1.4", 50000);
		$this->speed		= $snmp->walk("1.3.6.1.2.1.2.2.1.5", 50000);
		$this->mac			= $snmp->walk("1.3.6.1.2.1.2.2.1.6", 50000);
		
		$this->cursor		= -1;
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