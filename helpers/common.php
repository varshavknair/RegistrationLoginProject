<?php
	require_once((dirname(__FILE__)) . '/../config.php');

	function insert_query($data)
	{
		$con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);
		$key_str					=	"";
		$value_str					=	"";
		$sap						=	"";
		foreach($data as $key => $row)
		{
			$data[$key]				=	mysqli_real_escape_string($con , $row);
			$key_str				.=	$sap." ".$key;
			$value_str				.=	$sap." '".$data[$key]."'";
			$sap					=	", ";
		}

		$sql						=	"INSERT INTO Persons (".$key_str.") VALUES (".$value_str.")";
		$response					=	mysqli_query($con, $sql);

		echo "<pre/>"; print_r($response->fetch_object()); die;
		if(!($response))
		{
			return 1;
		}
		else
		{
			return 0;
		}

		mysqli_close($con);
	}

	function select_query($select, $data = array() , $additional = '')
	{
		// $con						=	mysqli_connect(HOST,USERNAME,PASSWORD,DBA);

		$con						=	mysql_connect(HOST,USERNAME,PASSWORD);
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}

		if (!mysql_select_db(DBA, $link)) {
			echo 'Could not select database';
			exit;
		}

		mysql_select_db(DBA, $con);

		$where_str					=	"";
		$sap						=	"";

		// echo "<pre/>"; print_r($data); die;
		foreach($data as $key => $row)
		{
			$cur_val				=	mysql_real_escape_string($row);
			$where_str				.=	$sap.$key."='".$cur_val."'";
			$sap					=	" AND ";
		}

		$where_str					=	($where_str)?$where_str:"1";
		$sql						=	$select." WHERE ".$where_str.$additional;
		// echo $sql; die;
		$response					=	mysql_query($sql);

		echo "<pre/>"; print_r($response); die;
		if(!($response))
		{
			return 1;
		}
		else
		{
			return 0;
		}

		mysqli_close($con);
	}


	function encrypt($plaintext)
	{
		return base64_encode($plaintext);
	} 
	
	function decrypt($plaintext)
	{
		return base64_decode($plaintext);
	}
?>