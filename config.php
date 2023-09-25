<?php
    session_start();
	error_reporting(0);
	define('UPLOADS', 'images/');
	define('BASE', 'helpers/');
	$extention				=	'';

	if($_REQUEST['Debug']=='1')
	{
		error_reporting(1);
	}
	if($_REQUEST['session']=='1')
	{
		echo "<pre/>"; print_r($_SESSION); die;
	}
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
// 	define('HOST', 'localhost');
// 	define('USERNAME', 'root');
// 	define('PASSWORD', '');
// 	define('DBA', 'varsha_project');
// 	define('ENVIRONMENT', 'development');


	// production environment

	define('HOST', 'localhost');
	define('USERNAME', 'id21302431_varsha');
	define('PASSWORD', 'Varsha@123');
	define('DBA', 'id21302431_varshaproject');
	define('ENVIRONMENT', 'production');
?>
