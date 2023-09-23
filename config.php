<?php
	error_reporting(0);
	define('UPLOADS', 'images/');
	define('BASE', 'helpers/');
	$extention				=	'';
	if($_SERVER['SERVER_NAME']=="varshas-macbook-air.local")
	{
		$extention			=	"FinalSubmit/";
	}

	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' )
	{
		define('URL', 'https://'.$_SERVER['HTTP_HOST'].'/'.$extention);
	}
	else
	{
		define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/'.$extention);
	}
	define('SYSTEM_PASSWORD', 'Varsha');

	// developement environment
	define('HOST', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DBA', 'varsha_project');
	define('ENVIRONMENT', 'development');


	// production environment

	// define('HOST', 'sql3.freemysqlhosting.net');
	// define('USERNAME', 'sql3648018');
	// define('PASSWORD', 'iQwRT3Vcpa');
	// define('DBA', 'sql3648018');
	// define('ENVIRONMENT', 'production');
?>