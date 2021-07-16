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

					<img src="/mail_html/images/code.jpg" width="35px" height="35px">SCANIT

				</div><!-- MENU TEXT-->

				<div class="menu-bar p-t-60" ><!-- MENU BAR -->

					<div class="menu-bar-a p-r-20"><!-- MENU BAR A --><!-- TRAOCAR HTML POR PHP!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

						<a class="m-b-10" href="HOME.php">Home</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="Trash.php">Trash</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10 active" href="ScanIt.php">ScanIt</a>
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

						<div class="account-settings m-r-120"><!-- ACCOUNT SETTINGS --> 
							
							<span>
								<i class="fas fa-cog fa-2x "></i>
								<i class="fas fa-chevron-down m-t-7 p-l-5"></i>
							</span>

						</div><!-- ACCOUNT SETTINGS -->

					</div><!-- HEADER ACCOUNT INFO -->
							
				</div><!-- CONTAINER HEADER -->

				<div class="dynamic-container"><!-- DYNAMIC CONTAINER -->

                    <?php

						require('include/file-creation.php');

						$sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1 AND unic_link = '$_GET[page]'";
						$result = $db->query($sql);

						if ($result->num_rows > 0) {
							echo "<table border='1px'>
								<tr>
									<th> Imagem </th>
									<th> File Name </th>
									<th> Data </th>
									<th> Size </th>
								</tr>
							"; 

							$arrayCounter = 0;
							while($row = $result->fetch_assoc()) {	
								
								$unic_link = $row['unic_link'];
								$_SESSION['fileName'] = $row['name'];

								echo "<tr>
										
										<td class = 'image'> <a href=home.php?page=".$row['unic_link']." onclick='generateQR($arrayCounter)'><img src=".$filePath.$row['name']." width='500' height='400'></a></td>
										
										<td id = 'name'> ".$row['name']." </td>

										<td id = 'date'> ".$row["date_upload"]." </td>

										<td id = 'size'>  </td>
                                            
									</tr>
								";

								$arrayCounter++;
								
								echo "<a href='$filePath$row[name]' download>Download</a>";

							}
						} else {
							echo "Sem items";
						}
					
						$host= gethostname();
						$ip = gethostbyname($host);

						$qrCodeUrl = "http://".$ip."/pap-30-05/home-pages/download.php?path=".$filePath.$_SESSION['fileName'];

					?>

					<a href="home">
						Go Back
					</a>

				</div><!-- DYNAMIC CONTAINER -->
				
			</div><!-- CONTENT CONTAINER -->

		</div><!-- PAGE - CONTEINER -->
		
	</body>

</html>