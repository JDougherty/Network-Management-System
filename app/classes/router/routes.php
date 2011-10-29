<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Routes implements Countable, Iterator
{
	public $protocol, $destination, $metric_1, $next_hop;
	private $snmp, $cursor;

	function __construct(&$snmp)
	{
		$this->snmp = $snmp;
	}
	
	public function update()
	{
		try
		{
			$this->protocol		= $this->snmp->walk("1.3.6.1.2.1.4.21.1.9");
			$this->destination	= $this->snmp->walk("1.3.6.1.2.1.4.21.1.1");
			$this->metric_1		= $this->snmp->walk("1.3.6.1.2.1.4.21.1.3");
			$this->next_hop		= $this->snmp->walk("1.3.6.1.2.1.4.21.1.7");
		
			$this->cursor		= -1;
			
			return True;
		}
		catch(exception $e)
		{
			$this->protocol		= array();
			$this->destination	= array();
			$this->metric_1		= array();
			$this->next_hop		= array();
			
			return False;
		}
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