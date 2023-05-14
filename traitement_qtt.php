<?php
session_start();

if(isset($_POST['submit'])){
    $indexInput = filter_input(INPUT_POST, "productIndex", FILTER_VALIDATE_INT);
    $qttModifier = filter_input(INPUT_POST, "modifierQtt");

    foreach ($_SESSION['products'] as $index => $product) {
        if ($index == $indexInput) {
            if ($qttModifier == '+') {
                $_SESSION['products'][$index]['qtt'] +=1;
            } else {
                if ($_SESSION['products'][$index]['qtt'] > 0){
                $_SESSION['products'][$index]['qtt'] -=1;
                }
            }
        }
    }
}

header('Location:recap.php');