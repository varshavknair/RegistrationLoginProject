<?php
	require_once((dirname(__FILE__)) . '/common.php');

	$data								=	array(
		'email_address'					=>	$_POST['username'],
		'password'						=>	encrypt($_POST['password'])
	);

	$result								=	select_query("SELECT * FROM users", $data);
	if($result[0]['id'])
	{
		unset($result[0]['password']);
		$_SESSION['user_details']		=	$result[0];
		$_SESSION['user_details']['id']	=	encrypt($result[0]['id']);
		$PublicIP						=	get_client_ip();
		$json							=	file_get_contents("http://ipinfo.io/$PublicIP/geo");
		$json							=	json_decode($json, true);
		$login_data						=	array(
			'timezone'					=>	$json['timezone'],
			'country_code'				=>	$json['country'],
			'region'					=>	$json['region'],
			'city'						=>	$json['city']
		);
		
		$_SESSION['login_data']			=	$login_data;
		$login_data['user_id']			=	$result[0]['id'];
		unset($result);
		$result							=	insert_query("login_activity", $login_data);
		
		if($result)
		{
			echo json_encode(array("success" => 1, "message" => "Logged In Successfully"));
			die;
		}
	}
	
	echo json_encode(array("success" => 0, "message" => "Email and / or password does not match. Please check your login details and try again"));
?>