<?php

	$user = "SELECT id FROM users WHERE username = '$_SESSION[username]'";
    $result = $db->query($user);
    $user = $result->fetch_assoc();

    //File Upload
	$filePath = 'uploads/'.$_SESSION['username']."/";

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

        //File Verification
        $allowedExt = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowedExt)) {
            if($fileError === 0) {
                if($fileSize < 5000000) {

                    $fileNewName = uniqid('', false).".".$fileActualExt;
                    $fileFinalPath = $filePath.$fileNewName;

                    //Generating a Random String
                    $unic_link = "file_".rand(1000000000, 9999999999);

                    move_uploaded_file($fileTmpName, $fileFinalPath);
                    
                    //Uploading file information to Database
                    $sql = "INSERT INTO files (id_users, name, date_upload, unic_link, active) values ($user[id], '$fileNewName', NOW(), '$unic_link', 1)";
                    
                    if ($db->query($sql) === TRUE) header('Location: home');
                    else echo "Erro: " . $sql . "<br>" . $db->error;
                    
                } else { header('Location: home?error_type=size'); } 
            } else { header('Location: home?error_type=error'); }
        } else { header('Location: home?error_type=extension'); }
	}

?>