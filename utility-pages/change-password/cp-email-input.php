<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ================================== CSS ===================================== -->
		<link rel="stylesheet" href="../../css/main.css">		
		<link rel="stylesheet" href="../../css/util.css">	
<!-- ============================================================================ -->
	</head>

	<body>
	
		<!-- =============================== IMAGE =============================== -->
		<div class="container-login" style="background-image: url('../../images/main-wallpaper.jpg');">
		<!-- ===================================================================== -->

			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="../../include/verification.php" method="post">
					<span class="login-form-title p-b-37">

						Insert your email

					</span>

					<div class="txt-error p-b-10">
						<?php	

							if(isset($_GET['error_type'])) { 

								$error_type = $_GET['error_type'];

								switch($error_type) {

									case 'empty_email': 
										echo "Empty Email";
									break;

									case 'invalid_email':
										echo "Invalid Email";
									break;

									case 'wrong_email': 
										echo "Wrong Email";
									break;
								}
							}

						?>
					</div>
						
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter email">
						<input id="change_password_email" class=" input" type="text" name="email" placeholder="email">
						<span class="focus-input"></span>
					</div>
						
					<div class="container-login-form-btn">
						<button class="login-form-btn" type="submit" name="insert_email_forgot_password">
							send
						</button>
					</div>

					<div class="text-center p-t-35">
						<a href="../../index.php" class="txt2 hov1">
							Go back
						</a>
					</div>
				</form>
			</div>
		</div>

		<?php 

			if(isset($_GET['error_type'])) { 

				switch($error_type) {

					case 'empty_email': 
							?>
								<script>
									document.getElementById("change_password_email").style.border = "1px solid #f00";
									document.getElementById("change_password_email").style.borderRadius = "20px";
								</script>
							<?php
						break;

					case 'invalid_email': 
						?>
							<script>
								document.getElementById("change_password_email").style.border = "1px solid #f00";
								document.getElementById("change_password_email").style.borderRadius = "20px";
							</script>
						<?php
					break;	

					case 'wrong_email': 
							?>
								<script>
									document.getElementById("change_password_email").style.border = "1px solid #f00";
									document.getElementById("change_password_email").style.borderRadius = "20px";
								</script>
							<?php
						break;
				}
			}

		?>

	</body>
</html>