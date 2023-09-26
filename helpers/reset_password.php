<?php
	require_once((dirname(__FILE__)) . '/common.php');

	$data								=	array(
		'email_address'					=>	$_POST['email']
	);

	$result								=	select_query("SELECT id, email_address FROM users", $data);
	if($result[0]['id'])
	{
		$password						=	random_strings(10);
		$enc_pass						=	encrypt($password);
		update_query("users", array("password" => $enc_pass), array("id" => $result[0]['id']));
		generate_password($password, $result[0]['email_address']);
		echo json_encode(array("success" => 1, "message" => "New password sent to your email"));
		die;
	}
	
	echo json_encode(array("success" => 0, "message" => "Email is not registered. Register to create account"));
?>
