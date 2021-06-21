<?php

    session_start();
    if(empty($_SESSION['username'])) { header('../index'); }
    require('../include/database-connection.php');

?>

    <center>
        <a href="trash">Lixo</a>
        <a href="../include/logout.php">Logout</a>

        <?php echo "<br><br><br><br>".$_SESSION['username']."<br><br><br>"; ?>
    <center>

<?php

    require('include/file-creation.php');

    $sql = "SELECT id, name, date_upload, unic_link FROM files WHERE id_users = $user[id] AND active = 1 AND unic_link = '$_GET[page]'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1px'>
            <tr>
                <th> ID </th>
                <th> Imagem </th>
                <th> Data </th>
                <th> Apagar </th>
            </tr>
        "; 

        $arrayCounter = 0;
        while($row = $result->fetch_assoc()) {	
            
            $unic_link = $row['unic_link'];

            echo "<tr>
                    <td> ".$row["id"]."  </td>
                    <td> <a href=home.php?page=".$row['unic_link']." onclick='generateQR($arrayCounter)'><img src=".$filePath.$row['name']." width='500' height='400'></a></td>
                    <td> ".$row["date_upload"]." </td>
                    <td> <a href=include/options.php?options=remove&id=".$row['id']."><button> Apagar </button></a> </td>
                </tr>
            ";

            $arrayCounter++;
        }
    } else {
        echo "Sem items";
    }
    
?>

    <button onclick="generateQR()">dasd</button>
    <div id="qrcode"></div>

<script src="../js/qrcode.min.js"></script>
<script>

    window.onload = function generateQR() {
        urlValue = 'file.php?page=<?php echo $unic_link ?>'
        var qrCode = new QRCode(document.getElementById('qrcode'));
        qrCode.makeCode(urlValue);
    }

</script>