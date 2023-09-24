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
	$user_data							=	$_SESSION['user_details'];
	$user_data['profile_picture']		=	($user_data['profile_picture'])?$user_data['profile_picture']:"default.jpg";

?>
		<nav class="navbar navbar-inverse navbar-fixed-top ">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" href="#">Varsha Nair Project</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="home.php">Dashboard</a></li>
					<li class="active"><a href="profile.php">Profile</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container padding-top">
			<div id="profile_dashboad" class="col-md-12 col-md-12 col-lg-12 bg_profile inline_flex">
				<div class="col-md-4">
					<div id="profile_img" style="background-image: url('<?php echo URL.$user_data['profile_picture'] ?>')"></div>
				</div>
				<div id="user_details" class="col-md-8">
					<div class="profile-name"><b>Name :</b> <?php echo $user_data['name']; ?></div>
					<div class="profile-email"><b>Email :</b> <?php echo $user_data['email_address']; ?></div>
					<div class="profile-joining-date"><b>Joining Date :</b> <?php echo date("j M 'y", strtotime($user_data['created_on'])); ?></div>
					<div class="profile-verified"><b>Verified :</b> <?php if($user_data['is_verified']=='1') { echo "Yes"; } else { echo "No"; } ?></div>
				</div>
			</div>
		</div>
	</body>
</html>