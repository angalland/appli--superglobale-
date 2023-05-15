<?php

    if (isset($_FILES["file"])){
        $tmpName = $_FILES["file"]['tmp_name'];
        $name = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $error = $_FILES["file"]["error"];
        $size = $_FILES["file"]["size"];
    
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