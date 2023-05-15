<?php

    var_dump($_FILES)."</br>";

    if (isset($_FILES["file"])){
        $tmpName = $_FILES["file"]['tmp_name'];
        $name = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $error = $_FILES["file"]["error"];
        $size = $_FILES["file"]["size"];

        //PhotoAnthony1.jpg = $name
        //['PhotoAnthony1', 'jpg']
        $tabExtension = explode('.', $name);
        // var_dump($tabExtension)."</br>";
        $extension = strtolower(end($tabExtension));
        // var_dump($extension);
        $tailleMax = 3000000;

        //Tableau des extensions qu'on autorise 
        $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
        
        if(in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0 ){
            $uniqueName = uniqid('', true);
            $fileName = $uniqueName.'.'.$extension;
            move_uploaded_file($tmpName, './upload/'.$fileName);
        } else {
            echo "mauvaise extension ou taille trop importante ou erreure";
        }


        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuto importer une image</title>
</head>
<body>
    <form action="indexTuto.php" method="post" enctype="multipart/form-data">
        <label for="file">Fichier</label>
        <input type="file" name="file">
        <button type="submit">Enregistrer</button>
    </form>

</body>
</html>