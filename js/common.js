extra_url						=	"/FinalSubmit/",
rest							=	location.host + extra_url,
first							=	window.location.protocol + "//",
domain							=	first + rest;
error_color						=	"#FF715B";
success_color					=	"#1EA896";
font_color						=	"#FFFFFF";

function display_message(message, type)
{
	$(".notifyjs-corner").html("");
	if (type == "success")
	{
		var bg_class			=	"success_bar"
	}
	else
	{
		var bg_class			=	"error_bar";
	}

	$.notify(message,
		{
			showAnimation		:	"slideDown",
			autoHideDelay		:	2000,
			arrowShow			:	true,
			style				:	"bootstrap",
			className			:	bg_class,
			showDuration		:	800,
			autoHide			:	true,
			hideAnimation		:	'fadeOut',
			hideDuration		:	500,
			gap					:	2
		});
}

function validateForm(data)
{
	var response				=	1;
	var check					=	0;
	$.each(data, function(index, obj)
	{
		var key					=	"#"+(obj.id);
		var value				=	$.trim($(key).val());
		var cur_len				=	value.length

		if(value=="")
		{
			response			=	0
			$(key+"_lbl").html("This field cannot be blank");
		}
		else
		{
			if((obj.min_len>cur_len) || (obj.max_len<cur_len))
			{
				response			=	0
				$(key+"_lbl").html("Enter a value within the range of "+obj.min_len+" to "+obj.max_len+" charecters");
			}
			else if(obj.type=="email")
			{
				check			=	isEmail(value);
				if(check==0)
				{
					response	=	0
					$(key+"_lbl").html("Enter a valid email");
				}
			}
			else if(obj.type=="alpha_numeric")
			{
				check			=	isAlphaNumeric(value);
				if(check==0)
				{
					response	=	0
					$(key+"_lbl").html("Only letter and numbers allowed");
				}
			}
			else if(obj.type=="alpha_numericspace")
			{
				check			=	isAlphaNumericSpace(value);
				if(check==0)
				{
					response	=	0
					$(key+"_lbl").html("Only letter, numbers and spaces allowed");
				}
			}
			else if(obj.type=="alpha_numeric_special")
			{
				check			=	isAlphaNumericSpecial(value);
				if(check==0)
				{
					response	=	0
					$(key+"_lbl").html("Password must contain at least 1 alphabet, 1 number and 1 Special charecter");
				}
			}
		}
	});

	return response;
}

function isEmail(email)
{
	var regex					=	/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function isAlphaNumeric(text)
{
	var regex					=	/^[a-zA-Z0-9]+$/;
	return regex.test(text);
}

function isAlphaNumericSpace(text)
{
	var regex					=	/^[a-zA-Z 0-9]+$/;
	return regex.test(text);
}

function isAlphaNumericSpecial(text)
{
	var regex					=	/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&+=!]).*$/;
	return regex.test(text);
}