<?php 

    require('../../include/database-connection.php');
	
    $option = $_GET['options'];

    switch($option) {

        case 'recover':

            $id = $_GET['id'];
            $sql = "UPDATE files SET active = 1 WHERE id='$id'";

            if ($db->query($sql) === TRUE) { header('location: ../trash'); } 
            else { echo "Erro ao apagar o registo: " . $db->error; }

        break;

        case 'remove':

            $id = $_GET['id'];
            $sql = "UPDATE files SET active = 0, date_delete = NOW() WHERE id='$id'";

            if ($db->query($sql) === TRUE) { header('location: ../home'); }
            else { echo "Erro ao apagar o registo: " . $db->error; }

        break;

        case 'delete':

            $filePath = 'uploads/';
            $id = $_GET['id'];
            $name = $_GET['name'];
            $filePath = $filePath.$name;

            $sql = "DELETE FROM files WHERE id='$id'";

            if(!unlink($filePath)) { echo "You have an error!"; } 
            else { header("Location: ../trash"); }
            
            if ($db->query($sql) === TRUE) { header('location: ../trash'); } 
            else { echo "Erro ao apagar o registo: " . $db->error; }

        break;

    }

?>