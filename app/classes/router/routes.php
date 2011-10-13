<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Routes implements Countable, Iterator
{
	public $protocol, $destination, $metric_1, $next_hop;
	private $cursor;

	function __construct(&$snmp)
	{
		$this->protocol		= $snmp->walk("1.3.6.1.2.1.4.21.1.9", 50000);
		$this->destination	= $snmp->walk("1.3.6.1.2.1.4.21.1.1", 50000);
		$this->metric_1		= $snmp->walk("1.3.6.1.2.1.4.21.1.3", 50000);
		$this->next_hop		= $snmp->walk("1.3.6.1.2.1.4.21.1.7", 50000);
		
		$this->cursor		= -1;
	}
	
	public function count()
	{
		return count($this->protocol);
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
		$data->protocol		= $this->protocol[$this->cursor];
		$data->destination	= $this->destination[$this->cursor];
		$data->metric_1		= $this->metric_1[$this->cursor];
		$data->next_hop		= $this->next_hop[$this->cursor];
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

/* End of file routes.php */
/* Location: ./app/classes/router/routes.php */