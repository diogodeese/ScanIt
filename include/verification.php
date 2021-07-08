<?php

	session_start();		
	require("database-connection.php");

	#Register
	if (isset($_POST['register'])) 
		{	
			
			#Recive the inputs
			$user  = mysqli_real_escape_string($db, $_POST["user"]);
			$email = mysqli_real_escape_string($db, $_POST["email"]);
			$pass1 = mysqli_real_escape_string($db, $_POST["pass1"]);
			$pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
			
			if(!empty($user)) {
				if(!empty($email)) {
					if(!empty($pass1)) {
						if(!empty($pass2)) {
							if($pass1 === $pass2) {

								#Username and email check
								$user_check = "SELECT * FROM users WHERE username LIKE '$user' OR email LIKE '$email' LIMIT 1";
								$result = $db->query($user_check);

								#If Username or email exists
								if ($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									if($row['email'] === $email) header('Location: ../sign-up?error_type=email_exists');
									if($row['username'] === $user) header('Location: ../sign-up?error_type=user_exists');
									exit();
								}

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

								chdir("../home-pages/uploads/");
								$curdir = getcwd();
									
								mkdir($curdir."/".$_SESSION['user'], 0777);
								header('Location: ../index');

							} else {
								header('Location: ../sign-up?error_type=different_passwords');
							}
										
						} else {
							header('Location: ../sign-up?error_type=empty_pass2');
						}

					} else {
						header('Location: ../sign-up?error_type=empty_pass1');
					}
	
				} else {
					header('Location: ../sign-up?error_type=empty_email');
				}
	
			} else {
				header('Location: ../sign-up?error_type=empty_user');
			}



		}

	#Login
	if (isset($_POST['login'])) {
		#Recive the inputs
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$pass = mysqli_real_escape_string($db, $_POST['password']);

		if(!empty($username)) {
			if(!empty($pass)) {
				$sql_user = "SELECT * FROM users WHERE username LIKE '$username'";
				$results_user = mysqli_query($db, $sql_user);
				if (mysqli_num_rows($results_user) > 0 ) {
					$password = md5($pass); 
					$sql_pass = "SELECT * FROM users WHERE username LIKE '$username' AND password LIKE '$password'";
					$results_pass = mysqli_query($db, $sql_pass);
					if (mysqli_num_rows($results_pass) > 0 ) {

						$row = mysqli_fetch_row($results_pass);
						$_SESSION['username']  = $username;
						header('Location: ../home-pages/home');

					} else {
						header('Location: ../index?error_type=wrong_pass');
					}

				} else {
					header('Location: ../index?error_type=wrong_user');
				}

			} else {
				header('Location: ../index?error_type=empty_pass');
			}

		} else {
			header('Location: ../index?error_type=empty_user');
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
					header('Location: mailsender/email-sender.php?email='.$email.'&&nome='.$row[0].'&&type=forgot_pass');
				} else {
					#Goes back to the asking_4_mail.php
					$_SESSION['mail_error'] += 1;
					header('location: ../utility-pages/change-password/cp-email-input');
				}

			} else {
				#Goes back to the asking_4_mail.php
				$_SESSION['mail_error'] += 1;
				header('location: ../utility-pages/change-password/cp-email-input');
			}

		} else {
			#Goes back to the asking_4_mail.php
			$_SESSION['mail_error'] += 1;
			header('location: ../utility-pages/change-password/cp-email-input');
		}
	}


	#asking_4_code.php
	if(isset($_POST['insert_code_forgot_password'])) {
		$code = $_POST['code'];
		$email = $_POST['email'];

		if(!empty($code)) {
			$code_check = "SELECT password_code FROM users WHERE email LIKE '$email' LIMIT 1";
			$results = mysqli_query($db, $code_check);

			if(mysqli_num_rows($results) > 0 ) {
				header('Location: ../utility-pages/change-password/change-password?email='.$email.'&type=forgot_pass');
			} else {
				$_SESSION['mail_error'] += 1;
				header('location: ../utility-pages/code-input.php?email='.$email.'&button=forgot_pass');
			}

		} else {
			$_SESSION['mail_error'] += 1;
			header('location: ../utility-pages/code-input.php?email='.$email.'&button=forgot_pass');
		}
	}

	#change-password
	if(isset($_POST['change_password'])) {

		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$email = $_POST['email'];

		if(!empty($pass1)) {
			if(!empty($pass2)) {
				if($pass1 === $pass2) {

					$password = md5($pass1);

					$sql = "UPDATE users SET password = '$password' WHERE email LIKE '$email'";
					$results = mysqli_query($db, $sql);

					header('Location: ../index');

				} else {
					echo "diferentes";
				}
			} else {
				echo "pass2 vazia";
			}
		} else {
			echo "pass1 vazia";
		}
	}

?>