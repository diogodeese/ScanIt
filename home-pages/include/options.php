<?php 

    session_start();
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

            $filePath = 'uploads/'.$_SESSION['username'].'/';
            $id = $_GET['id'];
            $name = $_GET['name'];
            $filePath = $filePath.$name;

            unlink("../".$filePath);

            $sql = "DELETE FROM files WHERE id='$id'";

            if ($db->query($sql) === TRUE) { header('location: ../trash'); } 
            else { echo "Erro ao apagar o registo: " . $db->error; }

        break;

    }

?>