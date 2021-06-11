<?php

	$user = "SELECT id FROM users WHERE username = '$_SESSION[username]'";
    $result = $db->query($user);
    $user = $result->fetch_assoc();
    echo $user['id'];

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
                    header('Location: home');

                } else echo "Your file is too big";
            } else echo "There was an error uploading your file";
        } else echo "This file extension is not allowed";

        //Uploading file information to Database
		$sql = "INSERT INTO files (id_users, name, date_upload, unic_link, active) values ($user[id], '$fileNewName', NOW(), '$unic_link', 1)";
		
		if ($db->query($sql) === TRUE) echo "O seu ficheiro foi guardado com sucesso";
		else echo "Erro: " . $sql . "<br>" . $db->error;
	}

?>