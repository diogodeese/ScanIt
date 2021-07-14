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

    <center>

        <a href="home">Home</a>
        <a href="../include/logout.php">Logout</a>

        <?php echo "<br><br><br><br>".$_SESSION['username']."<br><br><br>"; ?>
    <center>

<?php

    $user = "SELECT id FROM users WHERE username = '$_SESSION[username]'";
    $result = $db->query($user);
    $user = $result->fetch_assoc();
    echo $user['id'];

    $sql = "SELECT id, name, date_upload FROM files WHERE id_users = $user[id] AND active = 0";
    $result = $db->query($sql);

    $filePath = 'uploads/';

    if ($result->num_rows > 0) {

        echo "<table border='1px'>
            <tr>
                <th> ID </th>
                <th> Imagem </th>
                <th> Data </th>
				<th> Recuperar Arquivos </th>
                <th> Apagar </th>
            </tr>"; 
                    
        while($row = $result->fetch_assoc()) {	
            echo "<tr>
					<td> ".$row["id"]."  </td>
					<td> <img src=".$filePath.$_SESSION['username']."/".$row['name']." style='height: 250px; width: 250px; object-fit: cover; object-position: center center;'> </td>
					<td> ".$row["date_upload"]." </td>
					<td> <a href=include/options.php?options=recover&id=".$row['id']."><button> Recuperar </button></a> </td>
                    <td> <a href=include/options.php?options=delete&id={$row['id']}&name={$row['name']}><button> Remover </button></a>
                 </tr>
            ";
        }
    } else {
        echo "sem items";
    }
    
?>