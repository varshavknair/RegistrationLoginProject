<?php
	require_once((dirname(__FILE__)) . '/helpers/common.php');
	$id									=	$_REQUEST['id'];
	$result								=	select_query("SELECT id, email_address FROM users", array("email_address" => $id));
	if($result[0]['id'])
	{
		update_query("users", array("is_verified" => 1, "updated_on" => date("Y-m-d H:i:s")), array("id" => $result[0]['id']));
		$msg							=   "Account Verification Complete";
	}
	else
	{
		$msg							=	"Account Not found";
	}
?>
		<div id="dashboad" class="container">
			<div class="col-md-12 col-md-12 col-lg-12 bg_profile">
				<h1 class="title"><?php echo $msg; ?></h1>
			</div>
		</div>
	</body>
</html>