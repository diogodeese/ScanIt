<?php 

	$servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "db";
	
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de ligação: " . $conn->connect_error);
    }
	
   
    $filePath = 'uploads/';
	$id = $_GET['id'];
    $name = $_GET['name'];
    $filePath = $filePath.$name;

    print($id);
    print($name);
    print($filePath);

    $sql = "DELETE FROM files WHERE id='$id'";

    if(!unlink($filePath)) {

        echo "You have an error!";
    } else {

        header("Location: arquivo.php");
    }
    

    if ($conn->query($sql) === TRUE) {

            header('location: arquivo.php');
       
    } else {
        
        echo "Erro ao apagar o registo: " . $conn->error;
    }


?>