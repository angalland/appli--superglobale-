<?php
    session_start();

    $nbSession = 0;

    if(isset($_POST['submit'])){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        $_SESSION['alert'] = "<p class='alert alert-success w-25' role='alert'>Le produit".$product['name']." a bien été ajouté !</p>";
        

        if($name && $price && $qtt){

            $product = [
                "name"  => $name,
                "price" => $price,
                "qtt"   => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION['alert'] = "<p class='alert alert-success w-25' role='alert'>Le produit ".$product['name']." a bien été ajouté !</p>";

            $_SESSION['products'][] = $product;

           

        } else {

            $_SESSION['alert'] = "<p class='alert alert-warning w-25 ' role='alert'>Votre produit n'a pas été ajouté, il est incorrect ! </p>";
        }
    }

    if (isset($_GET['supprimer'])){
        $indexClef = $_GET['index'];
        unset($_SESSION['products'][$indexClef]);
    }

    if (isset($_GET['supprimerTableau'])){
        unset($_SESSION['products']);
    }
    header("Location:recap.php");