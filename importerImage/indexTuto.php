<?php
    // var_dump($_FILES)."</br>";
         
    session_start();

    if (isset($_FILES["file"])){ // vérifie que le fichier ai bien été enregistré

        // Récupere les informations du fichiers
        $tmpName = $_FILES["file"]['tmp_name']; 
        $name = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $error = $_FILES["file"]["error"];
        $size = $_FILES["file"]["size"];

        // separe la chaine de caractere $name a chaque fois qu'il a un "."
        $tabExtension = explode('.', $name);

        // Prend le dernier element de $tabExtension et le renvoie en minuscule
        $extension = strtolower(end($tabExtension));

        // Introduit une variable ayant pour valeur un int
        $tailleMax = 3000000;

        //Tableau des extensions qu'on autorise 
        $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
        
        if(in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0 ){ // vérifie que $extension soit compris dans $extensionAutorisees et que la taille du fichier soit <= a la valeur de $tailleMax et que le fichier ne renvoie aucune erreure

            // génere un nom unique ex: 5f586bf96dcd38.73540086
            $uniqueName = uniqid('', true);
            // on contatene $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
            $fileName = $uniqueName.'.'.$extension;
            //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
            move_uploaded_file($tmpName, './upload/'.$fileName); 

            // créer une variable tableau des $fileName
            $fichier = [
                "filename" => $fileName,
            ];

            // crée un tableau associatif 'fichiers' des $fichier
            $_SESSION['fichiers'][] = $fichier;


        } else { // renvoie cette phrase si les conditions ne sont pas vérifier
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
    <form action="indexTuto.php" method="post" enctype="multipart/form-data"> <!-- récupére le fichier ne pas oublier 'enctype='multiart/form-data'' lorsqu'on veut télécharger un fichier -->
        <label for="file">Fichier</label>
        <input type="file" name="file"> <!-- enregistrer avec file -->
        <button type="submit">Enregistrer</button>
    </form>
    <h2>Mes images</h2>
    <?php
    
     if (isset($_FILES["file"])) { // vérifie qu'un fichier a été enregistrer

        // boucle qui lie les tableaux associatifs $_SESSION['fichiers']
       foreach ($_SESSION['fichiers'] as $index => $fichier){

        // renvoie une balise img concatene au $filename du tableau $fichier = affiche l'img telecharger
        echo "<img src='./upload/".$fichier['filename']."' width='200px' height='200px'>";
        
       }
     };    
    ?>

</body>
</html>