<?php
	require_once((dirname(__FILE__)) . '/../config.php');

	function insert_query($table, $data)
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);
		$key_str					=	"";
		$value_str					=	"";
		$sap						=	"";
		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row);
			$key_str				.=	$sap." ".$key;
			$value_str				.=	$sap." '".$cur_val."'";
			$sap					=	", ";
		}

		$sql						=	"INSERT INTO ".$table." (".$key_str.") VALUES (".$value_str.")";
		$response					=	mysqli_query($con, $sql);
		$insert_id					=	$con->insert_id;

		mysqli_close($con);
		if($insert_id)
		{
			return $insert_id;
		}
		else
		{
			return 0;
		}
	}

	function update_query($table, $data, $whr)
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);
		$value_str					=	"";
		$sap						=	"";
		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row);
			$value_str				.=	$sap.$key." = '".$cur_val."'";
			$sap					=	", ";
		}

		$where_str					=	"";
		$sap						=	"";

		foreach($whr as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row);
			$where_str				.=	$sap.$key."='".$cur_val."'";
			$sap					=	" AND ";
		}

		$where_str					=	($where_str)?$where_str:"1";

		$sql						=	"UPDATE ".$table." SET ".$value_str." WHERE ".$where_str."";
		$response					=	mysqli_query($con, $sql);

		mysqli_close($con);
		if($response)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function select_query($select, $data = array() , $additional = '')
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);

		$where_str					=	"";
		$sap						=	"";

		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row);
			$where_str				.=	$sap.$key."='".$cur_val."'";
			$sap					=	" AND ";
		}

		$where_str					=	($where_str)?$where_str:"1";
		$sql						=	$select." WHERE ".$where_str.$additional;
		$response					=	array();

		if ($result = mysqli_query($con, $sql))
		{
			// Fetch one and one row
			while ($row = mysqli_fetch_assoc($result))
			{
				$response[]			=	$row;
			}
			mysqli_free_result($result);
		}

		mysqli_close($con);
		return $response;
	}

	function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if (isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}
	
		return $ipaddress;
	}

	function upload_file($file)
	{
		$target_dir				=	"images/";
		$target_file			=	(dirname(__FILE__))."/../" .$target_dir . basename($file["name"]);
		$disp_target_file		=	$target_dir . basename($file["name"]);
		$imageFileType			=	strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check					=	getimagesize($file["tmp_name"]);
		if($check !== false)
		{
			if (move_uploaded_file($file["tmp_name"], $target_file))
			{
				return $disp_target_file;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function random_strings($length_of_string)
	{
		$str_result				=	'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}

	function verify_email($id, $to)
	{
		$subject				=	'Verify Email Address';
		$message				=	'Click on the link to verify email : '.URL."verifyemail.php?id=".$to;
		$headers				=	'From: varsha@prjectsample.com' . "\r\n" .
			'Reply-To: varsha@prjectsample.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}

	function generate_password($password, $to)
	{
		$subject				=	'New Password Generated';
		$message				=	'Your New Password - '.$password;
		$headers				=	'From: varsha@prjectsample.com' . "\r\n" .
			'Reply-To: varsha@prjectsample.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}
?>