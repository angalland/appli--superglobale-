<?php
    session_start(); // enregistre des données sur le serveur, ici on demarre une session. Cette fonction permet soit de demarrer une session soit de récupérer une séssion déja présente sur le serveur

    $nbSession = 0;

    if(isset($_POST['submit'])){ // Vérification que l'utilisateur a bien appuyer sur le bouton ajouter produit

        // Filtre pour vérifié les données saisies par l'utilisateur
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        //Envoie un message lorsque l'utilisateur a ajouté un produit       

        if($name && $price && $qtt){ // Cette condition vérifie si les filtres ont bien fonctionné, que les variables renvoient tous sauf false, null ou 0.

            $product = [ //Mets les information d'un produits dans un tableau assiocatif
                "name"  => $name,
                "price" => $price,
                "qtt"   => $qtt,
                // "total" => $price*$qtt sera traité directement sur la page recap.php
            ];

            //Envoie un message lorsque l'utilisateur a ajouté un produit  
            $_SESSION['alert'] = "<p class='alert alert-success w-25' role='alert'>Le produit ".$product['name']." a bien été ajouté !</p>";
            
            // On enregistre le produit nouvellement créer dans la superglobale SESSION a qui on fournit une clef products, $_SESSION nous renverra donc un tableau associatif products => product
            $_SESSION['products'][] = $product;

            // fonction qui trie le tableau par ordre alphabétique
            sort($_SESSION['products']);

        } else { //Les filtres ont renvoyé false, null ou 0

            // envoie un message 
            $_SESSION['alert'] = "<p class='alert alert-warning w-25 ' role='alert'>Votre produit n'a pas été ajouté, il est incorrect ! </p>";
        }
    }

    header("Location:index.php"); //Redirection vers index.php pour que l'utilisateur ne puisse pas atteindre la page traitement.php