<?php
	require_once((dirname(__FILE__)) . '/common.php');

	
	$data							=	array(
		'email_address'				=>	$_POST['username'],
		'password'					=>	encrypt($_POST['password'])
	);
	
	$result							=	select_query("SELECT * FROM users", $data);
	echo "<pre/>"; print_r($result); die;
	echo json_encode(array("success" => 1, "message" => "done"));
?>