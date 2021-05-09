<!DOCTYPE html>	
<html lang="pt">
	<head>
		<title> ScanIt </title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ==================================CSS===================================== -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/util.css">
<!-- ========================================================================== -->

		<script>
			document.getElementById("error").style.borderColor = "red";
		</script>


	</head>

	<body>

<?php 
	session_start();

	unset($_SESSION['singup_error']);
	unset($_SESSION['mail_error']);
?>

		<div class="container-login" style="background-image: url('images/wll.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="include/verification.php" method="POST">
				
					<span class="login-form-title p-b-37">
						Login
					</span>
					
					<div class="txt-error p-b-10">
						<?php
							require_once("include/text_error.php");
						?>
					</div>
					
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter username or email">
						<input id="1" class=" input" type="text" name="username" placeholder="username">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Enter password">
						<input id="2" class="input" type="password" name="password" placeholder="password">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn" name="login">
							Sign In
						</button>
					</div>
					
					<div class="text-center p-t-57 p-b-20">
						<span class="txt1">
							Don't have an account?
						</span>
					</div>

					<div class="text-center">
						<a href="singup.php" class="txt2 hov1">
							Sign up
						</a>
					</div>
					
					<div class="text-center p-t-57 p-b-20">
						<span class="txt1">
							Forgot your password?
						</span>
					</div>

					<div class="text-center">
					<!-- PATH:  -->
						<a href="asking_4_mail" class="txt2 hov1">
							Click here!
						</a>
					</div>
					
				</form>
				
			</div>
			
		</div>	

<?php 
	
	if(isset($_SESSION['login_error'])) 
		{
			require_once("include/border_error.php");
		}
	
	unset($_SESSION['login_error']);
?>		
		
	</body>
</html>




