<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ================================== CSS ===================================== -->
		<link rel="stylesheet" href="../css/main.css">		
		<link rel="stylesheet" href="../css/util.css">	
<!-- ============================================================================ -->
	</head>

	<body>
	
		<!-- =============================== IMAGE =============================== -->
		<div class="container-login" style="background-image: url('../images/main-wallpaper.jpg');">
		<!-- ===================================================================== -->

		<?php 
			
			$email = $_GET['email'];
			$button = $_GET['button'];

		?>

			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="../include/verification.php" method="post">
				
					<input type="hidden" name="email" value="<?php echo $email ?>">

					<span class="login-form-title p-b-37">Insert your code</span>
						
					<div class="wrap-input validate-input  m-b-20" data-validate="Enter email">
						<input id="1" class=" input" type="text" name="code" placeholder="Ex: 1234" required>
						<span class="focus-input"></span>
					</div>

					<?php if($button == 'forgot_pass') { ?>

						<!-- =============================== PASSWORD CODE =============================== -->
						<div class="container-login-form-btn">
							<button class="login-form-btn" type="submit" name="insert_code_forgot_password">
								send
							</button>
						</div>
						<!-- ============================================================================= -->

					<?php } elseif($button == 'email_confirmation') { ?>

						<!-- =============================== EMAIL CONFIRMATION =============================== -->
						<div class="container-login-form-btn">
							<button class="login-form-btn" type="submit" name="insert_code_email_confirmation">
								send
							</button>
						</div>
						<!-- ================================================================================== -->

					<?php } ?>

				</form>	
			</div>	
		</div>
	</body>
</html>