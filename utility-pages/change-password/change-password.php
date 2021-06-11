<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ==================================CSS===================================== -->
		<link rel="stylesheet" href="../../css/main.css">		
		<link rel="stylesheet" href="../../css/util.css">	
<!-- ========================================================================== -->
	</head>

	<body>
	
		<div class="container-login" style="background-image: url('../../images/main-wallpaper.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="../../include/verification.php">
				
					<span class="login-form-title p-b-37">
						Change your password
					</span>
	
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter new Password">
						<input class="input" type="text" name="pass" placeholder="new password">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Confirm new password">
						<input class="input" type="password" name="pass1" placeholder="confirm new password">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Change Password
						</button>
					</div>
				</form>
			</div>
		</div>		
	</body>
</html>




