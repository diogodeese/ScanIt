<?php 

    session_start();
    require('../../include/database-connection.php');



    if(isset($_POST['delete'])) {

        $chkarr = $_POST['checkbox'];

        foreach($chkarr as $id) {

            $sql = "UPDATE files SET active = 0, date_delete = NOW() WHERE id='$id'";
            $results = mysqli_query($db, $sql);


        }
        header('Location: ../home');
    }

	if(isset($_GET['options'])) {

        $option = $_GET['options'];

        switch($option) {

            case 'recover':

                $id = $_GET['id'];
                $sql = "UPDATE files SET active = 1 WHERE id='$id'";

                if ($db->query($sql) === TRUE) { header('location: ../trash'); } 
                else { echo "Erro ao apagar o registo: " . $db->error; }

            break;

            case 'remove':

                $array = $_SESSION['checked'];

                print_r($_SESSION['checked']);

                for($i = 0; $i < 5; $i++) {
                    $sql = "UPDATE files SET active = 0, date_delete = NOW() WHERE id='$array[$i]'";
                    $results = mysqli_query($db, $sql);

                    echo $array[$i]."<br>";
                }



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
    } 
?>