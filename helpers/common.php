<?php
	require_once((dirname(__FILE__)) . '/../config.php');

	/*
		Author			:	Varsha Nair
		Parameters		:	$table - table name; $data - array of data needing to be inserted
		Return			:	$insert_id - row id / if failed returns 0
		Description		:	Common Insert query
		Created on		:	23 Sep 2023
	*/
	function insert_query($table, $data)
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);

		$key_str					=	"";
		$value_str					=	"";
		$sap						=	"";
		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row); // escape all special characters
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

	/*
		Author			:	Varsha Nair
		Parameters		:	$table - table name; $data - array of data needing to be inserted; $whr - array of data in where condition
		Return			:	1 - success ; 2-> failure
		Description		:	Common Insert query
		Created on		:	23 Sep 2023
	*/
	function update_query($table, $data, $whr)
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);

		$value_str					=	"";
		$sap						=	"";
		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row); // escape all special characters
			$value_str				.=	$sap.$key." = '".$cur_val."'";
			$sap					=	", ";
		}

		$where_str					=	"";
		$sap						=	"";

		foreach($whr as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row); // escape all special characters
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

	/*
		Author			:	Varsha Nair
		Parameters		:	$select - Select query ; $data - array of columns for where clause; $additional - additional conditions (eg: ORDER BY)
		Return			:	$response - associative array of all records
		Description		:	Fetch Data from DB - Select Query
		Created on		:	23 Sep 2023
	*/
	function select_query($select, $data = array() , $additional = '')
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);

		$where_str					=	"";
		$sap						=	"";

		foreach($data as $key => $row)
		{
			$cur_val				=	mysqli_real_escape_string($con, $row); // escape all special characters
			$where_str				.=	$sap.$key."='".$cur_val."'";
			$sap					=	" AND ";
		}

		$where_str					=	($where_str)?$where_str:"1";
		$sql						=	$select." WHERE ".$where_str.$additional;
		$response					=	array();

		if ($result = mysqli_query($con, $sql))
		{
			// Fetching associative array from each row of the table
			while ($row = mysqli_fetch_assoc($result))
			{
				$response[]			=	$row;
			}
			mysqli_free_result($result);
		}

		mysqli_close($con);
		return $response;
	}

	/*
		Author			:	Varsha Nair
		Parameters		:	$text - plain text
		Return			:	$cipher - encrypted text
		Description		:	Encrypts the text
		Created on		:	23 Sep 2023
	*/
	function encrypt($text)
	{
		$cryptKey				=	'qJB0rGtIn5UB1xG03efyCp';
		$cipher					=	base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $text, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return $cipher;
	}

	/*
		Author			:	Varsha Nair
		Parameters		:	$cipher - encrypted text
		Return			:	$text - decrypted text
		Description		:	Decrypts the text
		Created on		:	23 Sep 2023
	*/
	function decrypt($cipher)
	{
		$cryptKey				=	'qJB0rGtIn5UB1xG03efyCp';
		$text					=	rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode($cipher), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return $text;
	}

	/*
		Author			:	Varsha Nair
		Parameters		:	
		Return			:	$ipaddress - IP Address
		Description		:	Returns the client IP address
		Created on		:	23 Sep 2023
	*/
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

	/*
		Author			:	Varsha Nair
		Parameters		:	$file - uploaded File ($_FILES[file_name])
		Return			:	$disp_target_file - path of the file
		Description		:	Image Upload function
		Created on		:	23 Sep 2023
	*/
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

	/*
		Author			:	Varsha Nair
		Parameters		:	$length_of_string - size of the random string to be generated
		Return			:	a random string from the below charecters of size $length_of_string
		Description		:	Random string genrator
		Created on		:	23 Sep 2023
	*/
	function random_strings($length_of_string)
	{
		$str_result				=	'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}

	/*
		Author			:	Varsha Nair
		Parameters		:	$id - user_id (not used); $to - receipient
		Return			:	
		Description		:	Emailer : Triggered after registration is complete
		Created on		:	23 Sep 2023
	*/
	function verify_email($to)
	{
		$subject				=	'Verify Email Address';
		$message				=	'Click on the link to verify email : '.URL."verifyemail.php?id=".$to;
		$headers				=	'From: varsha@prjectsample.com' . "\r\n" .
			'Reply-To: varsha@prjectsample.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}

	/*
		Author			:	Varsha Nair
		Parameters		:	$password - password for the user; $to - receipient
		Return			:	
		Description		:	Emailer : Triggered after password is reset
		Created on		:	23 Sep 2023
	*/
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
