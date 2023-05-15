<?php
session_start(); // fait appelle a la session

if(isset($_POST['submit'])){ // si la variable $_post['submit'] est déclaré = si on a appuyer sur le bouton + ou -
    $indexInput = filter_input(INPUT_POST, "productIndex", FILTER_VALIDATE_INT); // créer une variable = a la valeur de l'index recuperer via type=hidden
    $qttModifier = filter_input(INPUT_POST, "modifierQtt"); // créer une variable = a la valeur de 'modifierQtt' récuperer via type=hidden

    foreach ($_SESSION['products'] as $index => $product) { // on fait une boucle sur $_SESSION['products'] en lui assignant un index
        if ($index == $indexInput) {  // si l'index = l'index récuperer plus haut alors
            if ($qttModifier == '+') {  // si la valeur de qttModifier récupérer plus haut = '+' alors
                $_SESSION['products'][$index]['qtt'] +=1;  // on ajoute 1 a la valeur de qtt dans le tableau SESSION
            } else { //sinon 
                if ($_SESSION['products'][$index]['qtt'] > 0){  // si la valeur de qtt dans le tableau SESSION > 0 alors
                $_SESSION['products'][$index]['qtt'] -=1; // on enleve 1 a la valeur de qtt dans le tableau SESSION
                }
            }
        }
    }
}

header('Location:recap.php'); // renvoie sur la page recap.php