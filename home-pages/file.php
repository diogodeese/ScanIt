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

	<?php

    session_start();
    if(empty($_SESSION['username'])) { header('../index'); }
    require('../include/database-connection.php');

	?>

	<body>
	 
		<div class="page-container" style="background-image: url('../images/main-wallpaper.jpg');" ><!-- PAGE - CONTEINER -->

			<div class="menu-container" ><!--RIGHT NAV-->

				<div class="menu-text p-r-30 p-l-30 p-t-50"><!-- MENU TEXT-->

					<img src="../images/logo.png" width="auto" height="54px">

				</div><!-- MENU TEXT-->

				<div class="menu-bar p-t-60" ><!-- MENU BAR -->

					<div class="menu-bar-a p-r-20"><!-- MENU BAR A --><!-- TRAOCAR HTML POR PHP!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

						<a class="m-b-10" href="HOME.php">Home</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="Trash.php">Trash</a>
						<hr style="width:70%;float:right">
						<a class="m-t-10 m-t-10" href="About.php">About</a>
						<hr style="width:70%;float:right">
						<a class="m-t-5 red-txt" href="#exit">Log Out</a>

					</div><!-- MENU BAR A -->

				</div><!-- MENU BAR -->

			</div><!--RIGHT NAV-->

			<div class="content-container"><!-- CONTENT CONTAINER -->
				
				<div class="container-header"><!-- CONTAINER HEADER -->

					<div class="header-features"><!-- HEADER FEATURES -->   

                        <span class="header-text">
                            ScanIt
                        </span>

					</div><!-- HEADER FEATURES -->

					<div class="header-account-info"><!-- HEADER ACCOUNT INFO -->

						<div class="account-name"><!-- ACCOUNT NAME -->

							<i class="fas fa-user fa-lg m-r-10"></i>

							<span>
								<?php
								echo $_SESSION['username'];
								?>
							</span>

						</div><!-- ACCOUNT NAME -->

						<div class="account-settings gear m-r-120"><!-- ACCOUNT SETTINGS --> 

							<span class="gear" onClick="settings()">
								<i class="fas fa-cog fa-2x gear"></i>
								<i class="fas fa-chevron-down gear m-t-7 p-l-5"></i>
							</span>

						</div><!-- ACCOUNT SETTINGS -->

						<div class="settings-box" id="settings-box" style="display: none;"><!-- SETTINGS BOX -->

							<div class="change-box trigger">
								<a href="../utility-pages/change-name/change-name?user=<?php echo $_SESSION['username']; ?>" class="trigger">
									Change Name
								</a>
							</div>

							<div class="change-box trigger">
								<a href="../utility-pages/change-password/change-password?user=<?php echo $_SESSION['username']; ?>" class="trigger">
									Change Password
								</a>
							</div>

						</div><!-- SETTINGS BOX -->

					</div><!-- HEADER ACCOUNT INFO -->
							
				</div><!-- CONTAINER HEADER -->

				<div class="dynamic-container"><!-- DYNAMIC CONTAINER -->

                    <?php

						require('include/file-creation.php');

						function formatBytes($size, $precision = 2) {
							$base = log($size, 1024);
							$suffixes = array('', 'K', 'M', 'G', 'T');   

							return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
						}

						$sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1 AND unic_link = '$_GET[page]'";
						$result = $db->query($sql);

						if ($result->num_rows > 0) {
							echo "<table class='table-content' style='width: 90%; margin-left: 5%;'>
								<tr>
                                    <th> File Name </th>
                                    <th> Date </th>
                                    <th> Size </th>
                                    <th> Download </th>
                                    <th> Go Back </th>
                                </tr>
							"; 

							$arrayCounter = 0;
							while($row = $result->fetch_assoc()) {	

                                if($arrayCounter < 1)
									{
										echo "
											<div class='qr-image-container'>
												
												<div class='image-qrPage'> <img src=".$filePath.$row['name']."></div>

												<div id='qrcode' class='qr-qrPage'></div>

											</div>
										";
									}
								
								$unic_link = $row['unic_link'];
								$_SESSION['fileName'] = $row['name'];

								echo "<tr class='table-content-rows'>
   
                                    <td id='name'> ".$row['name']." </td>
                                    
                                    <td id='date'> ".$row["date_upload"]." </td>
                                    
                                    <td id='size'>".formatBytes(filesize($filePath.$row['name']))."</td>

                                    <td> <a href='$filePath$row[name]' style='text-decoration: none;' download>Download <i class='fas fa-download'></i></a> </td>

                                    <td> <a href='home' style='text-decoration: none;'> Go To Menu <i class='fas fa-external-link-alt'></i></td>
                                
                                </tr>
								";

								$arrayCounter++;

							}
						} else {
							echo "Sem items";
						}
					
						$host= gethostname();
						$ip = gethostbyname($host);

						$qrCodeUrl = "http://".$ip."/ScanIt/home-pages/download.php?path=".$filePath.$_SESSION['fileName'];
						$qrCodeMainUrl = "http://".$ip."/ScanIt/home-pages/download.php?path=".$filePath.$_SESSION['fileName'];
					?>

				</div><!-- DYNAMIC CONTAINER -->
				
			</div><!-- CONTENT CONTAINER -->

		</div><!-- PAGE - CONTEINER -->
		
		<div id="qrcode"></div>

		<script src="../js/qrcode.min.js"></script>
		<script>
			window.onload = function generateQR() {
				urlValue = window.location.assign = "<?php echo $qrCodeUrl; ?>";
				var qrCode = new QRCode(document.getElementById('qrcode'));
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