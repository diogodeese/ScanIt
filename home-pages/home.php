<?php

    session_start();
    if(empty($_SESSION['username'])) { header('../index'); }
    require('../include/database-connection.php');

?>

    <center>
        <h1> Files </h1>
        <form action="home.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit" name="submit"> Upload Your File </button>
        </form>	

        <a href="trash">Lixo</a>
        <a href="../include/logout.php">Logout</a>

        <?php echo "<br><br><br><br>".$_SESSION['username']."<br><br><br>"; ?>
    <center>

<?php

    require('include/file-creation.php');

    $sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1px'>
            <tr>
                <th> ID </th>
                <th> Imagem </th>
                <th> Data </th>
                <th> Apagar </th>
            </tr>"; 
    
        while($row = $result->fetch_assoc()) {	        
            echo "<tr>
                    <td> ".$row["id"]."  </td>
                    <td> <a href='home.php?page=".$row['unic_link']."'><img src=".$filePath.$row['name']." width='500' height='400'></a></td>
                    <td> ".$row["date_upload"]." </td>
                    <td> <a href=include/options.php?options=remove&id=".$row['id']."><button> Apagar </button></a> </td>
                </tr>";
        }
    } else {
        echo "Sem items";
    }
    
?>