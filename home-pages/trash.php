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
					<td> <img src=".$filePath.$row['name']." width='500' height='400'> </td>
					<td> ".$row["date_upload"]." </td>
					<td> <a href=include/options.php?options=recover&id=".$row['id']."><button> Recuperar </button></a> </td>
                    <td> <a href=include/options.php?options=delete&id={$row['id']}&name={$row['name']}><button> Remover </button></a>
                 </tr>";
        }
    } else {
        echo "sem items";
    }
    
?>