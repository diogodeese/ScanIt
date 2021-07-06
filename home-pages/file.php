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
            $_SESSION['fileName'] = $row['name'];

            echo "<tr>
                    <td> ".$row["id"]."  </td>
                    <td> <a href=home.php?page=".$row['unic_link']." onclick='generateQR($arrayCounter)'><img src=".$filePath.$row['name']." width='500' height='400'></a></td>
                    <td> ".$row["date_upload"]." </td>
                    <td> <a href=include/options.php?options=remove&id=".$row['id']."><button> Apagar </button></a> </td>
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

    <div id="qrcode"></div>

<script src="../js/qrcode.min.js"></script>
<script>

    window.onload = function generateQR() {
        urlValue = window.location.assign = "<?php echo $qrCodeUrl; ?>";
        var qrCode = new QRCode(document.getElementById('qrcode'));
        qrCode.makeCode(urlValue);
    }

</script>