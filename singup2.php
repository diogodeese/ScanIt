<?php
	session_start();

	unset($_SESSION['singup_error']);	
		
	$db = new mysqli ('localhost' , 'root' , '' , 'b14_27673167_site');
	
	
	
	#Register
	if (isset($_POST['register'])) 
		{	
			$_SESSION['singup_error'] = 0;
			
			#Recive the inputs
			$user  = mysqli_real_escape_string($db, $_POST["user"]);
			$email = mysqli_real_escape_string($db, $_POST["email"]);
			$pass1 = mysqli_real_escape_string($db, $_POST["pass1"]);
			$pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
			
			#Verify the inputs
			if(empty($user))      $_SESSION['singup_error'] += 1; 
			if(empty($email))     $_SESSION['singup_error'] += 1;
			if(empty($pass1))     $_SESSION['singup_error'] += 1;
			if(empty($pass2))     $_SESSION['singup_error'] += 1;
			if($pass1 != $pass2)  $_SESSION['singup_error'] += 1;
			
			if($_SESSION['singup_error'] > 0)
				{
					header('location: singup.php');
				}
  
			#Username and email check
			$user_check = "SELECT * FROM users WHERE username='$user' OR email='$email' LIMIT 1";
			$result     = mysqli_query($db, $user_check);
			$username       = mysqli_fetch_assoc($result);
  
			#If Username or email exists
			if ($username) 
				{ 
					if($username['username'] === $user) $_SESSION['singup_error'] += 1;
					if($username['email'] === $email)   $_SESSION['singup_error'] += 1;
				}
				
			#Verifies the singup_error
			if ($_SESSION['singup_error'] == 0) 
				{
					#Password encryptation for security
					$pass = md5($pass1);

					$code =  rand(1000,9999);
					
					#Saving the account in the DB
					$query = "INSERT INTO users ( username, email, password, creation_date, active, activation_code)
					VALUES('$user',  '$email', '$pass', NOW(), 'FALSE', '$code')";
					mysqli_query($db, $query);
					
					#Saves the user and the email in the session
					$_SESSION['user']  = $user;
					$_SESSION['email'] = $email;
					

				
					?>
					<link rel="stylesheet" href="css/main.css">		
					<link rel="stylesheet" href="css/util.css">
							
					<div class="container-login" style="background-image: url('images/wll.jpg');">
						<div class="wrap-login p-l-55 p-r-55 p-t-80 p-b-30">
							<form class="login-form" action="index.php">
						
								<span class="login-form-title p-b-37">
									Your account has been created!
								</span>
							
								<div class="container-login-form-btn">
									
									<button class="login-form-btn">
										Go back				
									</button>
										
								</div>

							</form>
						</div>	
					</div>
<?php 
					}
					
	#End of if
	}

	
?>	
				
		