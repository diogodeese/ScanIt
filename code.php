<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ==================================CSS===================================== -->
		<link rel="stylesheet" href="../../../css/main.css">		
		<link rel="stylesheet" href="../../../css/util.css">	
<!-- ========================================================================== -->
	</head>

	<body>
	
		<div class="container-login" style="background-image: url('../../../images/wll.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form">
				
					<span class="login-form-title p-b-37">
						What is your code?
					</span>
	
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter Email">
						<input class="input" type="text" name="code" maxlength="4" placeholder="enter code">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Change Password
						</button>
					</div>
					<br>
					<div class="text-center">
						<a href="index.php" class="txt2 hov1">
							Go Back
						</a>
					</div>
					
				</form>
				
			</div>
			
		</div>
<?php
	unset($_SESSION['login_error']);
?>		

	</body>
</html>




