<?php 

	$servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "db";
	
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de ligação: " . $conn->connect_error);
    }
	
	
	$id = $_GET['id'];

    $sql = "UPDATE files SET active = 0, date_delete = NOW() WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {

            header('location: arquivo.php');
       
    } else {
        
        echo "Erro ao apagar o registo: " . $conn->error;
    }


?>