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
						<?php
							require_once("../../../include/db_conn.php");

							$email = $_SESSION['email']; 

							$query  = "SELECT activation_code FROM users where email='$email'";					
							$result = mysqli_query($db, $query);
							$code   = mysqli_fetch_assoc($result);

							echo $code;
						?>
					</span>
					
				</form>
				
			</div>
			
		</div>
<?php
	unset($_SESSION['login_error']);
?>		

	</body>
</html>




