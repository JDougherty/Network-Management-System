<?php

class MY_Input extends CI_Input
{
	function post($index = '', $xss_clean = FALSE)
	{
		if($index === '')
			return ($_SERVER['REQUEST_METHOD'] === 'POST');

		return parent::post($index, $xss_clean);
	}
}