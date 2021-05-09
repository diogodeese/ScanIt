<?php
    if(isset($_SESSION['singup_error']))
        {
            echo "There is some errors";
        }
	
	if(isset($_SESSION['login_error']))
        {
            echo "There is some errors";
        }
    if(isset($_SESSION['mail_error']))
        {
            echo "Email doesn't exist";
        }
?>