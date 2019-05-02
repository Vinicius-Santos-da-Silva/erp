<?php
//phpinfo();
//exit;
require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'contaazul';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '$T44zg1g1';
} else {
	$config['dbname'] = 'YY3Vx3rhhr';
	$config['host'] = 'remotemysql.com';
	$config['dbuser'] = 'YY3Vx3rhhr';
	$config['dbpass'] = 'cYOorvoU1N';
}
?>