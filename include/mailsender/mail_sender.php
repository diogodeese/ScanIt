



<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'phpmailer/vendor/autoload.php';

    //Database Connection
    require '../db_conn.php'; 

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
            $mail->Body    = "
            <!DOCTYPE html>
            <html>
                <head>
                <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
                    
            <!-- ================================== CSS ===================================== -->
            <style>
                            *{
                                margin: 0px; 
                                padding: 0px; 
                                box-sizing: border-box;
                            }
                
                            .container-login {
                                width: 100%;  
                                min-height: 100vh;
                                display: -webkit-box;
                                display: -webkit-flex;
                                display: -moz-box;
                                display: -ms-flexbox;
                                display: flex;
                                flex-wrap: wrap;
                                justify-content: center;
                                align-items: center;
                                padding: 15px;
                                background-repeat: no-repeat;
                                background-size: cover;
                                background-position: center;
                                position: relative;
                                z-index: 1;
                            }
                
                            .container-login::before {
                                content: '';
                                display: block;
                                position: absolute;
                                z-index: -1;
                                width: 100%;
                                height: 100%;
                                top: 0;
                                left: 0;
                                background: rgba(93,84,240,0.5);
                                background: -webkit-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
                                background: -o-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
                                background: -moz-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
                                background: linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
                                pointer-events: none;
                            }
                
                            .wrap-login {
                                width: 500px;
                                background: #fff;
                                border-radius: 10px;
                                overflow: hidden;
                
                                box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
                                -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
                                -webkit-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
                                -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
                                -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
                            }
                
                            .wrap-input {
                            width: 100%;
                            position: relative;
                            background-color: #fff;
                            border-radius: 20px;
                            }
                
                            .login-form{
                                width: 100%;
                            }
                
                            .login-form-title {
                                display: block;
                                font-family: SourceSansPro-Bold;
                                font-size: 30px;
                                color: #4b2354;
                                line-height: 1.2;
                                text-align: center;
                            }
                
                            .validate-input {
                                position: relative;
                            }
                
                            .container-login-form-btn{
                                width: 100%;
                                display: -webkit-box;
                                display: -webkit-flex;
                                display: -moz-box;
                                display: -ms-flexbox;
                                display: flex;
                                flex-wrap: wrap;
                                justify-content: center;
                            }
                
                            .p-l-55{
                                padding-left: 55px;
                            }
                            .p-r-55{
                                padding-right: 55px;
                            }
                            .p-t-80{
                                padding-top: 80px;
                            }

                            .p-b-37{
                                padding-bottom: 37px;
                            }

                            .ExternalClass {width: 100%;}


		</style>
            <!-- ============================================================================ -->
                </head>

                <body>
                
                <!-- =============================== IMAGE =============================== -->
                <div class='container-login' style='background-image: url(https://media.wired.com/photos/596d0a45e72d0f3ddf5e2f78/master/w_2560%2Cc_limit/QRC-Code-147522495.jpg%27);%22%3E;'>
                <!-- ===================================================================== -->
            

                        <div class='wrap-login p-l-55 p-r-55 p-t-80 p-b-30'>
                           
                            
                                <span class='login-form-title p-b-37'>
            
                                    Your code is:".$code."<br>
                                    <!-- ======== EDITABLE AREA ======== -->
                                    
                                    <!-- =============================== -->
            
                                </span>
             
                            
                        </div>
                        
                    </div>	
            
                </body>
            </html>"
            
            .$username." ".$email   ;


            $mail->send();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    

    $email_type = $_GET['type'];

    switch($email_type) {
        case 'forgot_pass':
            password_recover($email, $username, $db);
            break;

        default:
            break;
    }



?>