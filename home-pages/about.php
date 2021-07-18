<!DOCTYPE html>
<html lang="pt">
	<head>
		<title> ScanIt </title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
<!-- ======================= CSS ======================== -->
		<link rel="stylesheet" href="../css/page.css">		
		<link rel="stylesheet" href="../css/util.css">		
		<link rel="stylesheet" href="../css/table.css">
		<link rel="stylesheet" href="../include/fontawesome/css/all.css">
<!-- ==================================================== -->

</head>

	<?php session_start(); ?>

	<body>
	 
		<div class="page-container" style="background-image: url('../images/main-wallpaper.jpg');" ><!-- PAGE - CONTEINER -->

			<div class="menu-container" ><!--RIGHT NAV-->

				<div class="menu-text p-r-30 p-l-30 p-t-50"><!-- MENU TEXT-->

					<div id="qrcode" style="width: fit-content; margin: auto;" class="p-b-15"></div><img src="../images/logo.png" width="auto" height="54px">

				</div><!-- MENU TEXT-->

				<div class="menu-bar p-t-60" ><!-- MENU BAR -->

					<div class="menu-bar-a p-r-20"><!-- MENU BAR A --><!-- TRAOCAR HTML POR PHP!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

						<a class="m-b-10" href="home">Home</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="trash">Trash</a>
						<hr style="width:70%;float:right">
						<a class="m-t-10 m-t-10 active" href="about">About</a>
						<hr style="width:70%;float:right">
						<a class="m-t-5 red-txt" href="../include/logout">Log Out</a>

					</div><!-- MENU BAR A -->

				</div><!-- MENU BAR -->

			</div><!--RIGHT NAV-->

			<div class="content-container"><!-- CONTENT CONTAINER -->
				
				<div class="container-header"><!-- CONTAINER HEADER -->

					<div class="header-features"><!-- HEADER FEATURES -->   

                        <span class="header-text">
                            About
                        </span>

					</div><!-- HEADER FEATURES -->

					<div class="header-account-info"><!-- HEADER ACCOUNT INFO -->

						<div class="account-name"><!-- ACCOUNT NAME -->

							<i class="fas fa-user fa-lg m-r-10"></i>

							<span>
								<?php echo $_SESSION['username']; ?>
							</span>

						</div><!-- ACCOUNT NAME -->

						<div class="account-settings gear m-r-120"><!-- ACCOUNT SETTINGS --> 

							<span class="gear" onClick="settings()">
								<i class="fas fa-cog fa-2x gear"></i>
								<i class="fas fa-chevron-down gear m-t-7 p-l-5"></i>
							</span>

						</div><!-- ACCOUNT SETTINGS -->

					</div><!-- HEADER ACCOUNT INFO -->
							
				</div><!-- CONTAINER HEADER -->

				<div class="dynamic-container"><!-- DYNAMIC CONTAINER -->

                    <div class="about-text-container m-t-50 m-r-50 m-l-50">

                        <p class="about-title">
                            What's ScanIt?
                        </p>
                        <br>
                        <p class="about-text">
                            It's a web site that stores your files online, it works like a cloud, you upload the files to the 
                            server and with the access of the account that the files where stored you can easily download them 
                            on your phone or computer, there's an easier way to transfer files to the phone, just use the QR 
                            code of the file you want to donwload to your selfphone and there it is. :)    
                        </p>


                        <p class="about-title m-t-35">
                            Who are we?
                        </p>
                        <br>
                        <p class="about-text">
                            We are students of Programming (Gestão e Programação de Sistemas Informáticos) 
                            of the Escola Secundária da Amadora. There's three of us: Alexandre Gomes, Diogo Santos and Vítor Batista,
                            all of us have ages between 17 and 18.  
                        </p>

                        <p class="about-title m-t-35">
                            What's this project for?
                        </p>
                        <br>
                        <p class="about-text">
                            Well this is our final project (PAP), we hope you find it cool and usefull. 
                        </p>

                           

                    </div>

				</div><!-- DYNAMIC CONTAINER -->
				
			</div><!-- CONTENT CONTAINER -->

		</div><!-- PAGE - CONTEINER -->
		

		<?php
			
			$host= gethostname();
			$ip = gethostbyname($host);

			$qrCodeUrl = "http://".$ip."/ScanIt/index";					

		?>

		<!-- JAVA SCRIPT -->
		<script src="../js/qrcode.min.js"></script>
		<script>
			window.onload = function generateQR() {
				urlValue = window.location.assign = "<?php echo $qrCodeUrl; ?>";
				var qrCode = new QRCode(document.getElementById('qrcode'), { width: 125, height: 125 });
				qrCode.makeCode(urlValue);
			}

			function settings() {
				var box = document.getElementById('settings-box');
                if (box.style.display === "none") box.style.display = "block";
                else box.style.display = "none";
            }
		</script>
		
	</body>
</html>