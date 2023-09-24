<?php
	require_once((dirname(__FILE__)) . '/header.php');

	if(!($_SESSION['user_details']['id']))
	{
		?>
		<script>
			window.location	=	domain;
		</script>
		<?php
		exit;
	}
?>
		<nav class="navbar navbar-inverse navbar-fixed-top ">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" href="#">Varsha Nair Project</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="home.php">Dashboard</a></li>
					<li><a href="profile.php">Profile</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a></li>
				</ul>
			</div>
		</nav>
		<div id="dashboad" class="container padding-top">
			<div class="col-md-12 col-md-12 col-lg-12 bg_profile">
				<h1 class="title">You have successfully logged in</h1>
				<?php if($_SESSION['user_details']['is_verified']=="0") { ?>
					<h3>An email verification link has been sent to your email.</h3>
				<?php } ?>
			</div>
		</div>
	</body>
</html>