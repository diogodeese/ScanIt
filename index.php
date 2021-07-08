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

	</head>

	<body>

	<?php session_start(); ?>

		<div class="container-login" style="background-image: url('images/main-wallpaper.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="include/verification.php" method="POST">
				
					<span class="login-form-title p-b-37">
						Login
					</span>
					
					<div class="txt-error p-b-10">
						<?php	

							if(isset($_GET['error_type'])) { 

								$error_type = $_GET['error_type'];

								switch($error_type) {

									case 'empty_user': 
											echo "Empty Username";
										break;

									case 'empty_pass': 
											echo "Empty Password";
										break;

									case 'wrong_user': 
											echo "This Username does not exist";
										break;

									case 'wrong_pass': 
											echo "Wrong Password";
										break;

								}
							}

						?>
					</div>
					
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter username or email">
						<input id="login_username" class=" input" type="text" name="username" placeholder="username">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Enter password">
						<input id="login_password" class="input" type="password" name="password" placeholder="password">
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
						<a href="sign-up" class="txt2 hov1">
							Sign up
						</a>
					</div>
					
					<div class="text-center p-t-57 p-b-20">
						<span class="txt1">
							Forgot your password?
						</span>
					</div>

					<div class="text-center">
						<a href="utility-pages/change-password/cp-email-input" class="txt2 hov1">
							Click here!
						</a>
					</div>
				</form>	
			</div>	
		</div>	

	<?php 

		if(isset($_GET['error_type'])) { 

			switch($error_type) {

				case 'empty_user': 
						?>
							<script>
								document.getElementById("login_username").style.border = "1px solid #f00";
								document.getElementById("login_username").style.borderRadius = "20px";
							</script>
						<?php
					break;

				case 'empty_pass': 
						?>
							<script>
								document.getElementById("login_password").style.border = "1px solid #f00";
								document.getElementById("login_password").style.borderRadius = "20px";
							</script>
						<?php
					break;

				case 'wrong_user': 
						?>
							<script>
								document.getElementById("login_username").style.border = "1px solid #f00";
								document.getElementById("login_username").style.borderRadius = "20px";
							</script>
						<?php
					break;

				case 'wrong_pass': 
						?>
							<script>
								document.getElementById("login_password").style.border = "1px solid #f00";
								document.getElementById("login_password").style.borderRadius = "20px";
							</script>
						<?php
					break;

			}
		}

	?>		
		
	</body>
</html>




