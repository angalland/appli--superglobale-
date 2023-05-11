<?php
    session_start();

    $nbSession = 0;

    if(isset($_POST['submit'])){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        $_SESSION['alert'] = "Le produit a bien été ajouté ! ";
        

        if($name && $price && $qtt){

            $product = [
                "name"  => $name,
                "price" => $price,
                "qtt"   => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION['products'][] = $product;
            $nbSession++;
        } else {
            $_SESSION['alert'] = "Votre produit n'a pas été ajouté, il est incorrect !";
        }
    }

    header("Location:index.php");