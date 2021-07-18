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
		
		if(isset($_GET['user'])) {
			$user = $_GET['user'];

			$sql = "SELECT id FROM users WHERE username LIKE '$user'";
			$results = mysqli_query($db, $sql);
			$row = mysqli_fetch_row($results);
			$id = $row[0];
		}

	?>

	<body>
	
		<div class="container-login" style="background-image: url('../../images/main-wallpaper.jpg');">
			<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
				<form class="login-form" action="../../include/verification.php" method="POST">
				
					<input type="hidden" name="id" value="<?php echo $id; ?>">

					<span class="login-form-title p-b-37">
						Change your Username
					</span>
	
					<div class="txt-error p-b-10">
						<?php	

							if(isset($_GET['error_type'])) { 

								$error_type = $_GET['error_type'];

								switch($error_type) {

									case 'empty_user': 
											echo "Empty username";
										break;
								}
							}

						?>
					</div>

					<div class="wrap-input validate-input  m-b-20" data-validate="Enter new Usernam">
						<input id="change-username" class="input" type="text" name="username" placeholder="new username">
						<span class="focus-input"></span>
					</div>
					
					<div class="container-login-form-btn">
						<button class="login-form-btn" type="submit" name="change_username">
							Change Username
						</button>
					</div>

					<div class="text-center p-t-35">
						<a href="../../home-pages/home" class="txt2 hov1">
							Go back
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
									document.getElementById("change-username").style.border = "1px solid #f00";
									document.getElementById("change-username").style.borderRadius = "20px";
								</script>
							<?php
						break;
				}
			}

		?>		

	</body>
</html>




