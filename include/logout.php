  
<?php

    session_start();
    require ('database-connection.php');
    header('location: ../index');
    session_destroy();

?>