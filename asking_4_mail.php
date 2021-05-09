<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ================================== CSS ===================================== -->
		<link rel="stylesheet" href="css/main.css">		
		<link rel="stylesheet" href="css/util.css">	
<!-- ============================================================================ -->
	</head>

	<body>
	
		<!-- =============================== IMAGE =============================== -->
		<div class="container-login" style="background-image: url('images/wll.jpg');">
		<!-- ===================================================================== -->

			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="include/verification.php" method="post">
				
					<span class="login-form-title p-b-37">

						Insert your email

					</span>

					<!-- ======== EDITABLE AREA ======== -->
						
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter email">
						<input id="1" class=" input" type="text" name="email" placeholder="email" required>
						<span class="focus-input"></span>
					</div>
						
					<div class="container-login-form-btn">
						<button class="login-form-btn" type="submit" name="insert_email_forgot_password">
							send
						</button>
					</div>

					<!-- =============================== -->
					
				</form>
				
			</div>
			
		</div>	

	</body>
</html>