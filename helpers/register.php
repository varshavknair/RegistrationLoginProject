<?php
	require_once((dirname(__FILE__)) . '/common.php');

	$result								=	select_query("SELECT id FROM users", array("email_address" => $_POST['username']));
	if($result[0]['id'])
	{
		echo json_encode(array("success" => 0, "message" => "Email already registered. Please try to login"));
	}

	$data								=	array(
		'email_address'					=>	$_POST['email'],
		'name'							=>	$_POST['name'],
		'password'						=>	encrypt($_POST['password'])
	);
	if($_FILES['profile_img']['tmp_name'])
	{
		$img_path						=	upload_file($_FILES['profile_img']);
		if(($img_path=="") || ($img_path==false))
		{
			echo json_encode(array("success" => 0, "message" => "There was an error uploading image. Upload a file less than 5KB"));
			die;
		}
		$data['profile_picture']		=	$img_path;
	}

	$result							    =	insert_query("users", $data);
	
	if($result)
	{
	    $response						=	select_query("SELECT * FROM users", array("id" => $result));
	    $_SESSION['user_details']		=	$response[0];
		$_SESSION['user_details']['id']	=	encrypt($response[0]['id']);
		$PublicIP						=	get_client_ip();
		$json							=	file_get_contents("http://ipinfo.io/$PublicIP/geo");
		$json							=	json_decode($json, true);
		$login_data						=	array(
			'timezone'					=>	$json['timezone'],
			'country_code'				=>	$json['country'],
			'region'					=>	$json['region'],
			'city'						=>	$json['city']
		);
		
		verify_email($response[0]['id'], $response[0]['email_address']);
		$_SESSION['login_data']			=	$login_data;
		$login_data['user_id']			=	$response[0]['id'];
		unset($result, $response);
		$result							=	insert_query("login_activity", $login_data);

		echo json_encode(array("success" => 1, "message" => "User registered successfully"));
		die;
	}

	echo json_encode(array("success" => 0, "message" => "There was an error. Please try again"));
?>
