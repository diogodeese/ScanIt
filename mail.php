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
	unset($_SESSION['login_error']);
?>	
	       
		<div class="container-login" style="background-image: url('images/wll.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="include/server.php" method="POST">

					<span class="login-form-title p-b-37">
						What is your account email?
					</span>

                    <div class="txt-error p-b-10">
						<?php
							require_once("include/text_error.php");
						?>
					</div>
					
                    <div class="wrap-input validate-input m-b-25" data-validate = "email">
						<input id="1" class="input" type="email" name="email" placeholder="email">
						<span class="focus-input"></span>
					</div>

                    <div class="container-login-form-btn">
						<button class="login-form-btn" name="mail">
							Send Password Changer
						</button>
					</div>

                    <div class="container-login-form-btn p-t-30">
							<a href="index.php" class="txt2 hov1">Go back</a>
					</div>
					
				</form>
				
			</div>
			
        </div>
        
<?php

	if(isset($_SESSION['mail_error'])) 
		{
			require_once("include/border_error.php");		
		}
	
	unset($_SESSION['mail_error']);
?>
		
	</body>
</html>