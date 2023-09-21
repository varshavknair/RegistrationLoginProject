<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>
	<link href="css/main.css" rel="stylesheet" media="all">
	</head>
	<body>
		<div class="container">
			<div class="registration-box">
				<h2>Registration Form</h2>
				<form action="#">
					<div class="input-container">
						<input type="text" name="name" required>
						<label for="name">Full Name</label>
					</div>
					<div class="input-container">
						<input type="email" name="email" required>
						<label for="email">Email</label>
					</div>
					<div class="input-container">
						<input type="password" name="password" required>
						<label for="password">Password</label>
					</div>
					<div class="input-container">
						<input type="password" name="confirm-password" required>
						<label for="confirm-password">Confirm Password</label>
					</div>
					<button type="submit">Register</button>
				</form>
			</div>
		</div>
	</body>
</html>
