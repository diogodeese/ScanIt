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
						<a class="m-b-10 m-t-10 active" href="TRASH.php">Trash</a>
						<hr style="width:70%;float:right">
						<a class="m-b-10 m-t-10" href="ScanIt.php">ScanIt</a>
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
								
						<div class="chkBox-sort m-l-105"><!-- CHECK BOX AND SORT BY -->
						
							<label class="chkBox_container">

								<input id="select-all" type="checkbox">
								<span class="checkmark"></span>

							</label>
								
							<select class="ddr_search" name="ddr_checkBox" id="cars">

















								<optgroup class="ddr_search-text" label="Sort by">

									<option value="">Date</option>
									<option value="">Weight</option>
									<option value="">Type</option>

								</optgroup>

							</select>

						</div><!-- CHECK BOX AND SORT BY -->

                        <span class="header-text" style="left: 40% !important">
                            Trash
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
							
							<span class="gear" onClick="settings()">
								<i class="fas fa-cog fa-2x gear"></i>
								<i class="fas fa-chevron-down gear m-t-7 p-l-5"></i>
							</span>

						</div><!-- ACCOUNT SETTINGS -->

					</div><!-- HEADER ACCOUNT INFO -->
							
				</div><!-- CONTAINER HEADER -->

				<div class="dynamic-container"><!-- DYNAMIC CONTAINER -->

					<div class="table-container m-t-20 m-r-20 m-l-20"><!-- TABLE CONTAINER -->

                        <?php
                            $user = "SELECT id FROM users WHERE username = '$_SESSION[username]'";
                            $result = $db->query($user);
                            $user = $result->fetch_assoc();
                            
                            function formatBytes($size, $precision = 2) {
                                $base = log($size, 1024);
                                $suffixes = array('', 'K', 'M', 'G', 'T');   

                                return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
                            }

                            $sql = "SELECT id, name, date_upload FROM files WHERE id_users = $user[id] AND active = 0";
                            $result = $db->query($sql);

                            $filePath = 'uploads/'.$_SESSION['username'].'/';

                            if ($result->num_rows > 0) {

                                echo "<table border='table-content'>
                                    <tr>
                                        <th> Select </th>
                                        <th> Imagem </th>
                                        <th> File Name </th>
                                        <th> Data </th>
                                        <th> Size </th>
                                        <th> Recover </th>
                                        <th> Remove </th>
                                    </tr>"; 

                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            
                                            <td id='select'>

                                                <label class='chkBox_container-table'>

                                                    <input id='' type='checkbox' name='checkbox[]' value='".$row['id']."'>

                                                    <span class='checkmark-table'></span>
                
                                                </label>

                                            </td>
                                            
                                            <td  class='image'> <img src=".$filePath.$row['name']." style='height: 250px; width: 250px; object-fit: cover; object-position: center center;'> </td>
                                            
                                            <td id='name'> ".$row['name']." </td>
                                            
                                            <td id='date'> ".$row["date_upload"]." </td>
                                            
                                            <td id='size'> ".formatBytes(filesize($filePath.$row['name']))." </td>
                                            
                                            <td> <a href=include/options.php?options=recover&id=".$row['id']."><button> Recover </button></a> </td>
                                            
                                            <td> <a href=include/options.php?options=delete&id={$row['id']}&name={$row['name']}><button> Remove </button></a>
                                        
                                        </tr>
                                        ";
                                }
                            } else {
                                echo "sem items";
                            }

                        ?>

                        </table>

                    </div><!-- TABLE CONTAINER -->

                </div><!-- DYNAMIC CONTAINER -->

            </div><!-- CONTENT CONTAINER -->

        </div><!-- PAGE - CONTEINER -->

    </body>

    <script>
        function settings() {
			var box = document.getElementById('settings-box');
            if (box.style.display === "none") box.style.display = "block";
            else box.style.display = "none";
        }
    </script>

</html>