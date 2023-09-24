<?php
	require_once((dirname(__FILE__)) . '/header.php');

	if($_SESSION['user_details']['id']!="")
	{
		?>
		<script>
			window.location	=	domain+"/home.php";
		</script>
		<?php
		exit;
	}
?>
		<div id="mainWrap">
			<div id="xlogin" >
				<form action="helpers/login.php" method="POST" id="logForm" class="form-horizontal">
					<h1>Login</h1>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw user_icons"></i></span>
								<input name="username" id="username" type="text" class="form-control input-lg" placeholder="E-mail" autocomplete="off">
							</div>
							<div class="error-group">
								<span id="username_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw user_icons"></i></span>
								<input name="password" id="password" type="password" class="form-control input-lg" placeholder="Password" autocomplete="off">
							</div>
							<div class="error-group">
								<span id="password_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 pull-right forgot_password">
							<span class="url_link forgot_password_link">Forgot Password</span>
						</div>
					</div>
					<div class="form-group formSubmit">
						<div class="col-sm-12 submitWrap">
							<button id="login" class="btn btn-primary btn-lg">Login</button>
						</div>
					</div>
					<hr>
					<div class="form-group formNotice register_now">
						<div class="col-xs-12">
							<h3 class="text-center">Don't have a account? <span class="url_link"> Register now!</span></h3>
						</div>
					</div>
				</form>
				<form action="helpers/reset_password.php" method="POST" id="resetForm" class="form-horizontal">
					<h1>Reset Password</h1>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw user_icons"></i></span>
								<input name="email" id="send_email" type="text" class="form-control input-lg" placeholder="Enter E-mail Address" autocomplete="off">
							</div>
							<div class="error-group">
								<span id="send_email_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group formSubmit">
						<div class="col-sm-12 submitWrap">
							<button id="reset_password" class="btn btn-primary btn-lg">Reset Password</button>
						</div>
					</div>
					<hr>
					<div class="form-group formNotice for_login_now">
						<div class="col-xs-12">
							<h3 class="text-center"><span class="url_link">Back to login page</span></h3>
						</div>
					</div>
				</form>
				<form action="helpers/register.php" method="POST" id="regForm" class="form-horizontal">
					<h1>Register Now</h1>
					<div class="form-group" style="margin-bottom: 10px;">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-tie fa-fw user_icons"></i></span>
								<input name="name" id="reg_name" type="text" class="form-control input-lg" placeholder="Full Name" autocomplete="off" >
							</div>
							<div class="error-group">
								<span id="reg_name_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group img_wrapper">
								<span class="input-group-addon" style="padding-top: 0px;"><i class="fa fa-image user_icons" style="left: 10px;top: 26px;"></i></span>
								<div class="col-md-6 form-group file-wrapper">
									<input name="profile_img" id="reg_image" type="file" class="col form-control text-field-box mt-3" placeholder="Select Profile Image">
									<label class="ml-3">Choose Profile Image</label>

								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw user_icons"></i></span>
								<input name="email" id="reg_email" type="text" class="form-control input-lg" placeholder="E-mail" autocomplete="off" >
							</div>
							<div class="error-group">
								<span id="reg_email_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw user_icons"></i></span>
								<input name="password" id="reg_password" type="password" class="form-control input-lg" placeholder="Password" autocomplete="off">
							</div>
							<div class="error-group">
								<span id="reg_password_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw user_icons"></i></span>
								<input name="confirm_password" id="reg_confirm_password" type="password" class="form-control input-lg" placeholder="Confirm Password" autocomplete="off">
							</div>
							<div class="error-group">
								<span id="reg_confirm_password_lbl" class="error_msg_lbl">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="form-group formSubmit">
						<div class="col-sm-12 submitWrap">
							<button id="register" class="btn btn-primary btn-lg">Register</button>
						</div>
					</div>
					<hr>
					<div class="form-group formNotice2 login_now">
						<div class="col-xs-12">
							<h3>
								<p class="text-center">Already have a account? <span class="url_link">Login</span></p>
							</h3>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
	<footer>
		<script src="js/ajaxForm.js"></script>
	</footer>
</html>