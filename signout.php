<?php
	require_once((dirname(__FILE__)) . '/helpers/common.php');
	session_unset();
    session_destroy();

	/* This will give an error. Note the output
	* above, which is before the header() call */
	header('Location: '.URL);
?>