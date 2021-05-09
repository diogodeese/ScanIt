<?php
	session_start();

	unset($_SESSION['singup_error']);
	unset($_SESSION['login_error']);
	unset($_SESSION['mail_error']);
		
	require_once("db_conn.php");
	
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
			
			#Username and email check
			$user_check = "SELECT * FROM users WHERE username='$user' OR email='$email' LIMIT 1";
			$result     = mysqli_query($db, $user_check);
			$username   = mysqli_fetch_assoc($result);

			#If Username or email exists
			if ($username) 
				{ 
					if($username['username'] === $user) $_SESSION['singup_error'] += 1;
					if($username['email'] === $email)   $_SESSION['singup_error'] += 1;
				}

			if($_SESSION['singup_error'] > 0)
				{
					header('location: ../singup.php');
				}
			#Verifies the singup_error
			if ($_SESSION['singup_error'] == 0) 
				{
					unset($_SESSION['singup_error']);

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
					
					header('Location: ../index.php');#CHANGE TO HOME.PHP
		
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
						unset($_SESSION['login_error']);

						#Saves the user and the mail in the session
						$_SESSION['user']  = $user;
						header('location: ../password.php');#CHANGE TO HOME.PHP
					}
				else
					{
						#Goes back to the index
						$_SESSION['login_error'] += 1;
						header('location: ../index.php');
					}
			}
		else
			{
				$_SESSION['login_error'] += 1;
				header('location: ../index.php');
			}
	}

#Mail
if (isset($_POST['mail']))
	{
		unset($_POST['mail']);
		$_SESSION['mail_error'] = 0;

		#Receive the input
		$mail = mysqli_real_escape_string($db, $_POST['email']);

		#Verifys if it's empty
		if (empty($mail)) { $_SESSION['mail_error'] += 1; }

		#If there is no erros the changes in the db will be made
		if ($_SESSION['mail_error'] == 0)
			{
				$query = "SELECT * FROM users WHERE email like '$mail' ";
				$results = mysqli_query($db, $query);

				#If there are an account 
				if (mysqli_num_rows($results) > 0 )
					{
						unset($_SESSION['mail_error']);
						echo shell_exec("mailsender.py pass.php " .$mail);
					}
				else
					{
						#Goes back to the mail.php
						$_SESSION['mail_error'] += 1;
						header('location: ../mail.php');
					}	
			}
		else
			{
				#Goes back to the mail.php
				$_SESSION['mail_error'] += 1;
				header('location: ../mail.php');
			}
	}

	#asking_4_mail.php
	if(isset($_POST['insert_email_forgot_password'])) {
		$email = $_POST['email'];

		if(!empty($email)) {
			if(strpos($email, '@')) {
				$email_check = "SELECT username, email FROM users WHERE email LIKE '$email' LIMIT 1";
				$results = mysqli_query($db, $email_check);

				if(mysqli_num_rows($results) > 0 ) {
					$row = mysqli_fetch_row($results);
					$code = rand(1000, 9999);
					$sql = "UPDATE users SET password_code = '$code' WHERE email LIKE '$email'";
					$results = mysqli_query($db, $sql);
					header('Location: mailsender/mail_sender.php?email='.$email.'&&nome='.$row[0].'&&type=forgot_pass');
				} else {
					#Goes back to the asking_4_mail.php
					$_SESSION['mail_error'] += 1;
					header('location: ../asking_4_mail.php');
				}

			} else {
				#Goes back to the asking_4_mail.php
				$_SESSION['mail_error'] += 1;
				header('location: ../asking_4_mail.php');
			}

		} else {
			#Goes back to the asking_4_mail.php
			$_SESSION['mail_error'] += 1;
			header('location: ../asking_4_mail.php');
		}
	}


	#asking_4_code.php
	if(isset($_POST['insert_code_forgot_password'])) {
		$code = $_POST['code'];
		$email = $_GET['email'];

		if(!empty($code)) {
			if(is_numeric($code)) {
				$code_check = "SELECT password_code FROM users WHERE email LIKE '$email' LIMIT 1";
				$results = mysqli_query($db, $code_check);

				if(mysqli_num_rows($results) > 0 ) {
					echo "És bueda fixe";
					//header('Location: mailsender/mail_sender.php?email='.$email.'&&nome='.$row[0].'&&type=forgot_pass');
				} else {
					#Goes back to the asking_4_mail.php
					$_SESSION['mail_error'] += 1;
					header('location: ../index.php');
				}

			} else {
				#Goes back to the asking_4_mail.php
				$_SESSION['mail_error'] += 1;
				header('location: ../asking_4_code.php');
			}

		} else {
			#Goes back to the asking_4_mail.php
			$_SESSION['mail_error'] += 1;
			header('location: ../asking_4_code.php');
		}
	}

	






?>