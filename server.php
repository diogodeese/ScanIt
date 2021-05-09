<?php
	session_start();

	unset($_SESSION['singup_error']);
	unset($_SESSION['login_error']);	
		
	require_once("include/db_conn.php");
	
	#Register
	if (isset($_POST['register'])) 
		{	
			unset($_POST['register']);
			$_SESSION['singup_error'] = 0;
			
			#Recive the inputs
			$user  = mysqli_real_escape_string($db, $_POST["user"]);
			$email = mysqli_real_escape_string($db, $_POST["email"]);
			$pass1 = mysqli_real_escape_string($db, $_POST["pass1"]);
			$pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
			
			#Verify the inputs
			if(empty($user))     { $_SESSION['singup_error'] += 1; }
			if(empty($email))    { $_SESSION['singup_error'] += 1; }
			if(empty($pass1))    { $_SESSION['singup_error'] += 1; }
			if(empty($pass2))    { $_SESSION['singup_error'] += 1; }
			if($pass1 != $pass2) { $_SESSION['singup_error'] += 1; }
			
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
					
					echo shell_exec("mailsender/mailsender.py code.php".$_SESSION['email']);
		
				}

		}

#Login
if (isset($_POST['login']))
	{
		unset($_POST['login']);
		$_SESSION['login_error'] = 0;

		#Recive the inputs
		$user = mysqli_real_escape_string($db, $_POST['username']);
		$pass = mysqli_real_escape_string($db, $_POST['password']);

		#Verifys if it's empty
		if (empty($user)) { $_SESSION['login_error'] += 1; }
		if (empty($pass)) { $_SESSION['login_error'] += 1; }

		#If there is no erros the changes in the db will be made
		if ($_SESSION['login_error'] == 0)
			{
				#Password encryptation for security
				$password = md5($pass);
				$query = "SELECT * FROM users WHERE username like '$user' AND password like '$password'";
				$results = mysqli_query($db, $query);

				#If there are an account 
				if (mysqli_num_rows($results) > 0 )
					{
						#Saves the user and the mail in the session
						$_SESSION['user']  = $user;
						$_SESSION['email'] = $email;
						header('location: password.php');
					}
				else
					{
						#goes back to the index
						$_SESSION['login_error'] += 1;
						header('location: index.php');
					}
			}
		else
			{
				header('location: index.php');
			}
	}
?>