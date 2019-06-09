<?php
//phpinfo();
//exit;
require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	define('BASEPATH', __DIR__.'/');
	
	$config['dbname'] = 'contaazul';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '$T44zg1g1';
} else {
	define('BASEPATH', __DIR__.'/');
	$config['dbname'] = 'contaazul';
	$config['host'] = 'dreamworks.caxubee3zyde.us-east-2.rds.amazonaws.com';
	$config['dbuser'] = 'vinicius';
	$config['dbpass'] = 't44zg1g1';
}
?>

