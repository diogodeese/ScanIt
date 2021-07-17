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

	<?php
	
		require("../../include/database-connection.php");

		if(isset($_GET['email'])) {
			$email = $_GET['email'];
		}
		
		if(isset($_GET['user'])) {
			$user = $_GET['user'];

			$sql = "SELECT email FROM users WHERE username LIKE '$user'";
			$results = mysqli_query($db, $sql);
			$row = mysqli_fetch_row($results);
			$email = $row[0];
		}

	?>

	<body>
	
		<div class="container-login" style="background-image: url('../../images/main-wallpaper.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="../../include/verification.php" method="POST">
				
					<input type="hidden" name="email" value="<?php echo $email; ?>">

					<span class="login-form-title p-b-37">
						Change your password
					</span>
	
					<div class="txt-error p-b-10">
						<?php	

							if(isset($_GET['error_type'])) { 

								$error_type = $_GET['error_type'];

								switch($error_type) {

									case 'different_passwords': 
											echo "Passwords doesn't match";
										break;

									case 'empty_pass1': 
											echo "Empty Password";
										break;

									case 'empty_pass2': 
											echo "Confirm your password";
										break;
								}
							}

						?>
					</div>

					<div class="wrap-input validate-input  m-b-20" data-validate="Enter new Password">
						<input id="change-password-pass1" class="input" type="password" name="pass1" placeholder="new password">
						<span class="focus-input"></span>
					</div>
					
					<div class="wrap-input validate-input m-b-25" data-validate = "Confirm new password">
						<input id="change-password-pass2" class="input" type="password" name="pass2" placeholder="confirm new password">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn" type="submit" name="change_password">
							Change Password
						</button>
					</div>
				</form>
			</div>
		</div>	

		<?php 

			if(isset($_GET['error_type'])) { 

				switch($error_type) {

					case 'different_passwords': 
							?>
								<script>
									document.getElementById("change-password-pass1").style.border = "1px solid #f00";
									document.getElementById("change-password-pass1").style.borderRadius = "20px";
									document.getElementById("change-password-pass2").style.border = "1px solid #f00";
									document.getElementById("change-password-pass2").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'empty_pass1': 
							?>
								<script>
									document.getElementById("change-password-pass1").style.border = "1px solid #f00";
									document.getElementById("change-password-pass1").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'empty_pass2': 
							?>
								<script>
									document.getElementById("change-password-pass2").style.border = "1px solid #f00";
									document.getElementById("change-password-pass2").style.borderRadius = "20px";
								</script>
							<?php
						break;
				}
			}

		?>		

	</body>
</html>




