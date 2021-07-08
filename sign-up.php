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
						Sign Up
					</span>
					
					<div class="txt-error p-b-10">
						<?php
							
							if(isset($_GET['error_type'])) { 

								$error_type = $_GET['error_type']; 

								switch($error_type) {

									case 'empty_user': 
											echo "Empty Username";
										break;

									case 'empty_email': 
											echo "Empty Email";
										break;

									case 'empty_pass1': 
											echo "Empty Password";
										break;

									case 'empty_pass2': 
											echo "Confirm your Password";
										break;

									case 'different_passwords':
											echo "Passwords doesn't match";
										break;

									case 'user_exists': 
											echo "This Username already exists";
										break;

									case 'email_exists': 
											echo "An account is already created with this email";
										break;
								}
							}
						?>
					</div>
					
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter username">
						<input id="register_username" class="input" type="text" name="user" placeholder="username">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter Email">
						<input id="register_email" class="input" type="email" name="email" placeholder="email">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Enter password">
						<input  id="register_password1" class="input" type="password" name="pass1" placeholder="password">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Confirm password">
						<input id="register_password2" class="input" type="password" name="pass2" placeholder="Confirm password">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn" name="register">
							Create Account
						</button>
					</div>
					
					<div class="text-center p-t-57 p-b-20">
						<span class="txt1">
							Already have an account?
						</span>
					</div>

					<div class="text-center">
						<a href="index.php" class="txt2 hov1">
							Login
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
									document.getElementById("register_username").style.border = "1px solid #f00";
									document.getElementById("register_username").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'empty_email': 
							?>
								<script>
									document.getElementById("register_email").style.border = "1px solid #f00";
									document.getElementById("register_email").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'empty_pass1':  
							?>
								<script>
									document.getElementById("register_password1").style.border = "1px solid #f00";
									document.getElementById("register_password1").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'empty_pass2': 
							?>
								<script>
									document.getElementById("register_password2").style.border = "1px solid #f00";
									document.getElementById("register_password2").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'different_passwords': 
							?>
								<script>
									document.getElementById("register_password1").style.border = "1px solid #f00";
									document.getElementById("register_password1").style.borderRadius = "20px";
									document.getElementById("register_password2").style.border = "1px solid #f00";
									document.getElementById("register_password2").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'user_exists': 
							?>
								<script>
									document.getElementById("register_username").style.border = "1px solid #f00";
									document.getElementById("register_username").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'email_exists': 
							?>
								<script>
									document.getElementById("register_email").style.border = "1px solid #f00";
									document.getElementById("register_email").style.borderRadius = "20px";
								</script>
							<?php
						break;
				}
			}

		?>

	</body>
</html>




