<?php
if ( ! function_exists('debug'))
{

	function debug($svar, $die = false)
	{
		//$obj =& get_instance();

		print_r($svar);echo PHP_EOL;
		
		if($die)
			die();
	
	}
}

