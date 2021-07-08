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

    function formatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    $sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1px'>
            <tr>
                <th> ID </th>
                <th> Imagem </th>
                <th> Nome </th>
                <th> Data </th>
                <th> Apagar </th>
                <th> Link </th>
                <th> Size </th>
            </tr>
        "; 

        $arrayCounter = 0;
        while($row = $result->fetch_assoc()) {	
            
            $urlValue[$arrayCounter] = 'file.php?page='.$row['unic_link'];

            echo "<tr>
                    <td> ".$row["id"]."  </td>
                    <td> <a href=file.php?page=".$row['unic_link']."&id=".$arrayCounter." onclick='generateQR($arrayCounter)'><img src=".$filePath.$row['name']." style='height: 100px; width: 100px; object-fit: cover; object-position: center center;'></a></td>
                    <td> ".$row['name']." </td>
                    <td> ".$row["date_upload"]." </td>
                    <td> <a href=include/options.php?options=remove&id=".$row['id']."><button> Apagar </button></a> </td>
                    <td><p>".$urlValue[$arrayCounter]."</p></td>
                    <td><p>".formatBytes(filesize($filePath.$row['name']))."</p></td>
                </tr>
            ";

            $arrayCounter++;
        }
    } else {
        echo "Sem items";
    }
    
?>