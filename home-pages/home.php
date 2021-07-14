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

<!-- ======================= JS ========================= -->
		<script src="https://kit.fontawesome.com/b088c4b25c.js" crossorigin="anonymous"></script>
<!-- ==================================================== -->
</head>

<?php

    ob_start();
    session_start();
    if(empty($_SESSION['username'])) { header('../index'); }
    require('../include/database-connection.php');

?>

    <body onclick="click()">
	 
		<div class="page-container" style="background-image: url('../images/main-wallpaper.jpg');" ><!-- PAGE - CONTEINER -->

			<div class="menu-container" ><!--RIGHT NAV-->

				<div class="menu-text p-r-30 p-l-30 p-t-50"><!-- MENU TEXT-->

					<img src="/mail_html/images/code.jpg" width="35px" height="35px">SCANIT		

				</div><!-- MENU TEXT-->

				<div class="menu-bar p-t-60" ><!-- MENU BAR -->

					<div class="menu-bar-a p-r-20"><!-- MENU BAR A --><!-- TRAOCAR HTML POR PHP!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

						<a class="m-b-10 active" href="home">Home</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="trash">Trash</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="ScanIt">ScanIt</a>
						<hr style="width:70%;float:right">
						<a class="m-t-10 m-t-10" href="About">About</a>
						<hr style="width:70%;float:right">
						<a class="m-t-5 red-txt" href="../include/logout">Log Out</a>

					</div><!-- MENU BAR A -->

				</div><!-- MENU BAR -->

			</div><!--RIGHT NAV-->

			<div class="content-container"><!-- CONTENT CONTAINER -->
				
				<div class="container-header"><!-- CONTAINER HEADER -->

					<div class="header-features"><!-- HEADER FEATURES --> 
								
						<div class="chkBox-sort m-l-105"><!-- CHECK BOX AND SORT BY -->
						
							<label class="chkBox_container">

								<input id="select-all" type="checkbox">
								<span class="checkmark"></span>

							</label>
								
							<select class="ddr_search" name="ddr_checkBox" id="ddr_checkBox"">

								<optgroup class="ddr_search-text" label="Sort by">

									<option value="">Date</option>
									<option value="">Weight</option>
									<option value="">Type</option>

								</optgroup>

							</select>

						</div><!-- CHECK BOX AND SORT BY -->

						<div class="m-l-120 m-r-10 upload-container"><!-- UPLOAD CONTAINER -->
								
							<form class="form_upload" action="" method="POST" enctype = "multipart/form-data">
									
								<input type="file" id="InputFile" name="file" onchange="selectFile();" hidden="hidden" />
								
								<button class="btn_chose-file" type="button" id="buttonStyle" onclick="FileUpload();">
									
									<i class="fas fa-upload fa-sm m-r-5"></i>
									Upload

								</button>
								
 								<input class="btn_send-file" type="submit" value="No File Chosen" id="submit" name="submit" disabled="true"/>

							</form>

						</div><!-- UPLOAD CONTAINER -->

						<div class="m-l-228 delete"><!-- DELETE -->
								
							<button class="btn_delete" type="button" id="btn_delete">
								
								<i class="fas fa-trash fa-lg m-r-5"></i>
								Delete Selected Files

							</button>
								
						</div><!-- DELETE -->

					</div><!-- HEADER FEATURES -->

					<div class="header-account-info"><!-- HEADER ACCOUNT INFO -->

						<div class="account-name"><!-- ACCOUNT NAME -->

							<i class="fas fa-user fa-lg m-r-10"></i>

							<span>
								<?php echo $_SESSION['username']; ?>
							</span>

						</div><!-- ACCOUNT NAME -->

					<input id="variable" style="display: none;"><!-- for js -->

						<div class="account-settings gear m-r-120"><!-- ACCOUNT SETTINGS --> 

							<span class="gear" onclick="settings()">
								<i class="fas fa-cog fa-2x gear"></i>
								<i class="fas fa-chevron-down gear m-t-7 p-l-5"></i>
							</span>

						</div><!-- ACCOUNT SETTINGS -->

						<div class="settings-box trigger" id="settings-box" style="display: none;"><!-- SETTINGS BOX -->

							<div class="change-box trigger">
								<a href="#" class="trigger">
									Change Name
								</a>
							</div>

							<div class="change-box trigger">
								<a href="#" class="trigger">
									Change Password
								</a>
							</div>

							<div class="change-box trigger">
								<a href="#" class="trigger">
									Change Email
								</a>
							</div>

						</div><!-- SETTINGS BOX -->

					</div><!-- HEADER ACCOUNT INFO -->
							
				</div><!-- CONTAINER HEADER -->

				<div class="dynamic-container"><!-- DYNAMIC CONTAINER -->

					<div class="table-container m-t-20 m-r-20 m-l-20"><!-- TABLE CONTAINER -->

                        <?php

                            require('include/file-creation.php');

                            function formatBytes($size, $precision = 2) {
                                $base = log($size, 1024);
                                $suffixes = array('', 'K', 'M', 'G', 'T');   

                                return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
                            }

                            $sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table-content'>
                                    <tr>
                                        <th> Select </th>
                                        <th> Image </th>
                                        <th> File Name </th>
                                        <th> Date </th>
                                        <th> Size </th>
                                        <th> QR Code </th>
                                    </tr>
                                "; 

                                $arrayCounter = 0;
                                while($row = $result->fetch_assoc()) {
                                
                                    $urlValue[$arrayCounter] = 'file.php?page='.$row['unic_link'];

                                    echo "<tr class='table-content-rows'>

                                            <td id='select'>
                                                <label class='chkBox_container-table'>

                                                    <input id='' type='checkbox'>
                                                    
                                                    <!-- PHP para meter o valor do id chk box com o do id do ficheiro ==================================== -->
                                                    
                                                    <span class='checkmark-table'></span>

                                                </label>
                                            </td>
                                            
                                            <td class='image'> <a href=file.php?page=".$row['unic_link']."&id=".$arrayCounter." onclick='generateQR($arrayCounter)'><img src=".$filePath.$row['name']."></a></td>
                                            
                                            <td id='name'> ".$row['name']." </td>
                                            
                                            <td id='date'> ".$row["date_upload"]." </td>
                                            
                                            <td id='size'>".formatBytes(filesize($filePath.$row['name']))."</td>

                                            <td id='qr'>
                                                <a href='#'>
                                                    <i class='fa-solid fa-scanner-touchscreen'> QR </i>
                                                </a>
                                            </td>
                                        
                                        </tr>
                                    ";

                                    $arrayCounter++;
                                }
                            } else {
                                echo "Sem items";
                            }

                        ?>

					</div><!-- TABLE CONTAINER -->

				</div><!-- DYNAMIC CONTAINER -->
				
			</div><!-- CONTENT CONTAINER -->

		</div><!-- PAGE - CONTEINER -->

    </body>

    	<!-- JAVA SCRIPT -->
		<script>
			function FileUpload()
			{
				document.getElementById('InputFile').click();	
			}
			
			function selectFile()
			{
				if (document.getElementById('InputFile').value) 
				{
					
					document.getElementById("submit").value = document.getElementById('InputFile').value.match(
						  /[\/\\]([\w\d\s\.\-\(\)]+)$/
						)[1];
					
					document.getElementById("submit").disabled = false;

				}
				else 
				{
					
					document.getElementById("submit").value = "No File Chosen";
					document.getElementById("submit").disabled = true;

				}
			}
        </script>

        <?php ob_end_flush(); ?>

</html>