<?php

    ob_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'phpmailer/vendor/autoload.php';

    //Database Connection
    require '../database-connection.php'; 

    $email = $_GET['email'];
    $username = $_GET['nome'];
    

    function password_recover($email, $username, $db) {

        $sql = "SELECT password_code FROM users WHERE email LIKE '$email' LIMIT 1";
        $results = mysqli_query($db, $sql);
        $row = mysqli_fetch_row($results);
        $code = $row[0];

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                           //Enable verbose debug output
            $mail->isSMTP();                                                //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
            $mail->Username   = 'scanitbot@gmail.com';                   //SMTP username
            $mail->Password   = '101101111';                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('scanitbot@gmail.com', 'ScanIt');
            $mail->addAddress($email, $username); //Add a recipient

            //Content
            $mail->isHTML(true);                                      //Set email format to HTML
            $mail->Subject = 'ScanIt';
            $mail->Body    = "<!DOCTYPE html>
            <html>
                <head>
                    <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
                    
                    <!-- ================================== CSS ===================================== -->
                    <style>

                        .body {
                            margin: 0;
                            padding: 0;
                            background-color: #add8e6;
                        }

                        .table {
                            border-spacing: 0;
                        }
        
                        .td {
                            padding: 0;
                        }

                        .img {
                            border: 0;
                        }
        
                        .outer {
                            margin: 0 auto;
                            width: 100%;
                            max-width: 600px;
                            border-spacing: 0;
                            font-family: sans-serif;
                            color: #4a4a4a;
                        }
        
                        .three-columns {
                            text-align: center;
                            font-size: 0;
                            padding-top: 40px;
                            padding-bottom: 30px;
                        }
        
                        .three-columns .column {
                            width: 100%;
                            max-width: 200px;
                            display: inline-block;
                            vertical-align: top;
                        }
        
                        .padding {
                            padding: 15px;
                        }
        
                        .three-columns .content {
                            font-size: 15px;
                            line-height: 20px;
                        }
        
                        .a {
                            text-decoration: none;
                            color: #388CDA;
                            font-size: 16px;
                        }
        
                        @media screen and (max-width: 600px) {
        
                        }
        
                        @media screen and (max-width: 400 px) {
        
                        }
        
		            </style>
                    <!-- ============================================================================ -->
                </head>

                <body>
                    <center style='width: 100%; table-layout: fixed; background-color: #add8e6; padding-bottom: 20px; padding-top: 20px;'>
                        <div style='max-width: 600px; background-color: #ffffff;'>
                            <table class='outer' align='center'>
                                <tr>
                                    <td>
                                        <table width='100%' style='border-spacing: 0;'>
                                            <tr>
                                                <td style='padding: 10px; text-align: center; width: 100%'>
                                                    <h1 style='color: #2a2a2a;'>Scan It</h1> 
                                                </td>
                                            </tr>
                                        </table>
    
                                        <table width='100%' style='border-spacing: 0;'>
                                            <tr>
                                                <table class='column'>
                                                    <tr>
                                                        <td class='padding'>
                                                            <table class='content'>
                                                                <tr>
                                                                    <td style='padding: 10px;'>
                                                                        <p style='font-size: 16px; color: #4a4a4a;'>Hello ".$username." someone is trying to change your password, if it was you:<br><br></p>
                                                                        <p style='font-size: 17px; text-align:center; font-weight: bold; color: #4a4a4a;'>Your code is: ".$code."<br></p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                </body>
            </html>";

            $mail->send();
            

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
       
    }

    function account_creation($email, $username, $db) {

        $sql = "SELECT activation_code FROM users WHERE email LIKE '$email' LIMIT 1";
        $results = mysqli_query($db, $sql);
        $row = mysqli_fetch_row($results);
        $code = $row[0];

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                           //Enable verbose debug output
            $mail->isSMTP();                                                //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
            $mail->Username   = 'scanitbot@gmail.com';                   //SMTP username
            $mail->Password   = '101101111';                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('scanitbot@gmail.com', 'ScanIt');
            $mail->addAddress($email, $username); //Add a recipient

            //Content
            $mail->isHTML(true);                                      //Set email format to HTML
            $mail->Subject = 'ScanIt';
            $mail->Body    = "<!DOCTYPE html>
            <html>
                <head>
                    <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
                    
                    <!-- ================================== CSS ===================================== -->
                    <style>

                        .body {
                            margin: 0;
                            padding: 0;
                            background-color: #add8e6;
                        }

                        .table {
                            border-spacing: 0;
                        }
        
                        .td {
                            padding: 0;
                        }

                        .img {
                            border: 0;
                        }
        
                        .outer {
                            margin: 0 auto;
                            width: 100%;
                            max-width: 600px;
                            border-spacing: 0;
                            font-family: sans-serif;
                            color: #4a4a4a;
                        }
        
                        .three-columns {
                            text-align: center;
                            font-size: 0;
                            padding-top: 40px;
                            padding-bottom: 30px;
                        }
        
                        .three-columns .column {
                            width: 100%;
                            max-width: 200px;
                            display: inline-block;
                            vertical-align: top;
                        }
        
                        .padding {
                            padding: 15px;
                        }
        
                        .three-columns .content {
                            font-size: 15px;
                            line-height: 20px;
                        }
        
                        .a {
                            text-decoration: none;
                            color: #388CDA;
                            font-size: 16px;
                        }
        
                        @media screen and (max-width: 600px) {
        
                        }
        
                        @media screen and (max-width: 400 px) {
        
                        }
        
		            </style>
                    <!-- ============================================================================ -->
                </head>

                <body>
                    <center style='width: 100%; table-layout: fixed; background-color: #add8e6; padding-bottom: 20px; padding-top: 20px;'>
                        <div style='max-width: 600px; background-color: #ffffff;'>
                            <table class='outer' align='center'>
                                <tr>
                                    <td>
                                        <table width='100%' style='border-spacing: 0;'>
                                            <tr>
                                                <td style='padding: 10px; text-align: center; width: 100%'>
                                                    <h1 style='color: #2a2a2a;'>Scan It</h1> 
                                                </td>
                                            </tr>
                                        </table>
    
                                        <table width='100%' style='border-spacing: 0;'>
                                            <tr>
                                                <table class='column'>
                                                    <tr>
                                                        <td class='padding'>
                                                            <table class='content'>
                                                                <tr>
                                                                    <td style='padding: 10px;'>
                                                                        <p style='font-size: 16px; color: #4a4a4a;'>Hello ".$username."!<br><br>
                                                                        Thanks for creating an account on ScanIt, we really apreciate your choice on using our platform.</p>
                                                                        <p style='font-size: 17px; text-align:center; font-weight: bold; color: #4a4a4a;'>Here is your code to confirm your account: ".$code."<br></p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                </body>
            </html>";

            $mail->send();
            
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    

    $email_type = $_GET['type'];

    switch($email_type) {
        case 'forgot_pass': 
            password_recover($email, $username, $db);
            header('location: ../../utility-pages/code-input.php?email='.$email.'&button=forgot_pass');
        break;

        case 'account_confirmation':
            account_creation($email, $username, $db);
            header('location: ../../utility-pages/code-input.php?email='.$email.'&button=email_confirmation');
        break;
    }

    
    ob_end_flush();
?>