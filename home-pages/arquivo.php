<?php

    //Database Connection 
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "db";
	
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de ligação: " . $conn->connect_error);
    }

?>

    <center>

	<h1> Files </h1>
	<form action="arquivo.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="file" required>
		<button type="submit" name="submit"> Upload Your File </button>
	</form>	

<?php
	
    //File Upload
	$filePath = 'uploads/';

	if(isset($_FILES['file'])) {
	    $file = $_FILES['file'];

        //File Variables
		$fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        
        //File Extension
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        //Generating a Random String
        $unic_link = bin2hex(openssl_random_pseudo_bytes(50));

        //File Verification
        $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowedExt)) {
            if($fileError === 0) {
                if($fileSize < 1000000) {

                    $fileNewName = uniqid('', true).".".$fileActualExt;
                    $filePath = $filePath.$fileNewName;

                    move_uploaded_file($fileTmpName, $filePath);
                    header("Location: arquivo.php");

                } else echo "Your file is too big";
            } else echo "There was an error uploading your file";
        } else echo "This file extension is not allowed";

        //Uploading file information to Database
		$sql = "INSERT INTO files (name, date_upload, unic_link, active) values ('$fileNewName', NOW(), '$unic_link', 1)";
		
		if ($conn->query($sql) === TRUE) echo "O seu ficheiro foi guardado com sucesso";
		else echo "Erro: " . $sql . "<br>" . $conn->error;
	}

?>

    <center>

<?php

    $sql = "SELECT id, name, date_upload, unic_link FROM files WHERE active = 1";
    $result = $conn->query($sql);

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
                    <td> <a href='arquivo.php?page=".$row['unic_link']."'><img src=".$filePath.$row['name']." width='500' height='400'></a></td>
                    <td> ".$row["date_upload"]." </td>
                    <td> <a href=remove_items2.php?id=".$row['id']."><button> Apagar </button></a> </td>
                </tr>";
        }
    }  

    $sql = "SELECT id, name, date_upload FROM files WHERE active = 0";
    $result = $conn->query($sql);

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
					<td> <a href=recuperar2.php?id=".$row['id']."><button> Recuperar </button></a> </td>
                    <td> <a href=remove.php?id={$row['id']}&name={$row['name']}><button> Remover </button></a>
                 </tr>";
        }
    }
    
?>