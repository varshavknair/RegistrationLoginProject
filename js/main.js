var lock_form								=	0;
var locked_form								=	"Please wait for the current request to process!";

var regForm									=	[
	{id:"reg_email", type:"email", min_len:10, max_len:40, compare:0},
	{id:"reg_name", type:"alpha_numericspace", min_len:2, max_len:50, compare:0},
	{id:"reg_password", type:"alpha_numeric_special", min_len:8, max_len:20, compare:1, compare_field:"reg_confirm_password"},
	{id:"reg_confirm_password", type:"alpha_numeric_special", min_len:8, max_len:20, compare:0}
];

var loginForm								=	[
	{id:"username", type:"email", min_len:8, max_len:50, compare:0},
	{id:"password", type:"text", min_len:8, max_len:40, compare:0}
];

var resetForm								=	[
	{id:"send_email", type:"email", min_len:10, max_len:40, compare:0}
];

$(document).ready(function()
{
	$("#xlogin").fadeIn(1000);
	$("#regForm_group").hide();
	$("#resetForm_group").hide();
	var height;
	$('.register_now').click(function(e)
	{
		if(lock_form==0)
		{
			height							=	($("#regForm").height()) + 30;
			$("#xlogin").css("height", height);
			$("#regForm").fadeIn(700);
			$("#regForm_group").fadeIn(700);
			$("#logForm").hide();
			$("#logForm_group").hide();
		}
		else if(lock_form==1)
		{
			display_message(locked_form,"error");
		}
	});

	$('#reg_image').change(function(e)
	{
		var cur_img							=	($(this).val()).split("\\");
		var cur_len							=	cur_img.length - 1;
		var cur_val							=	cur_img[cur_len];
		var str_len							=	cur_val.length;
		if(str_len>33)
		{
			cur_val							=	(cur_val.slice('0', 30))+"...";
		}
		$(".ml-3 ").html(cur_val);
	});

	$('.login_now').click(function(e)
	{
		if(lock_form==0)
		{
			height							=	($("#logForm").height()) + 30;
			$("#xlogin").css("height", height);
			$("#logForm").fadeIn(900);
			$("#logForm_group").fadeIn(900);
			$("#regForm").hide();
			$("#regForm_group").hide();
		}
		else if(lock_form==1)
		{
			display_message(locked_form,"error");
		}
	});

	$('.forgot_password').click(function(e)
	{
		if(lock_form==0)
		{
			height							=	($("#resetForm").height()) + 30;
			$("#xlogin").css("height", height);
			$("#resetForm").fadeIn(700);
			$("#resetForm_group").fadeIn(700);
			$("#logForm").hide();
			$("#logForm_group").hide();
		}
		else if(lock_form==1)
		{
			display_message(locked_form,"error");
		}
	});

	$('.for_login_now').click(function(e)
	{
		if(lock_form==0)
		{
			height							=	($("#logForm").height()) + 30;
			$("#xlogin").css("height", height);
			$("#logForm").fadeIn(900);
			$("#logForm_group").fadeIn(900);
			$("#resetForm").hide();
			$("#resetForm_group").hide();
		}
		else if(lock_form==1)
		{
			display_message(locked_form,"error");
		}
	});

	$('#login').click(function(e)
	{
		$(".error_msg_lbl").html("&nbsp;")
		if(lock_form==0)
		{
			lock_form						=	1;
			$('#logForm').ajaxForm(
			{
				beforeSubmit : function(arr, $form, options)
				{
					$("#login").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
					var check				=	validateForm(loginForm);
					if(check==0)
					{
						lock_form			=	0;
						$("#login").html('Login');
						return false
					}
				},
				success: function(data)
				{
					lock_form				=	0;
					var result				=	jQuery.parseJSON(data);
					if(result.success==0)
					{
						display_message(result.message,"error");
						$("#login").html('Login');
					}
					else
					{
						display_message(result.message,"success");
						$("#login").html('Login');
						setTimeout(function() 
						{
							window.location	=	domain+"home.php";
						}, 500);
					}
				}
			});
		}
		else
		{
			display_message(locked_form,"error");
		}
	});

	$('#register').click(function(e)
	{
		$(".error_msg_lbl").html("&nbsp;")
		if(lock_form==0)
		{
			lock_form						=	1;
			$('#regForm').ajaxForm(
			{
				beforeSubmit : function(arr, $form, options)
				{
					$("#register").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
					var check				=	validateForm(regForm);
					if(check==0)
					{
						lock_form			=	0;
						$("#register").html('Register');
						return false
					}
				},
				success: function(data)
				{
					lock_form				=	0;
					var result				=	jQuery.parseJSON(data);
					if(result.success==0)
					{
						display_message(result.message,"error");
						$("#register").html('Register');
					}
					else
					{
						display_message(result.message,"success");
						$("#register").html('Register');
						setTimeout(function() 
						{
							window.location	=	domain+"home.php";
						}, 500);
					}
				}
			});
		}
		else
		{
			display_message(locked_form,"error");
		}
	});

	$('#reset_password').click(function(e)
	{
		$(".error_msg_lbl").html("&nbsp;")
		if(lock_form==0)
		{
			lock_form						=	1;
			$('#resetForm').ajaxForm(
			{
				beforeSubmit : function(arr, $form, options)
				{
					$("#reset_password").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
					var check				=	validateForm(resetForm);
					if(check==0)
					{
						lock_form			=	0;
						$("#reset_password").html('Reset Password');
						return false
					}
				},
				success: function(data)
				{
					lock_form				=	0;
					var result				=	jQuery.parseJSON(data);
					if(result.success==0)
					{
						display_message(result.message,"error");
						$("#reset_password").html('Reset Password');
					}
					else
					{
						display_message(result.message,"success");
						$("#reset_password").html('Reset Password');
						$(".for_login_now").trigger("click");
					}
				}
			});
		}
		else
		{
			display_message(locked_form,"error");
		}
	});
});